<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SubscribeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Mail\WelcomeMail;
use App\Models\Blog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


// resource - blog

Route::get('/',[BlogController::class,'index']);
Route::get('/blogs/{blog:slug}', [BlogController::class,'show']);

Route::middleware(AdminMiddleware::class)->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/blogs/create',[AdminController::class,'create']);
    Route::post('/admin/blogs/store',[AdminController::class,'store']);
    Route::delete('/admin/blogs/{blog:slug}/delete',[AdminController::class,'destroy']);
    Route::get('/admin/blogs/{blog:slug}/edit',[AdminController::class,'edit']);
    Route::patch('/admin/blogs/{blog:slug}/update',[AdminController::class,'update']);
});

Route::middleware(AuthMiddleware::class)->group(function(){
    Route::get('/categories/{category:slug}', [BlogController::class,'showCatBlog']);
    Route::get('/authors/{author:username}', [BlogController::class,'showAuthorBlog']);
    Route::post('/logout', [AuthController::class,'logout']);
    Route::post('/blogs/{blog:slug}/comments', [CommentController::class,'store']);
    Route::post('/blogs/{blog:slug}/toggle-subscribe', [SubscribeController::class,'toggle'])->name('blogs.toggle');
});

Route::middleware('guest')->group(function(){
    Route::get('/register', [AuthController::class,'create']);
    Route::post('/register', [AuthController::class,'store']);
    Route::get('/login', [AuthController::class,'login']);
    Route::post('/login', [AuthController::class,'loginStore']);
});

// resource - category
// Route::get('/categories', [CategoryController::class,'index']);

// Route::get('/categories/{slug}', [CategoryController::class,'show']);