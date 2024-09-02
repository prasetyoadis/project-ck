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

//Admin Login
Route::get('/admin', [UserController::class, 'indexLogin'])
    ->name('login')
    ->middleware('guest');
Route::post('/admin', [UserController::class, 'adminLogin']);
Route::post('/logout', [UserController::class, 'adminLogout']);

Route::get('admin/dashboard', function(){
    return view('dashboard.admin.index');
})->middleware(['auth']);