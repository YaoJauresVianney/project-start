<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::group([
    'namespace' => 'Api',
    'as' => 'auth.'
],
function () {
    Route::get('register', [AuthenticationController::class, 'register_page'])->name('register_page');
    Route::get('login', [AuthenticationController::class, 'login_page'])->name('login_page');
    Route::post('register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('refresh', [AuthenticationController::class, 'refresh'])->name('refresh');
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
    Route::post('user', [AuthenticationController::class, 'me'])->name('user')->middleware('auth:sanctum');
}
);

Route::get(
    uri: '/email/verify/{id}/{hash}',
    action: [AuthenticationController::class, 'verifyEmail'] 
)->middleware(['signed'])->name('verification.verify');

Route::post(
    uri: '/email/verification-notification',
    action: [AuthenticationController::class, 'resendVerificationEmail'] 
)->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');