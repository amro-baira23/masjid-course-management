<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
    Route::post('/sessions', [AuthController::class, 'login']);
    Route::put("/sessions", [AuthController::class, 'refresh'] );
    Route::delete('/sessions', [AuthController::class, 'logout']);
});

Route::prefix('/users')->group(function () {
    Route::post('/admins', [UserController::class, 'registerAdmins']);
    Route::post('/teachers', [UserController::class, 'registerTeachers']);
    Route::post('/students', [UserController::class, 'registerStudents']);
});

Route::prefix('/quizzes')->group(function () {
    Route::post('/', [QuizController::class, 'store']);
});

Route::prefix('/enrollments')->group(function () {

});



Route::prefix('/courses')->group(function () {
    Route::post('/', [CourseController::class, 'store']);
    
});


Route::prefix('/subjects')->group(function () {
    Route::post('/', [SubjectController::class, 'store']);
    
});


// Route::middleware('manage-user')->prefix('users')->group(function () {
//     Route::post('/', [UserController::class, 'store']);
//     Route::post('/{user}', [UserController::class, 'edit']);
//     Route::get('/', [UserController::class, 'index'])->name("index");
//     Route::get('/{user}', [UserController::class, 'get']);
//     Route::delete('/{user}', [UserController::class, 'delete']);
// });

// Route::middleware('manage-user')->prefix('roles')->group(function () {
//     Route::post('/', [RoleController::class, 'addRole']);
//     Route::post('/{role}', [RoleController::class, 'editRole']);
//     Route::get('/', [RoleController::class, 'getRoles']);
//     Route::get('/{role}', [RoleController::class, 'getRoleInformation']);
//     Route::delete('/{role}', [RoleController::class, 'deleteRole']);
// });

// Route::middleware("manage-user")->prefix('permissions')->group(function () {
//     Route::get('/', [PermissionController::class, 'getPermissions']);
//     Route::get('/{permission}', [PermissionController::class, 'getPermissionInformation']);
// });
// Route::middleware("manage-user")->prefix('activities')->group(function () {
//     Route::get('/', [ActivityController::class, 'index']);
// });