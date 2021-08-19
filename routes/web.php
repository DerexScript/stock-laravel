<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Auth\ResetPasswordController;
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
    Route::middleware('guest')->get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'verifyLogin'])->name('auth.verifyLogin');
    Route::any('/logout', [LoginController::class, 'logout'])->name('auth.logout');
    Route::get('/register', [RegisterController::class, 'create'])->name('auth.create');
    Route::post('/register', [RegisterController::class, 'store'])->name('auth.store');
});

//-------------------verificando-email-apos-registro-------------------------
Route::get('/email/verify', function () {
    return view('auth.verifyEmail');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    \App\Jobs\SendEmailVerificationNotificationJob::dispatch($request->user());
    //$request->user()->sendEmailVerificationNotification();
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('virifiedSucess');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/email/virified/sucess', function () {
    return view('auth.emailVerifiedSucess');
})->name('virifiedSucess');
//----------------------------------------------------------------------------

//---------------------Resetando-a-senha-do-usuario---------------------------
Route::prefix('auth')->group(function () {
    Route::get('/forgot-password',
        [ResetPasswordController::class, 'forgotPassword'])->middleware('guest')->name('password.request');

    Route::post('/forgot-password',
        [ResetPasswordController::class, 'sendPwResetLink'])->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}',
        [ResetPasswordController::class, 'showViewReset'])->middleware('guest')->name('password.reset');

    Route::post('/reset-password',
        [ResetPasswordController::class, 'updatePassword'])->middleware('guest')->name('password.update');
});
//----------------------------------------------------------------------------

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
})->name('home');

Route::get('/home', function () {
    return redirect()->route('home');
});

Route::middleware('verified')->prefix('dashboard')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->name('dashboard');
    Route::prefix('role')->group(function () {
        Route::get('/create', [RoleController::class, 'create'])->name('createRole');
        Route::post('/store', [RoleController::class, 'store'])->name('storeRole');
        Route::delete('/destroy/{role}', [RoleController::class, 'destroy'])->name('destroyRole');
        Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('editRole');
        Route::put('/update/{role}', [RoleController::class, 'update'])->name('updateRole');
    });
    Route::prefix('product')->group(function () {
        Route::get('/create', [ProductController::class, 'index'])->name('createProduct');
        Route::get('/store', [ProductController::class, 'index'])->name('storeProduct');
        Route::get('/destroy/{product}', [ProductController::class, 'index'])->name('destroyProduct');
        Route::get('/edit/{product}', [ProductController::class, 'index'])->name('editProduct');
        Route::get('/update/{product}', [ProductController::class, 'index'])->name('updateProduct');
    });
});

Route::get('/tt', function () {
    $ur = App\Models\User::find(1);

    $role = App\Models\Role::find(2);
    //$rc = $role->categories()->attach([1,2]);
    //$rp = $role->permissions()->attach([1,2]);

    $p = App\Models\Permission::find(3);
    $p1 = App\Models\Permission::find(1);


    //$ur->hasPermission($role->permissions);
});

Route::fallback(function () {
    return view('fallback');
});

Route::get('/teste', function () {
//    Illuminate\Support\Facades\Redis::set('user', "Taylor");
//    $userValue = Illuminate\Support\Facades\Redis::get('user');
//    echo "User Value: ".$userValue;
//    \App\Jobs\SendEmailVerificationNotificationJob::dispatch(Auth::user());

    //with() = eaggerload
    $r = App\Models\Role::with(['category', 'user'])->first();
    /*
     $cat = App\Models\Role::find(4);
    if (isset($cat)) {
        //return response($cat->toJson())->header('Content-Type', 'application/json');
        //exit();
        $cat->category()->attach([
            4 => ['view' => (bool) 0, 'edit' => (bool) 1, 'delete' => (bool) 0],
            3 => ['view' => (bool) 0, 'edit' => (bool) 1, 'delete' => (bool) 0]
        ]);
    }
    */

    return response($r->toJson())->header('Content-Type', 'application/json');
    //return response($r->toJson())->header('Content-Type', 'application/json');
});



