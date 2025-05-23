<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoupleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ThemeController;
use App\Models\Song;

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
Route::get('/katalog/{theme:slug}', [PageController::class, 'indexDemoUndangan'])->name('theme.demo');

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
    /* Admin Dashboard Route Controll
     */
    Route::get('/admin/dashboard', [PageController::class, 'indexDashboard']);
    /* Admin Staff users Route Controll
     */
    Route::resource('/admin/staff', StaffController::class)
        ->parameters(['staff' => 'user'])
        ->except(['destroy', 'show'])
        ->middleware('super');
    /* Admin Orders Route Controll
     */
    Route::resource('/admin/orders', OrderController::class)
        ->except(['destroy', 'edit', 'show']);
    /* Admin Undangan Route Controll
     */
    Route::resource('/admin/invitations', PostController::class)
        ->parameters(['invitations' => 'undangan'])
        ->except(['show', 'edit']);
    
    Route::put('/admin/invitations/couples/{couple:id}', [PostController::class, 'updateCouple']);
    
    Route::post('/admin/invitations/events', [PostController::class, 'storeEvents']);
    Route::put('/admin/invitations/events/{event:id}', [PostController::class, 'updateEvent']);
    
    Route::post('/admin/invitations/stories', [PostController::class, 'storeStories']);
    Route::put('/admin/invitations/stories/{story:id}', [PostController::class, 'updateStory']);
    
    Route::post('/admin/invitations/donations', [PostController::class, 'storeDonations']);
    Route::put('/admin/invitations/donations/{donation:id}', [PostController::class, 'updateDonation']);
    
    Route::post('/admin/invitations/galleries', [PostController::class, 'storeGalleries']);
    Route::put('/admin/invitations/galleries/{gallery:id}', [PostController::class, 'updateGallery']);
    Route::get('/admin/invitations/galleries/return', [PostController::class, 'returnGallery'])
        ->name('gallery.return');
    /* Admin Themes Route Controll
     */
    Route::resource('/admin/themes', ThemeController::class)
        ->except(['destroy']);
    /* Admin Tags Route Controll
     */
    Route::resource('/admin/tag-themes', TagController::class)
        ->parameters(['tag-themes' => 'tag'])
        ->except(['show']);
    Route::post("/admin/tag-themes/getData", [TagController::class, 'getTags'])
        ->name('get-tags');
    /* Admin Categories Route Controll
     */ 
    Route::resource('/admin/category-themes', CategoryController::class)
        ->parameters(['category-themes' => 'category'])
        ->except(['show']);
    /* Admin banks Route Controll
        */ 
    Route::resource('/admin/banks', BankController::class)
        ->except(['destroy', 'show']);
    /* Admin riwayat Route Controll
     */ 
    Route::get('/admin/riwayat-orders', function(){
        return view('layouts.misc-under-maintenance');
    });
    
    // Route::resource('/admin/songs', SongController::class);
});
Route::middleware(['auth', 'verified'])->group(function (){
    /* User Profil Route Controll
     */
    Route::get('/admin/@{user}', [UserController::class, 'index']);
    Route::get('/admin/@{user}/edit', [UserController::class, 'edit']);
    Route::put('/admin/@{user}', [UserController::class, 'update']);

    /* User Settings Route Controll
     */
    Route::get('/admin/settings', [PageController::class, 'indexSettings']);
    Route::post('/admin/settings/pass-confirm', [UserController::class, 'passConfirm']);
    Route::post('/admin/settings/pass-edit', [UserController::class, 'passEdit']);
    Route::post('/admin/settings/email-edit', [UserController::class, 'emailEdit']);
});