<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use \App\Http\Controllers\Dashboard;
use App\Mail\Auth\WelcomeMail;
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
    route::any('/logout', [LoginController::class, 'logout'])->name('auth.logout');
});


Route::any('/teste', function(){
    \App\Jobs\SendMailJob::dispatch();
});

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
})->name('home');


Route::prefix('dashboard')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->middleware('auth');
});

Route::fallback(function () {
    return view('fallback');
});

