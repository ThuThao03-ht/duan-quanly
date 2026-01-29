<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TrackingController;
use App\Http\Controllers\Admin\ProfileController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/tracking', [TrackingController::class, 'index'])->name('admin.tracking');
    Route::post('/tracking', [TrackingController::class, 'store'])->name('admin.tracking.store');
    Route::post('/tracking/{id}/update', [TrackingController::class, 'update'])->name('admin.tracking.update');
    Route::delete('/tracking/{id}', [TrackingController::class, 'destroy'])->name('admin.tracking.destroy');
    Route::get('/tracking/export', [TrackingController::class, 'export'])->name('admin.tracking.export');
    
    // Đổi mật khẩu
    Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('admin.change-password');
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('admin.update-password');

    // Hướng dẫn sử dụng
    Route::get('/instructions', [DashboardController::class, 'instructions'])->name('admin.instructions');

    // Cài đặt hệ thống
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings');
    Route::get('/settings/backup', [\App\Http\Controllers\Admin\SettingsController::class, 'backup'])->name('admin.settings.backup');
    Route::get('/settings/backup/realtime', [\App\Http\Controllers\Admin\SettingsController::class, 'downloadRealtimeBackup'])->name('admin.settings.backup.realtime');
    Route::get('/settings/backup/create', [\App\Http\Controllers\Admin\SettingsController::class, 'createSnapshot'])->name('admin.settings.backup.create');
    Route::get('/settings/backup/{filename}', [\App\Http\Controllers\Admin\SettingsController::class, 'downloadBackup'])->name('admin.settings.backup.download');
    Route::post('/settings/import', [\App\Http\Controllers\Admin\SettingsController::class, 'import'])->name('admin.settings.import');
});

Route::middleware(['auth', 'role:department'])->prefix('department')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Department\DepartmentController::class, 'dashboard'])->name('department.dashboard');
    Route::get('/orders', [App\Http\Controllers\Department\OrderController::class, 'index'])->name('department.orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\Department\OrderController::class, 'show'])->name('department.orders.show');
    Route::post('/orders/{id}/note', [App\Http\Controllers\Department\OrderController::class, 'addNote'])->name('department.orders.addNote');
    Route::get('/guide', [App\Http\Controllers\Department\DepartmentController::class, 'guide'])->name('department.guide');
    Route::get('/change-password', [App\Http\Controllers\Department\DepartmentController::class, 'changePassword'])->name('department.password.change');
    Route::post('/change-password', [App\Http\Controllers\Department\DepartmentController::class, 'updatePassword'])->name('department.password.update');
});
