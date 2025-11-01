<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Services\CourseService;

class CourseController extends Controller
{

    public function __construct(private CourseService $courseService)
    {
        
    }
 
    public function index()
    {
        
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
