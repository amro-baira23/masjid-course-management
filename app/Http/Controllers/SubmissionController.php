<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Http\Requests\StoreSubmissionRequest;
use App\Http\Requests\UpdateSubmissionRequest;
use App\Http\Resources\SubmissionResource;
use App\Models\Answer;
use App\Models\Option;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubmissionRequest $request)
    {
        $submission = DB::transaction(function() use ($request){
            $submission = Submission::create([
                "quiz_id" => $request->quiz_id,
                "student_id" => $request->user()->student->id,
            ]);
            $options = Option::whereIn("id",$request->option_ids)->get();
            $score = 0;

            foreach ($options as $option){
                // echo $option[0];
                Answer::create([
                    "option_id" => $option->id,                    
                    "submission_id" => $submission->id,                    
                ]);
                if ($option->is_correct){
                    $score += 2;
                }
            }
            $submission->score = $score;
            $submission->save();
            return $submission;
        });
        $submission->load("student","quiz");
        return SubmissionResource::make($submission);
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubmissionRequest $request, Submission $submission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        //
    }
}
