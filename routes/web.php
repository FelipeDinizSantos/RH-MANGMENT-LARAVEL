<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {
    Route::view('/home', 'home')->name('home');
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');

    Route::post('/user/profile/update-password', [ProfileController::class, 'updatePassword'])->name('user.update.updatePassword');
    Route::post('/user/profile/update-user-data', [ProfileController::class, 'updateUserData'])->name('user.update.data');

    Route::get('/departments' , [DepartmentController::class, 'index'])->name('department.index');

    Route::get('/departments/new', [DepartmentController::class, 'create'])->name('department.new');
    Route::post('/departments/create-departament', [DepartmentController::class, 'store'])->name('department.create');

    Route::get('/departments/edit-departament/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('/departments/update-departament', [DepartmentController::class, 'update'])->name('department.update');
});
