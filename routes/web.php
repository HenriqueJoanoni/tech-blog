<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
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

/** EDITOR ROUTES */
Route::middleware(['auth', 'checkPerm:' . config('editor_access')])->group(function () {
    /** ADMIN HOMEPAGE */
    Route::get('/admin', [PostController::class, 'dashboard'])->name('admin.dashboard');

    /** POSTS RELATED ROUTES */
    Route::get('/admin/posts-management', [PostController::class, 'managePosts'])->name('admin.posts-management');

    Route::get('/admin/posts/create', [PostController::class, 'createPost'])->name('admin.create-posts');
    Route::post('/admin/posts/store', [PostController::class, 'storePost'])->name('admin.store-post');

    Route::get('/admin/edit-post/{id}', [PostController::class, 'editPost'])->name('admin.edit-post');
    Route::post('/admin/edit-post', [PostController::class, 'updatePost'])->name('admin.update-post');

    Route::get('/admin/delete-post/{id}', [PostController::class, 'deletePost'])->name('admin.delete-post');
    Route::post('/admin/{id}/toggle-visibility', [PostController::class, 'toggleVisibility'])->name('admin.toggle-visibility');
});

/** ADMIN ROUTES */
Route::middleware(['auth', 'checkPerm:' . config('admin_access')])->group(function () {
    /** ADMIN HOMEPAGE */
    Route::get('/admin', [PostController::class, 'dashboard'])->name('admin.dashboard');

    /** POSTS RELATED ROUTES */
    Route::get('/admin/posts-management', [PostController::class, 'managePosts'])->name('admin.posts-management');

    Route::get('/admin/posts/create', [PostController::class, 'createPost'])->name('admin.create-posts');
    Route::post('/admin/posts/store', [PostController::class, 'storePost'])->name('admin.store-post');

    Route::get('/admin/edit-post/{id}', [PostController::class, 'editPost'])->name('admin.edit-post');
    Route::post('/admin/edit-post', [PostController::class, 'updatePost'])->name('admin.update-post');

    Route::get('/admin/delete-post/{id}', [PostController::class, 'deletePost'])->name('admin.delete-post');
    Route::post('/admin/{id}/toggle-visibility', [PostController::class, 'toggleVisibility'])->name('admin.toggle-visibility');

    /** USER RELATED ROUTES */
    Route::get('/admin/users', [UserController::class, 'users'])->name('admin.users');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/user-profile/{id}', [UserController::class, 'userProfile'])->name('admin.user-profile');
    Route::put('/admin/user-profile', [UserController::class, 'updateProfile'])->name('admin.update-profile');

    Route::get('/admin/user/create', [UserController::class, 'createUser'])->name('admin.create-user');
    Route::post('/admin/user/store', [UserController::class, 'storeUser'])->name('admin.store-user');
    Route::get('/admin/user/delete-user/{id}', [UserController::class, 'deleteUser'])->name('admin.delete-user');
    Route::get('/admin/user/edit-user/{id}', [UserController::class, 'editUser'])->name('admin.edit-user');
    Route::put('/admin/user/edit-user', [UserController::class, 'updateUser'])->name('admin.update-user');
    Route::get('/admin/user/reset-password/{id}', [UserController::class, 'resetPassword'])->name('admin.reset-password');
    Route::post('/admin/update-permissions', [UserController::class, 'updatePermissions'])->name('admin.update-permissions');
});
