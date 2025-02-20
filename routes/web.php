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
    Route::get('/admin/posts-management', [AdminController::class, 'managePosts'])->name('admin.posts-management');

    Route::get('/admin/posts/create', [AdminController::class, 'createPost'])->name('admin.create-posts');
    Route::post('/admin/posts/store', [AdminController::class, 'storePost'])->name('admin.store-post');

    Route::get('/admin/edit-post/{id}', [AdminController::class, 'editPost'])->name('admin.edit-post');
    Route::post('/admin/edit-post', [AdminController::class, 'updatePost'])->name('admin.update-post');

    Route::get('/admin/delete-post/{id}', [AdminController::class, 'deletePost'])->name('admin.delete-post');

    Route::post('/posts/{id}/toggle-visibility', [AdminController::class, 'toggleVisibility'])->name('admin.toggle-visibility');
});
