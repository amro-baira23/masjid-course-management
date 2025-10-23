<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get("/things", [UserController::class,'thing']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('user-auth')->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('/', [AuthController::class, 'profile']);
        Route::post('/', [AuthController::class, 'editProfile']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::middleware('manage-user')->prefix('users')->group(function () {
        Route::post('/', [UserController::class, 'store']);
        Route::post('/{user}', [UserController::class, 'edit']);
        Route::get('/', [UserController::class, 'index'])->name("index");
        Route::get('/{user}', [UserController::class, 'get']);
        Route::delete('/{user}', [UserController::class, 'delete']);
    });

    Route::middleware('manage-user')->prefix('roles')->group(function () {
        Route::post('/', [RoleController::class, 'addRole']);
        Route::post('/{role}', [RoleController::class, 'editRole']);
        Route::get('/', [RoleController::class, 'getRoles']);
        Route::get('/{role}', [RoleController::class, 'getRoleInformation']);
        Route::delete('/{role}', [RoleController::class, 'deleteRole']);
    });

    Route::middleware("manage-user")->prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'getPermissions']);
        Route::get('/{permission}', [PermissionController::class, 'getPermissionInformation']);
    });
    // Route::middleware("manage-user")->prefix('activities')->group(function () {
    //     Route::get('/', [ActivityController::class, 'index']);
    // });
});