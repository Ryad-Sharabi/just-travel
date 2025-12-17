<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\Api\AirportController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\FlightController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\FlutterAuthController;
use App\Http\Controllers\JustMineTravelAIController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use App\Models\FlutterUser;



Route::post('/flutter/login', [FlutterAuthController::class, 'login']);
Route::post('/flutter/register', [FlutterAuthController::class, 'register']);
Route::post('/password/send-code', [FlutterAuthController::class,'sendResetCode']);
Route::post('/password/confirm',   [FlutterAuthController::class,'resetPasswordWithCode']);
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = FlutterUser::findOrFail($id);

    // تحقّق من الهاش
    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        return response()
            ->view('verification.error', [
                'title'   => 'Invalid verification link',
                'heading' => 'Verification link is not valid',
                'message' => 'The link you used is invalid or expired. Please request a new one.',
                'cta_url' => url('https://justtravel.pro/login'), // غيّرها إذا بدّك
                'cta_txt' => 'Back to home',
            ], 403);
    }

    // لو موثّق أساساً
    if ($user->hasVerifiedEmail()) {
        return response()
            ->view('verification.already', [
                'title'   => 'Email already verified',
                'heading' => 'Your email is already verified',
                'message' => 'You can sign in and continue.',
                'cta_url' => url('https://justtravel.pro/login'), // غيّرها مثلاً لصفحة تسجيل الدخول
                'cta_txt' => 'Go to app',
            ]);
    }

    // توثيق + حدث
    if ($user->markEmailAsVerified()) {
        event(new Verified($user));
    }

    // نجاح ✅
    return response()
        ->view('verification.success', [
            'title'   => 'Email verified',
            'heading' => 'Congratulations — your email verified successfully',
            'message' => 'Thanks for confirming your email. You can now continue.',
            'cta_url' => url('https://justtravel.pro/login'), // مثال: https://justtravel.pro أو صفحة تسجيل الدخول
            'cta_txt' => 'Open the app',
            'autoredirect_seconds' => 4,
        ]);
})->name('verification.verify');

Route::middleware('auth:sanctum')->post('/feedbacks', [FeedbackController::class, 'store']);
Route::middleware('auth:sanctum')->post('/flutter/change-password', [FlutterAuthController::class, 'changePassword']);
Route::middleware('auth:sanctum')->post('/flutter/update-profile-image', [FlutterAuthController::class, 'updateProfileImage']);
Route::middleware('auth:sanctum')->delete('/delete-account', [FlutterAuthController::class, 'deleteAccount']);

Route::post('/suggest-destinations', [JustMineTravelAIController::class, 'suggestDestinations']);
Route::post('/chat/just-mine', [JustMineTravelAIController::class, 'generate']);
Route::get('/flights', [FlightController::class, 'index']);
Route::get('/cars', [CarController::class, 'index']);
Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/airports', [AirportController::class, 'index']);
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

