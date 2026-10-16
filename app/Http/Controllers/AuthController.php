<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Show the login page.
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        $activeTab = $request->query('tab', old('account_type', 'customer'));

        return view('web.login', compact('activeTab'));
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');
        $expectedRole = $request->input('account_type', 'customer');

        $attemptCredentials = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => $expectedRole,
        ];

        if (Auth::attempt($attemptCredentials, $remember)) {
            $user = Auth::user();

            // 1. Strict Security: Block SuperAdmin / Admin from public frontend login
            if ($user->role === 'admin' || $user->role === 'superadmin') {
                Auth::logout();
                if ($request->hasSession()) {
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                }

                return back()->withInput($request->only('email', 'account_type'))->withErrors([
                    'email' => 'Administrator accounts cannot log in here. Please use the Admin Portal.',
                ]);
            }

            // 2. Account Status Check
            if ($user->status === 'suspended') {
                Auth::logout();
                if ($request->hasSession()) {
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                }

                return back()->withInput($request->only('email', 'account_type'))->withErrors([
                    'email' => 'Your account has been suspended. Please contact support.',
                ]);
            }

            if ($request->hasSession()) {
                $request->session()->regenerate();
            }

            return $this->redirectBasedOnRole($user)->with('success', 'Welcome back, '.$user->name.'!');
        }

        // Check if an account exists under the other role to provide a helpful message
        $otherAccount = User::where('email', $credentials['email'])->first();
        if ($otherAccount && $otherAccount->role !== $expectedRole) {
            $properTab = ucfirst($otherAccount->role);

            return back()->withInput($request->only('email', 'account_type'))->withErrors([
                'email' => "This account is registered as a {$properTab}. Please click the {$properTab} tab above to log in.",
            ]);
        }

        return back()->withInput($request->only('email', 'remember', 'account_type'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle dedicated Admin authentication attempt (/admin/login).
     */
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if (! in_array($user->role, ['admin', 'superadmin'])) {
                Auth::logout();
                if ($request->hasSession()) {
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                }

                return back()->withInput($request->only('email'))->withErrors([
                    'email' => 'Access denied. Only administrator accounts can sign in here.',
                ]);
            }

            if ($user->status === 'suspended') {
                Auth::logout();
                if ($request->hasSession()) {
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                }

                return back()->withInput($request->only('email'))->withErrors([
                    'email' => 'Your administrator account has been suspended.',
                ]);
            }

            if ($request->hasSession()) {
                $request->session()->regenerate();
            }

            return redirect()->intended('/admin/dashboard')->with('success', 'Welcome to PhotoX Admin, '.$user->name.'!');
        }

        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'The provided admin credentials do not match our records.',
        ]);
    }

    /**
     * Show the registration form.
     */
    public function showSignupForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('web.signup');
    }

    /**
     * Handle registration request.
     */
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'account-type' => ['required', 'in:member,photographer'],
            'photographer-tier' => ['nullable', 'in:starter,pro,studio'],
            'terms' => ['required'],
        ], [
            'terms.required' => 'You must agree to the PhotoX terms and privacy policy.',
            'account-type.required' => 'Please select an account type.',
        ]);

        $isPhotographer = ($validated['account-type'] === 'photographer');
        $desiredRole = $isPhotographer ? 'photographer' : 'customer';

        $existingUser = User::where('email', $validated['email'])
            ->where('role', $desiredRole)
            ->first();

        if ($existingUser) {
            return back()->withInput()->withErrors([
                'email' => "An account with this email address already exists as a {$desiredRole}. Please sign in.",
            ]);
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $desiredRole,
            'status' => 'active',
            'is_verified' => false,
            'tier' => $isPhotographer ? ($validated['photographer-tier'] ?? 'starter') : null,
        ]);

        try {
            $user->sendEmailVerificationNotification();
        } catch (\Throwable $e) {
            Log::warning('SMTP verification email dispatch error: '.$e->getMessage());
        }

        Auth::login($user);
        if ($request->hasSession()) {
            $request->session()->regenerate();
        }

        $welcomeMessage = $isPhotographer
            ? 'Creator account created! Please verify your email address to ensure full POPIA compliance.'
            : 'Welcome to PhotoX, '.$user->name.'! Please verify your email address for account security and POPIA compliance.';

        return $this->redirectBasedOnRole($user)->with('success', $welcomeMessage);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Helper to redirect users based on their role.
     */
    protected function redirectBasedOnRole(User $user)
    {
        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        if ($user->role === 'photographer') {
            return redirect('/photographer-dashboard');
        }

        return redirect('/customer-dashboard');
    }
}
