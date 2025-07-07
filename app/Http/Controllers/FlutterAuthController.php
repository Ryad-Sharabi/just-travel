<?php

namespace App\Http\Controllers;

use App\Models\FlutterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class FlutterAuthController extends Controller
{
public function register(Request $request)
{
    $profileImage = null;
    if ($request->hasFile('profile_image')) {
        $profileImage = $request->file('profile_image')->store('profile_images', 'public');
    }

    $verificationToken = Str::random(40);

    $user = FlutterUser::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'profile_image' => $profileImage,
        'email_verified_at' => now()
      //  'email_verification_token' => $verificationToken,
    ]);

    $token = $user->createToken('flutter_token')->plainTextToken;

  //  $verificationUrl = url("/api/verify-email/{$verificationToken}");
 //  Mail::send('emails.verify_email', ['user' => $user, 'verificationUrl' => $verificationUrl], function ($message) use ($user) {
 //   $message->to($user->email)->subject('Verify Your Email Address');
//});


    return response()->json([
        'message' => 'User registered successfully. Please verify your email.',
        'token' => $token,
        'user' => $user
    ], 201);
}
public function verifyEmail($token) {
    $user = FlutterUser::where('email_verification_token', $token)->first();
    if (!$user) {
        return response()->json(['message' => 'Invalid or expired token'], 404);
    }

    $user->email_verified_at = now();
    $user->email_verification_token = null;
    $user->save();

    return response()->json(['message' => 'Email verified successfully']);
}
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = FlutterUser::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

 //   if (is_null($user->email_verified_at)) {
   //     return response()->json(['message' => 'Email not verified'], 403);
    //}

    $token = $user->createToken('flutter_token')->plainTextToken;

    return response()->json([
        'message' => 'Login successful',
        'token' => $token,
        'user' => $user,
    ]);
}

 public function changePassword(Request $request)
{
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:6',
    ]);

    $user = $request->user();

    if (!Hash::check($request->old_password, $user->password)) {
        return response()->json(['message' => 'Old password is incorrect'], 400);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json(['message' => 'Password updated successfully']);
}

public function updateProfileImage(Request $request)
{
    $request->validate([
        'profile_image' => 'required|image|max:5120',
    ]);

    $user = $request->user();

    if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = $path;
        $user->save();
    }

    return response()->json([
        'message' => 'Profile image updated successfully',
        'profile_image' => $user->profile_image,
    ]);
}




}
