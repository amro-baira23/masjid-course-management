<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexEnrollmentCourseRequest;
use App\Http\Requests\IndexEnrollmentStudentRequest;
use App\Models\Enrollment;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\StudentResource;
use App\Models\Course;
use App\Models\Student;

class EnrollmentController extends Controller
{
    public function indexByStudents(IndexEnrollmentStudentRequest $request)
    {
        $data = Student::with("courses.subject.age_group","user");
        
        if ($request->student_ids != null){
            $data = $data->whereIn("id",$request->student_ids);
        }
        $data = $data->get();
        return StudentResource::collection($data);
    }

    public function indexByCourses(IndexEnrollmentCourseRequest $request)
    {
        $data = Course::with("students");
        if ($request->course_ids != null){
            $data = $data->whereIn("id",$request->course_ids);
        }
        $data = $data->get();
        return CourseResource::collection($data);
    }
    
    public function show()
    {
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $entrollment = Enrollment::create([
            "student_id" => $request->student_id,
            "course_id" => $request->course_id,
        ]);
        return $entrollment;
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
