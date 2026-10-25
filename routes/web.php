<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColaboratorController;
use App\Http\Controllers\ConfirmAccountConttoller;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RhManagementController;
use App\Http\Controllers\RhUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('guest')->group(function () {
    Route::get('/confirm-account/{token}', [ConfirmAccountConttoller::class, 'confirmAccount'])->name('confirmAccount');
    Route::post('/confirm-account', [ConfirmAccountConttoller::class, 'confirmAccountSubmit'])->name('confirmAccount.submit');
});

Route::middleware('auth')->group(function () {
    Route::view('/home', 'home')->name('home');

    Route::get('/home', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.home');
        } elseif (Auth::user()->role === 'rh') {
            return redirect()->route('rh.management.home');
        } else {
            die('Vai para página inicial do colaborador normal.');
        }
    })->name('home');

    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/user/profile/update-password', [ProfileController::class, 'updatePassword'])->name('user.update.updatePassword');
    Route::post('/user/profile/update-user-data', [ProfileController::class, 'updateUserData'])->name('user.update.data');
    Route::get('/departments', [DepartmentController::class, 'index'])->name('department.index');

    Route::get('/departments/new', [DepartmentController::class, 'create'])->name('department.new');
    Route::post('/departments/create-departament', [DepartmentController::class, 'store'])->name('department.create');
    Route::get('/departments/edit-departament/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('/departments/update-departament', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('/departments/delete-departament/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
    Route::get('/departments/delete-departament-confirm/{id}', [DepartmentController::class, 'confirmDelete'])->name('department.confirmDelete');

    Route::get('/rh-users', [RhUserController::class, 'index'])->name('colaborators.rhUsers.index');
    Route::get('/rh-users/new-colaborator', [RhUserController::class, 'newColaborator'])->name('colaborators.rhUsers.newColaborator');
    Route::post('/rh-users/create-colaborator', [RhUserController::class, 'createColaborator'])->name('colaborators.rhUsers.createColaborator');
    Route::get('/rh-users/edit-colaborator/{id}', [RhUserController::class, 'editRhColaborator'])->name('colaborators.rhUsers.editRhColaborator');
    Route::post('/rh-users/update-colaborator', [RhUserController::class, 'updateRhColaborator'])->name('colaborators.rhUsers.updateColaborator');
    Route::get('/rh-users/delete-colaborator/{id}', [RhUserController::class, 'deleteRhColaborator'])->name('colaborators.rhUsers.delete-rh-user');
    Route::get('/rh-users/confirm-delete-colaborator/{id}', [RhUserController::class, 'confirmDeleteRhColaborator'])->name('colaborators.rhUsers.confirmDelete');
    Route::get('/rh-users/restore/{id}', [RhUserController::class, 'restoreRhColaborator'])->name('colaborators.rhUsers.restore');

    Route::get('/rh-users/management/home', [RhManagementController::class, 'home'])->name('rh.management.home');
    Route::get('/rh-users/management/new-colaborator', [RhManagementController::class, 'newColaborator'])->name('rh.management.newColaborator');
    Route::get('/rh-users/management/edit-colaborator/{id}', [RhManagementController::class, 'editColaborator'])->name('rh.management.editColaborator');
    Route::post('/rh-users/management/update-colaborator', [RhManagementController::class, 'updateColaborator'])->name('rh.management.updateColaborator');
    Route::get('/rh-users/management/details/{id}', [RhManagementController::class, 'showDetails'])->name('rh.management.details');
    Route::post('/rh-users/management/create-colaborator', [RhManagementController::class, 'createColaborator'])->name('rh.management.createColaborator');
    Route::get('/rh-users/management/delete/{id}', [RhManagementController::class, 'deleteColaborator'])->name('rh.management.deleteColaborator');
    Route::get('/rh-users/management/delete-confirm/{id}', [RhManagementController::class, 'deleteColaboratorConfirm'])->name('rh.management.delete-confirm');
    Route::get('/rh-users/management/restore/{id}', [RhManagementController::class, 'restoreColaborator'])->name('rh.management.restore');

    Route::get('/colaborators', [ColaboratorController::class, 'index'])->name('colaborators.index');
    Route::get('/colaborators/details/{id}', [ColaboratorController::class, 'showDetails'])->name('colaborators.showDetails');

    Route::get('/colaborators/delete/{id}', [ColaboratorController::class, 'deleteColaborator'])->name('colaborators.delete');
    Route::get('/colaborators/delete-confirm/{id}', [ColaboratorController::class, 'deleteColaboratorConfirm'])->name('colaborators.delete.confirm');
    Route::get('/colaborators/restore/{id}', [ColaboratorController::class, 'restoreColaborator'])->name('colaborators.restore');

    Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
});
