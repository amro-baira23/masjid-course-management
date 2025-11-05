<?php

use App\Http\Controllers\AgeGroupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubmissionController;
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



Route::prefix('/age_groups')->group(function () {
    Route::get('/', [AgeGroupController::class, 'index']);
    Route::post('/', [AgeGroupController::class, 'store']);
    Route::put('/{ageGroup}', [AgeGroupController::class, 'update']);
    Route::post('/bulk', [AgeGroupController::class, 'bulkStore']);
    Route::delete('/bulk', [AgeGroupController::class, 'bulkDelete']);

});

Route::prefix('/enrollments')->group(function () {
    Route::get('/students', [EnrollmentController::class, 'indexByStudents']);
    Route::get('/courses', [EnrollmentController::class, 'indexByCourses']);
    Route::post('/', [EnrollmentController::class, 'store']);

});

Route::prefix('/subjects')->group(function () {
    Route::get('/', [SubjectController::class, 'index']);
    Route::post('/', [SubjectController::class, 'store']);
    
});

Route::prefix('/courses')->group(function () {
    Route::get('/', [CourseController::class, 'index']);
    Route::post('/', [CourseController::class, 'store']);
    
});

Route::prefix('/quizzes')->group(function () {
    Route::get('/', [QuizController::class, 'index']);
    Route::post('/', [QuizController::class, 'store']);
});

Route::prefix('/submissions')->group(function () {
    Route::get('/', [SubmissionController::class, 'index']);
    Route::post('/', [SubmissionController::class, 'store']);
    
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