<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ---------------------------
// ADMIN LOGIN ROUTES
// ---------------------------

// Show login form
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

// Handle login POST (checks admin_users table)
Route::post('/admin/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $admin = DB::table('admin_users')->where('email', $request->email)->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        Session::put('admin_logged_in', true);
        Session::put('admin_email', $admin->email);
        return redirect()->route('admin.dashboard');
    } else {
        return back()->with('error', 'Invalid credentials.');
    }
})->name('admin.login.submit');

// Admin logout
Route::get('/admin/logout', function () {
    Session::forget('admin_logged_in');
    Session::forget('admin_email');
    return redirect()->route('admin.login');
})->name('admin.logout');

// ---------------------------
// ADMIN DASHBOARD
// ---------------------------

Route::get('/admin/dashboard', function () {
    if (!Session::get('admin_logged_in')) {
        return redirect()->route('admin.login')->with('error', 'Please log in first.');
    }
    return view('admin.dashboard');
})->name('admin.dashboard');

// ---------------------------
// ADMIN PANEL (CRUD) ROUTES - PROTECTED
// ---------------------------
//Route::prefix('admin')->middleware('admin.auth')->group(function () {

    // BLOGS
    Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    // WORKS
    Route::get('works', [WorkController::class, 'index'])->name('works.index');
    Route::get('works/create', [WorkController::class, 'create'])->name('works.create');
    Route::post('works', [WorkController::class, 'store'])->name('works.store');
    Route::get('works/{work}/edit', [WorkController::class, 'edit'])->name('works.edit');
    Route::put('works/{work}', [WorkController::class, 'update'])->name('works.update');
    Route::delete('works/{work}', [WorkController::class, 'destroy'])->name('works.destroy');

    // ARTICLES
    Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
;

// ---------------------------
// API endpoints (public)
// ---------------------------
Route::get('/api/blogs', [BlogController::class, 'apiIndex']);
Route::get('/api/articles', [ArticleController::class, 'apiIndex']);
Route::get('/api/works', [WorkController::class, 'apiIndex']);
