<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Services\Contracts\AuthenticationContract;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'as' => 'auth.'
],
function () {
    Route::get('register', [AuthenticationController::class, 'register_page'])->name('register_page');
    Route::get('login', [AuthenticationController::class, 'login_page'])->name('login_page');
    Route::post('register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('refresh', [AuthenticationContract::class, 'refresh'])->name('refresh');
    Route::post('logout', [AuthenticationContract::class, 'logout'])->name('logout')->middleware('auth:sanctum');
    Route::post('user', [AuthenticationContract::class, 'user'])->name('user')->middleware('auth:sanctum');
}
);