<?php

use App\Http\Controllers\UserController;
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

//Admin Login
Route::get('/admin', [UserController::class, 'indexLogin'])
    ->name('loginAdmin')
    ->middleware('guest');
Route::post('/admin', [UserController::class, 'adminLogin']);
