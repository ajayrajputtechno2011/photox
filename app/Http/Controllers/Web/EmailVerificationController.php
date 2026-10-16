<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    /**
     * Display the email verification notice page.
     */
    public function notice(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        if ($user && $user->hasVerifiedEmail()) {
            return $this->redirectBasedOnRole($user);
        }

        return view('web.auth.verify-email', compact('user'));
    }

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function verify(Request $request, string $id, string $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect()->route('verification.notice')->withErrors([
                'email' => 'Invalid or expired verification link. Please request a new verification email.',
            ]);
        }

        if ($user->hasVerifiedEmail()) {
            return $this->redirectBasedOnRole($user)->with('info', 'Your email is already verified and POPIA-compliant.');
        }

        if ($user->markEmailAsVerified()) {
            $user->is_verified = true;
            $user->save();

            event(new Verified($user));
        }

        // If the user was not logged in, log them in
        if (! Auth::check()) {
            Auth::login($user);
        }

        return $this->redirectBasedOnRole($user)->with(
            'success',
            'Your email address has been successfully verified! Your account is now fully active and POPIA-compliant.'
        );
    }

    /**
     * Resend the email verification notification.
     */
    public function resend(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return $this->redirectBasedOnRole($user)->with('info', 'Your email is already verified.');
        }

        try {
            $user->sendEmailVerificationNotification();
            $message = 'A fresh verification link has been sent to your email address ('.$user->email.'). Please check your inbox.';
        } catch (\Throwable $e) {
            Log::warning('SMTP email dispatch error in resend verification: '.$e->getMessage());
            $message = 'Verification request registered! If your mail server is active, check your inbox. (Admin SMTP is currently in standby mode).';
        }

        return back()->with('status', $message);
    }

    /**
     * Helper to redirect users based on their role.
     */
    protected function redirectBasedOnRole(User $user): RedirectResponse
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
