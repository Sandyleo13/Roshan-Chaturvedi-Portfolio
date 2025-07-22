<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ArticleController;

Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/latest', [BlogController::class, 'latest']);
Route::get('/blogs/{slug}', [BlogController::class, 'showBySlug']);

Route::get('/works', [WorkController::class, 'index']);
Route::get('/works/{slug}', [WorkController::class, 'showBySlug']);

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/latest', [ArticleController::class, 'latest']);
Route::get('/articles/{slug}', [ArticleController::class, 'showBySlug']);



