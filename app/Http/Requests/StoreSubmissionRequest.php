<?php

namespace App\Http\Requests;

use App\Models\Option;
use App\Models\Quiz;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            /* @example 1 */
            "quiz_id" => ["required","integer","exists:quizzes,id"],
            /* @example [1,2] */
            "option_ids" => ["required","array"],
            "option_ids.*" => ["required","integer"],
        ];
    }

    public function after(){
        return [
            function (Validator $validator){
                if(!$this->OptionsBelongToQuiz()){
                    $validator->errors()->add(
                        "option_ids",
                        "Option IDs must belong to the provided quiz"
                    );
                }
            }
        ];
    }

    private function OptionsBelongToQuiz(){
        $quiz = Quiz::find($this->quiz_id);
        return  Option::query()
            ->whereIn("id",$this->option_ids)
            ->whereHas("question",function($query) use ($quiz){
                return $query->whereAttachedTo($quiz,"quizzes");
            })->count() == sizeof($this->option_ids);
    }
}
