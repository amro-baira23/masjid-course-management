<?php
namespace App\Http\Services;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\AgeGroup;
use App\Models\Course;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class CourseService{


    public function store(StoreCourseRequest $request){
        $course = DB::transaction(function () use ($request){
            $age_group = AgeGroup::findOr($request->age_group_id,function() use ($request) {
                return AgeGroup::create(["name" => $request->age_group]);
            });

            $subject = Subject::findOr($request->subject_id,function() use ($request ,$age_group) {
                return Subject::create([
                    "name" => $request->subject_name,
                    "age_group_id" => $age_group->id,
                ]);
            });

            $course = Course::create([
                    "name" => $request->course_name,
                    "subject_id" => $subject->id,
                    "teacher_id" => $request->teacher_id,
                    "start_time" => $request->start_time,
                    "end_time" => $request->end_time,
                    "days" => $request->days,
                    "start_date" => $request->start_date,
                    "end_date" => $request->end_date,
            ]);
  
            return $course;
        });
        
        return CourseResource::make($course);
    }

}