<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class   StoreQuizRequest extends FormRequest
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
            /* @example quiz 1 */
            "name" => ["required","string"],
            /* @example 1 */
            "course_id" => ["required","integer","exists:courses,id"],
            /* @example [] */
            "question_ids" => ["present","array"],
            "question_ids.*" => ["required","integer","exists:questions,id"],
            "questions.*.text" =>["required","string"],
            "questions.*.options.*.text" =>["required","string"],
            "questions.*.options.*.is_correct" =>["required","boolean"],
            "creation_mode" => ["required",Rule::in(["regular","random"])],
        ];
    }
}
