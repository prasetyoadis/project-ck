<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('home',[
        "title" => "Home"
    ]);
});
Route::get('/about', function () {
    return view('about', [
        "title" => "About"
    ]);
});
Route::get('/help', function () {
    return view('help',[
        "title" => "Help"    
    ]);
});
Route::get('/katalog', function () {
    return view('katalog', [
        "title" => "Katalog"
    ]);
});
Route::get('/blog', function () {
    return view('Blog', [
        "title" => "Blog"
    ]);
});
Route::get('/testimoni', function () {
    return view('testimoni', [
        "title" => "Testimoni"
    ]);
});
Route::get('/testimoni', function () {
    return view('testimoni', [
        "title" => "Testimoni"
    ]);
});
Route::get('/akad-nikah', function () {
    return view('/tema/pernikahan/akadnikah', [
        "title" => "Axel & Michi"
    ]);
});
//Admin Login
Route::get('/admin', [AuthController::class, 'indexLogin'])
    ->name('login')
    ->middleware('guest');
    
Route::post('/admin', [AuthController::class, 'adminLogin']);

Route::post('/logout', [AuthController::class, 'adminLogout']);

//Email Verify
Route::get('/email/verify', [AuthController::class, 'index_verifyEmail'])
    ->middleware('auth', 'has.verified')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'token_verifyEmail'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Route::post('/email/verify/{id}/{hash}', [AuthController::class, 'token_verifyEmail'])
//     ->middleware(['auth', 'signed'])
//     ->name('verification.verify');
 
Route::post('/email/verify/resend', [AuthController::class, 'verifyResend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

//


//Dashboard Menu
Route::get('admin/dashboard', function(){
    return view('dashboard.admin.index', [
        "title" => "Dashboard"
    ]);
})->middleware(['auth', 'verified']);

Route::resource('admin/staff', StaffController::class)
    ->parameters(['staff' => 'user'])
    ->middleware(['auth', 'verified']);

Route::resource('admin/orders', OrderController::class)
    ->middleware(['auth', 'verified']);

Route::get('admin/invitations', function(){
    return view('dashboard.admin.posts.index', [
        "title" => "Post Undangan"
    ]);
})->middleware(['auth', 'verified']);

Route::get('admin/themes', function(){
    return view('dashboard.admin.themes.index', [
        "title" => "Themes"
    ]);
})->middleware(['auth', 'verified']);

Route::get('admin/category-themes', function(){
    return view('dashboard.admin.category.index', [
        "title" => "Category Themes"
    ]);
})->middleware(['auth', 'verified']);
