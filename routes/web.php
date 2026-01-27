<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\Admin\TrackingController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/tracking', [TrackingController::class, 'index'])->name('admin.tracking');
    Route::post('/tracking', [TrackingController::class, 'store'])->name('admin.tracking.store');
    Route::post('/tracking/{id}/update', [TrackingController::class, 'update'])->name('admin.tracking.update');
});

Route::middleware(['auth', 'role:department'])->prefix('department')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Department\DepartmentController::class, 'dashboard'])->name('department.dashboard');
    Route::get('/orders', [App\Http\Controllers\Department\OrderController::class, 'index'])->name('department.orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\Department\OrderController::class, 'show'])->name('department.orders.show');
    Route::post('/orders/{id}/note', [App\Http\Controllers\Department\OrderController::class, 'addNote'])->name('department.orders.addNote');
});
