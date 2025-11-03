<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Http\Services\CourseService;
use App\Models\User;

class CourseController extends Controller
{

    public function __construct(private CourseService $courseService)
    {
        
    }
 
    public function index()
    {
        $courses = Course::query();
        $user = request()->user();
        if ($user != null && $user->isStudent()){
            $courses->whereHas("subject",function($query) use ($user){
                return $query->where("age_group_id",$user->student->age_group_id);
            });
        }
        return CourseResource::collection($courses->paginate(20));
    }


 
    public function store(StoreCourseRequest $request)
    {
        $data = $this->courseService->store($request);
        return $data;
    }

  
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    
    public function destroy(Course $course)
    {
        //
    }
}
