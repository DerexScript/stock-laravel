<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TypeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/home', function () {
    return redirect()->route('home');
});

Route::middleware('verified')->prefix('dashboard')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->name('dashboard');

    Route::prefix('role')->group(function () {
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::delete('/destroy/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
        Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/update/{role}', [RoleController::class, 'update'])->name('role.update');
    });
    Route::prefix('product')->group(function () {
        Route::get('/create', [ProductController::class, 'index'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('product.update');
    });
    Route::prefix('category')->group(function () {
        Route::get('/create', [CategoryController::class, 'index'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    });
    Route::prefix('type')->group(function () {
        Route::get('/create', [TypeController::class, 'index'])->name('type.create');
        Route::post('/store', [TypeController::class, 'store'])->name('type.store');
        Route::delete('/destroy/{type}', [TypeController::class, 'destroy'])->name('type.destroy');
        Route::get('/edit/{type}', [TypeController::class, 'edit'])->name('type.edit');
        Route::put('/update/{type}', [TypeController::class, 'update'])->name('type.update');
    });
});

Route::get('/tt', function () {
    $ur = App\Models\User::find(1);

    $role = App\Models\Role::find(1);
    //$rc = $role->categories()->attach([1,2]);
    //$rp = $role->permissions()->attach([1,2]);

    //dd($role->categories()->attach([1,2]));

    $p = App\Models\Permission::find(3);
    $p1 = App\Models\Permission::find(1);
    //dd($role->permissions);
    dd($ur->hasPermission($role->permissions));
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



