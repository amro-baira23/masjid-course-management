<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkUpdateStudentAgeGroupRequest;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StudentResource::collection(Student::paginate(20));
    }

   
    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return StudentResource::make($student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    public function bulkUpdateAgeGroups(BulkUpdateStudentAgeGroupRequest $request){
        Student::whereIn("id",$request->student_ids)
            ->update([
                "age_group_id" => $request->age_group_id
            ]);
        
        $students =  Student::with("age_group")
            ->whereIn("id",$request->student_ids)->get();
        return StudentResource::collection($students);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
