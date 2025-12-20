<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlutterUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;

class WebAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = FlutterUser::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Log the user in to the flutter_web guard with Remember Me
            $remember = $request->has('remember');
            Auth::guard('flutter_web')->login($user, $remember);

            return redirect()->intended('/home');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:flutter_users,email',
            'password' => 'required|min:6|confirmed',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user = FlutterUser::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => $imagePath,
        ]);

        // Auto login
        Auth::guard('flutter_web')->login($user);

        // Send Email Verification Notification
        if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail) {
            $user->sendEmailVerificationNotification();
        }

        return redirect()->route('verification.notice');
    }

    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = FlutterUser::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended('/home?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended('/home?verified=1');
    }

    public function resendVerificationEmail(Request $request)
    {
        $request->user('flutter_web')->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    }

    public function logout()
    {
        Auth::guard('flutter_web')->logout();
        return redirect('/');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = strtolower($request->email);

        // Don't reveal if email exists
        $user = FlutterUser::where('email', $email)->first();
        if (!$user) {
            return back()->with('success', 'If the email exists, a reset code will be sent.');
        }

        $code = random_int(100000, 999999);
        $key = "pwd_reset:$email";

        Cache::put($key, [
            'code' => (string)$code,
            'expires_at' => now()->addMinutes(15)->timestamp,
            'attempts' => 0,
        ], now()->addMinutes(15));

        Mail::raw("Your password reset code is: {$code}\n\nThis code expires in 15 minutes.\n\nIf you didn't request this, please ignore this email.", function ($m) use ($email) {
            $m->to($email)->subject('Password Reset Code - Just Travel');
        });

        session(['reset_email' => $email]);

        return redirect()->route('password.reset')->with('success', 'If the email exists, a reset code has been sent.');
    }

    public function showResetPassword()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.forgot')->with('error', 'Please request a reset code first.');
        }
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
            'password' => 'required|min:6|confirmed',
        ]);

        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('password.forgot')->with('error', 'Session expired. Please request a new code.');
        }

        $email = strtolower($email);
        $key = "pwd_reset:$email";
        $data = Cache::get($key);

        if (!$data) {
            return back()->with('error', 'Invalid or expired code. Please request a new one.');
        }

        if (($data['attempts'] ?? 0) >= 5) {
            Cache::forget($key);
            session()->forget('reset_email');
            return back()->with('error', 'Too many attempts. Please request a new code.');
        }

        // Increment attempts counter
        $data['attempts'] = ($data['attempts'] ?? 0) + 1;
        Cache::put($key, $data, Carbon::createFromTimestamp($data['expires_at']));

        if ((string)$request->code !== (string)$data['code']) {
            return back()->with('error', 'Invalid code. ' . (5 - $data['attempts']) . ' attempts remaining.');
        }

        if (now()->timestamp > ($data['expires_at'] ?? 0)) {
            Cache::forget($key);
            session()->forget('reset_email');
            return back()->with('error', 'Code expired. Please request a new one.');
        }

        $user = FlutterUser::where('email', $email)->first();
        if (!$user) {
            Cache::forget($key);
            session()->forget('reset_email');
            return back()->with('error', 'Invalid or expired code.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Cache::forget($key);
        $user->tokens()->delete();
        session()->forget('reset_email');

        return redirect()->route('login')->with('success', 'Password reset successfully! You can now login with your new password.');
    }
}
