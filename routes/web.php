<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'verifyLogin'])->name('auth.verifyLogin');
    Route::any('/logout', [LoginController::class, 'logout'])->name('auth.logout');
    Route::get('/register', [RegisterController::class, 'create'])->name('auth.create');
    Route::post('/register', [RegisterController::class, 'store'])->name('auth.store');
});

Route::get('/email/verify', function (Request $request) {
    return view('auth.verifyEmail');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('virifiedSucess');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/virified/sucess', function () {
    return view('auth.emailVerifiedSucess');
})->name('virifiedSucess');

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
})->name('home');

Route::prefix('dashboard')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->middleware('verified')->name('dashboard');
});

Route::fallback(function () {
    return view('fallback');
});

Route::get('/teste', function (Request $request) {
    try {
        Redis:set('asd', '123456');
        $redis = Redis::get("asd");
        echo 'redis working'.$redis;
    } catch (\Predis\Connection\ConnectionException $e) {
        echo 'error connection redis';
    }
    //\Illuminate\Support\Facades\Mail::send(new \App\Mail\);
});


