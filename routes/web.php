<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard;
use \App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;




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

//-------------------verificando-email-apos-registro-------------------------
Route::get('/email/verify', function (Request $request) {
    return view('auth.verifyEmail');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('virifiedSucess');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    \App\Jobs\SendEmailVerificationNotificationJob::dispatch($request->user());
    //$request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link de verificação enviado!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/virified/sucess', function () {
    return view('auth.emailVerifiedSucess');
})->name('virifiedSucess');
//----------------------------------------------------------------------------

//---------------------Resetando-a-senha-do-usuario---------------------------
Route::get('/forgot-password',
    [ResetPasswordController::class, 'forgotPassword'])->middleware('guest')->name('password.request');

Route::post('/forgot-password',
    [ResetPasswordController::class, 'sendPwResetLink'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}',
    [ResetPasswordController::class, 'showViewReset'])->middleware('guest')->name('password.reset');

Route::post('/reset-password',
    [ResetPasswordController::class, 'updatePassword'])->middleware('guest')->name('password.update');
//----------------------------------------------------------------------------

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
})->name('home');

Route::prefix('dashboard')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->middleware('verified')->name('dashboard');
});

Route::fallback(function () {
    return view('fallback');
});

Route::get('/teste', function(){
   dd(env('DB_HOST'));
});
