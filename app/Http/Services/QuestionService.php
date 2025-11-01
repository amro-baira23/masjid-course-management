<?php
namespace App\Http\Services;

use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;

class QuestionService{

    public function bulkCreate(array $questions, Quiz|null $quiz=null){
        $qs_data = [];
        foreach($questions as $question){
            $qs = Question::create([
                "text" => $question["text"],
                "subject_id" => $quiz->course->subject_id,
            ]);
            foreach($question["options"] as &$option){
                $option["question_id"] = $qs->id;
            }

            Option::fillAndInsert($question["options"]);
            $qs_data[] = $qs->id;
        }        
        return  $qs_data;
        
    }

}