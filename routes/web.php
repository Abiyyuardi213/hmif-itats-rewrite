<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/struktur-organisasi', function () {
    return view('struktur-organisasi');
});

Route::get('/divisi', function () {
    return view('divisi');
});

Route::get('/program-kerja', function () {
    return view('program-kerja');
});

Route::get('/kegiatan', function () {
    return view('kegiatan');
});

Route::get('/pengumuman', function () {
    return view('pengumuman');
});

Route::get('/login-admin', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-admin', [AdminAuthController::class, 'login']);
Route::post('/logout-admin', [AdminAuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index');
    Route::post('/admin/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('/admin/role/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/admin/role/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');
});
