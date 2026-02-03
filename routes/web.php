<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/program-kerja', [\App\Http\Controllers\WorkProgramController::class, 'index']);

Route::get('/kegiatan', function () {
    return view('kegiatan');
});

Route::get('/pengumuman', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{slug}', [App\Http\Controllers\AnnouncementController::class, 'show'])->name('pengumuman.show');

Route::get('/merchandise', [App\Http\Controllers\MerchandiseController::class, 'index'])->name('merchandise.index');
Route::get('/merchandise/{slug}', [App\Http\Controllers\MerchandiseController::class, 'show'])->name('merchandise.show');
Route::post('/merchandise/{merchandise}/order', [App\Http\Controllers\MerchandiseController::class, 'order'])->name('merchandise.order');


Route::get('/login-admin', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-admin', [AdminAuthController::class, 'login']);
Route::post('/logout-admin', [AdminAuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index');
    Route::post('/admin/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('/admin/role/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/admin/role/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::resource('/admin/positions', App\Http\Controllers\Admin\PositionController::class, ['as' => 'admin']);
    Route::resource('/admin/divisions', App\Http\Controllers\Admin\DivisionController::class, ['as' => 'admin']);
    Route::resource('/admin/members', App\Http\Controllers\Admin\OrgMemberController::class, ['as' => 'admin']);
    Route::post('/admin/members/{member}', [App\Http\Controllers\Admin\OrgMemberController::class, 'update'])->name('admin.members.update_post');
    Route::resource('/admin/work-programs', App\Http\Controllers\Admin\WorkProgramController::class, ['as' => 'admin']);
    Route::resource('/admin/announcements', App\Http\Controllers\Admin\AnnouncementController::class, ['as' => 'admin']);
    Route::resource('/admin/merchandises', App\Http\Controllers\Admin\MerchandiseController::class, ['as' => 'admin']);

    // Merchandise Orders
    Route::get('/admin/merchandise-orders', [App\Http\Controllers\Admin\MerchandiseOrderController::class, 'index'])->name('admin.merchandise-orders.index');
    Route::put('/admin/merchandise-orders/{order}/status', [App\Http\Controllers\Admin\MerchandiseOrderController::class, 'updateStatus'])->name('admin.merchandise-orders.updateStatus');
    Route::delete('/admin/merchandise-orders/{order}', [App\Http\Controllers\Admin\MerchandiseOrderController::class, 'destroy'])->name('admin.merchandise-orders.destroy');
});

Route::get('/struktur-organisasi', [App\Http\Controllers\Admin\OrgMemberController::class, 'publicIndex']);
