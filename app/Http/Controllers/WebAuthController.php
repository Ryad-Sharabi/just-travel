<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlutterUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
}
