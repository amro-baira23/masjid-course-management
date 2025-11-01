<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\AgeGroup;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{

    public function index()
    {

    }

    public function store(StoreSubjectRequest $request)
    {
         $subject = DB::transaction(function () use ($request){
            $age_group = AgeGroup::findOr($request->age_group_id,function() use ($request) {
                return AgeGroup::create(["name" => $request->age_group]);
            });

            $subject = Subject::findOr($request->subject_id,function() use ($request ,$age_group) {
                return Subject::create([
                    "name" => $request->subject_name,
                    "age_group_id" => $age_group->id,
                ]);
            });

            return $subject;
        });
        return SubjectResource::make($subject);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        //
    }

    public function destroy(Subject $subject)
    {
        //
    }
}
