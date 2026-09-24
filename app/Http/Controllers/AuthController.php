<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login page.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('web.login');
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

        if (Auth::attempt($credentials, $remember)) {
            if ($request->hasSession()) {
                $request->session()->regenerate();
            }

            $user = Auth::user();

            if ($user->status === 'suspended') {
                Auth::logout();
                if ($request->hasSession()) {
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                }

                return back()->with('error', 'Your account has been suspended. Please contact support.');
            }

            return $this->redirectBasedOnRole($user)->with('success', 'Welcome back, '.$user->name.'!');
        }

        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'account-type' => ['required', 'in:member,photographer'],
            'photographer-tier' => ['nullable', 'in:starter,pro,studio'],
            'terms' => ['required'],
        ], [
            'terms.required' => 'You must agree to the PhotoX terms and privacy policy.',
            'account-type.required' => 'Please select an account type.',
        ]);

        $isPhotographer = ($validated['account-type'] === 'photographer');

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $isPhotographer ? 'photographer' : 'customer',
            'status' => $isPhotographer ? 'pending_approval' : 'active',
            'tier' => $isPhotographer ? ($validated['photographer-tier'] ?? 'starter') : null,
        ]);

        Auth::login($user);
        if ($request->hasSession()) {
            $request->session()->regenerate();
        }

        $welcomeMessage = $isPhotographer
            ? 'Account created! Welcome to the PhotoX Creator Workspace. Your creator profile is ready.'
            : 'Welcome to PhotoX, '.$user->name.'! Your account is active.';

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
            return redirect()->intended('/admin');
        }

        if ($user->role === 'photographer') {
            return redirect()->intended('/photographer-dashboard');
        }

        return redirect()->intended('/customer-dashboard');
    }
}
