<?php

namespace App\Http\Controllers;

use App\Models\FlutterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;


class FlutterAuthController extends Controller
{
public function register(Request $request)
{
    $profileImage = null;
    if ($request->hasFile('profile_image')) {
        $profileImage = $request->file('profile_image')->store('profile_images', 'public');
    }
try {
    $user = FlutterUser::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'profile_image' => $profileImage,
    ]);

    $user->sendEmailVerificationNotification();

    $token = $user->createToken('flutter_token')->plainTextToken;

    return response()->json([
        'message' => 'done',
        'token' => $token
    ]);
} catch (\Exception $e) {
    return response()->json([
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ], 500);
}

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
public function deleteAccount(Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $user->delete();

    return response()->json(['message' => 'Account deleted successfully']);
}

public function sendResetCode(Request $request)
{
    $request->validate(['email' => 'required|email']);
    $email = strtolower($request->email);

    // لا نُفصح إن كان الإيميل موجود
    $user = FlutterUser::where('email', $email)->first();
    if (!$user) {
        return response()->json(['message' => 'If email exists, a code will be sent'], 200);
    }

    $code = random_int(100000, 999999);
    $key  = "pwd_reset:$email";

    Cache::put($key, [
        'code'       => (string)$code,
        'expires_at' => now()->addMinutes(15)->timestamp,
        'attempts'   => 0,
    ], now()->addMinutes(15));

    Mail::raw("Your reset code is: {$code}\nThis code expires in 15 minutes.", function ($m) use ($email) {
        $m->to($email)->subject('Password Reset Code');
    });

    return response()->json(['message' => 'Reset code sent if email exists'], 200);
}

public function resetPasswordWithCode(Request $request)
{
    $request->validate([
        'email'                 => 'required|email',
        'code'                  => 'required|digits:6',
        'password'              => 'required|min:6|confirmed', // أرسل password_confirmation
    ]);

    $email = strtolower($request->email);
    $key   = "pwd_reset:$email";
    $data  = Cache::get($key);

    if (!$data) return response()->json(['message' => 'Invalid or expired code'], 400);

    if (($data['attempts'] ?? 0) >= 5) {
        Cache::forget($key);
        return response()->json(['message' => 'Too many attempts. Request new code'], 429);
    }

    // زوّد العدّاد واحفظ نفس الانتهاء
    $data['attempts'] = ($data['attempts'] ?? 0) + 1;
    Cache::put($key, $data, Carbon::createFromTimestamp($data['expires_at']));

    if ((string)$request->code !== (string)$data['code'])
        return response()->json(['message' => 'Invalid code'], 400);

    if (now()->timestamp > ($data['expires_at'] ?? 0)) {
        Cache::forget($key);
        return response()->json(['message' => 'Code expired'], 400);
    }

    $user = FlutterUser::where('email', $email)->first();
    if (!$user) {
        Cache::forget($key);
        return response()->json(['message' => 'Invalid or expired code'], 400);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    Cache::forget($key);
    // (اختياري) ألغِ التوكنات القديمة:
     $user->tokens()->delete();

    return response()->json(['message' => 'Password reset successfully'], 200);
}

}
