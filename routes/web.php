<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

/** PUBLIC ROUTES */
Route::get('/', [BlogController::class, 'home'])->name('blog.home');
Route::get('/categories', [BlogController::class, 'categories'])->name('blog.categories');
Route::get('/about', [BlogController::class, 'about'])->name('blog.about');
Route::get('/contact', [BlogController::class, 'contact'])->name('blog.contact');
Route::post('/send-mail', [MailController::class, 'sendMail'])->name('blog.sendMail');

Route::get('/post/{slug}/{id}', [BlogController::class, 'show'])->name('blog.post');

/** AUTH ROUTES */
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

/** ADMIN ROUTES */
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
});
