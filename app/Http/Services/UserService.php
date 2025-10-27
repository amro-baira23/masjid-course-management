<?php
namespace App\Http\Services;

use App\Http\Requests\RegisterStudentRequest;
use App\Http\Requests\RegisterTeacherRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\TeacherResource;
use App\Models\Proficiency;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService{

    public function __construct(private AuthService $authService)
    {
            
    }

    private function createUsers(RegisterUserRequest $request, string $role ,bool $active= false){
        $role = Role::where(["name" => $role])->firstOrCreate([
            "name" => $role
        ]);

        $user = User::create([
            "first_name" => $request->first_name, 
            "last_name" => $request->last_name, 
            "username" => $request->username,
            "password" => Hash::make($request->password),
            "email" => $request->email, 
            "phone_number" => $request->phone_number, 
            "is_active" => $active,
            "role_id" => $role->id
        ]);

        $access_token = $this->authService->authinticateUser($user);
        $user->access_token = $access_token;

        return $user;
    }

    public function registerAdmins(RegisterUserRequest $request){
        $data = $this->createUsers($request, "admin");       
        return AdminResource::make($data);
    }

    public function registerTeachers(RegisterTeacherRequest $request){
        $data = DB::transaction(function () use ($request){
            $user = $this->createUsers($request, "teacher");

            $proficiency = Proficiency::findOr($request->proficiency_id, function () use ($request){
                return Proficiency::create([
                    "name" => $request->proficiency,
                ]);
            });

            $teacher =  Teacher::create([
                "address" => $request->address,
                "birth_date" => $request->birth_date,
                "proficiency_id" => $proficiency->id,
                "user_id" => $user->id,
            ]);
            $teacher->access_token = $user->access_token;

            return $teacher;
        });
        
        return TeacherResource::make($data);
    }
    
    public function registerStudents(RegisterStudentRequest $request){
         $student = DB::transaction(function () use ($request){
            $user = $this->createUsers($request, "student");

            $student = Student::create([
                "birth_date" => $request->birth_date,
                "education" => $request->education,
                "father_name" => $request->father_name,
                "father_occupation" => $request->father_occupation,
                "mother_name" => $request->mother_name,
                "mother_occupation" => $request->mother_occupation,
                "address" => $request->address,
                "gender" => $request->gender,
                "user_id" => $user->id,
            ]);
            $student->access_token = $user->access_token;

            return $student;
        });

        return StudentResource::make($student);
    }
    
}