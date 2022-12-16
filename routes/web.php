<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\PostController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware(['auth', 'verified']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (){
    Route::prefix('/admin')->name('admin.')
        ->group(function (){
            Route::get('/', [HomeController::class, 'index'])->name('home');

            Route::prefix('/category')->name('categories.')
                ->group(function (){
                    Route::get('/', [CategoryController::class, 'index'])->name('index');
                    Route::get('/create', [CategoryController::class, 'create'])->name('getFormAdd');
                    Route::post('/store', [CategoryController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [CategoryController::class, 'getEdit'])->name('getEdit');
                    Route::post('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
                    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
                });

            Route::prefix('/tag')->name('tags.')
                ->group(function (){
                    Route::get('/', [TagController::class, 'index'])->name('index');
                    Route::get('/create', [TagController::class, 'create'])->name('getFormAdd');
                    Route::post('/store', [TagController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [TagController::class, 'getEdit'])->name('getEdit');
                    Route::post('/edit/{id}',[TagController::class, 'edit'])->name('edit');
                    Route::get('/delete/{id}', [TagController::class, 'delete'])->name('delete');
                });

            Route::prefix('/post')->name('posts.')
                ->group(function (){
                    Route::get('/', [PostController::class, 'index'])->name('index');
                    Route::get('/create', [PostController::class, 'create'])->name('getFormAdd');
                    Route::post('/store', [PostController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [PostController::class, 'getEdit'])->name('getEdit');
                    Route::post('/edit/{id}', [PostController::class, 'edit'])->name('edit');
                    Route::get('/delete/{id}', [PostController::class, 'delete'])->name('delete');
                });
        });
});
