<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStudentRequest;
use App\Http\Requests\RegisterTeacherRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }
    public function registerAdmins(RegisterUserRequest $request){
        $admin = $this->userService->registerAdmins($request);
        return $admin;
    }

    public function registerTeachers(RegisterTeacherRequest $request){
        $teacher = $this->userService->registerTeachers($request);
        return $teacher;
    }
    
    public function registerStudents(RegisterStudentRequest $request){
        $student = $this->userService->registerStudents($request);
        return $student;
    }
    
   
}
