<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Http\Resources\QuizResource;
use App\Http\Services\QuestionService;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{

    public function __construct(private QuestionService $questionService)
    {
        
    }

    public function index()
    {
        $data = Quiz::with("questions.options")->paginate(20);
        return QuizResource::collection($data);
    }

    public function show(Quiz $quiz)
    {
    }

    public function store(StoreQuizRequest $request)
    {
        $quiz = DB::transaction(function() use ($request){
            $quiz = Quiz::create([
                "course_id" => $request->course_id,
                "name" => $request->name,
            ]);
            
            $question_ids = array_merge(
                $request->question_ids,
                $this->questionService->bulkCreate($request->questions, $quiz)
            );

            $quiz->questions()->attach($question_ids);
            
            return $quiz;  
        });
        $quiz->load("questions.options");
        return QuizResource::make($quiz);
    }

    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
    }

    public function destroy(Quiz $quiz)
    {
    }
}
