<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexEnrollmentCourseRequest;
use App\Http\Requests\IndexEnrollmentStudentRequest;
use App\Models\Enrollment;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseWithStudentsResource;
use App\Http\Resources\GroupResource;
use App\Http\Resources\StudentResource;
use App\Models\Course;
use App\Models\Group;
use App\Models\Student;

class EnrollmentController extends Controller
{

    public function index(IndexEnrollmentStudentRequest $request)
    {
        $data = Student::with("courses.subject.age_group","user");

        if ($request->student_ids != null){
            $data = $data->whereIn("id",$request->student_ids);
        }

        $data = $data->get();
        return StudentResource::collection($data);
    }

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
        $courses = Course::with("groups.students");
        if ($request->course_ids != null){
            $courses = $courses->whereIn("id",$request->course_ids);
        }
        $courses = $courses->get();

        if ($request->students_per_group){
            return CourseResource::collection($courses);
        }
        
        $courses->map(function($item, $key){
            $item->students = $item->groups->pluck("students")
            ->flatten(1);
            return $item;
        });
        return CourseWithStudentsResource::collection($courses);
    }
    
    public function show()
    {
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $entrollment = Enrollment::create([
            "student_id" => $request->student_id,
            "group_id" => $request->group_id,
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
