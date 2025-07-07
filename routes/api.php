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



Route::post('/flutter/login', [FlutterAuthController::class, 'login']);
Route::post('/flutter/register', [FlutterAuthController::class, 'register']);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return response()->json(['message' => 'Email verified']);
})->middleware(['auth:sanctum', 'signed'])->name('verification.verify');
Route::middleware('auth:sanctum')->post('/feedbacks', [FeedbackController::class, 'store']);
Route::middleware('auth:sanctum')->post('/flutter/change-password', [FlutterAuthController::class, 'changePassword']);
Route::middleware('auth:sanctum')->post('/flutter/update-profile-image', [FlutterAuthController::class, 'updateProfileImage']);

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

