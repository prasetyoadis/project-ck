<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

/*
 * Frontend Route
 **/
Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'indexAbout']);
Route::get('/help', [PageController::class, 'indexHelp']);
Route::get('/blog', [PageController::class, 'indexBlog']);
Route::get('/testimoni', [PageController::class, 'indexTestimoni']);
Route::get('/katalog', [PageController::class, 'indexKatalog']);
Route::get('/katalog/akad-nikah', [PageController::class, 'indexAkadNikah']);

/*
 * Login & Logout Route
 **/
Route::get('/admin', [AuthController::class, 'indexLogin'])
    ->name('login')
    ->middleware('guest');
Route::post('/admin', [AuthController::class, 'adminLogin']);
Route::post('/logout', [AuthController::class, 'adminLogout']);

Route::get('/forgot-password', [AuthController::class, 'indexForgotPass'])
    ->middleware('guest');
Route::post('/forgot-password', [AuthController::class, 'forgotPass'])
    ->middleware('guest');

/*
 * Verify Route
 **/
Route::middleware(['auth'])->group(function (){
    //Email Verify
    Route::get('/email/verify', [AuthController::class, 'index_verifyEmail'])
        ->middleware('has.verified')
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'token_verifyEmail'])
        ->middleware(['signed'])
        ->name('verification.verify');
    // Route::post('/email/verify/{id}/{hash}', [AuthController::class, 'token_verifyEmail'])
    //     ->middleware(['auth', 'signed'])
    //     ->name('verification.verify');
    Route::post('/email/verify/resend', [AuthController::class, 'verifyResend'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});


/*
 * Backend Route
 **/
Route::middleware(['auth', 'verified'])->group(function (){
    //Dashboard Menu
    Route::get('/admin/dashboard', [PageController::class, 'indexDashboard']);

    Route::resource('/admin/staff', StaffController::class)
        ->parameters(['staff' => 'user'])
        ->middleware('super');
    Route::resource('/admin/orders', OrderController::class);
    Route::get('admin/invitations', function(){
        return view('layouts.misc-under-maintenance');
    });
    Route::get('/admin/themes', function(){
        return view('layouts.misc-under-maintenance');
    });
    Route::get('/admin/category-themes', function(){
        return view('layouts.misc-under-maintenance');
    });
    Route::get('/admin/riwayat-orders', function(){
        return view('layouts.misc-under-maintenance');
    });
    
});
Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/admin/@{user}', [UserController::class, 'index']);
    Route::get('/admin/@{user}/edit', [UserController::class, 'edit']);
    Route::put('/admin/@{user}', [UserController::class, 'update']);

    Route::get('/admin/settings', function(){
        return view('dashboard.settings', [
            "title" => "Settings",
        ]);
    });
    Route::post('/admin/settings/pass-confirm', [UserController::class, 'passConfirm']);
    Route::post('/admin/settings/pass-edit', [UserController::class, 'passEdit']);
    Route::post('/admin/settings/email-edit', [UserController::class, 'emailEdit']);
});