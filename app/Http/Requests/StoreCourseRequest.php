<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
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
            "course_name" => ["required","string", "min:3"],

            /* @example 1 */
            "subject_id" => ["exclude_with:subject_name","required","integer","exists:subjects,id"],
            "subject_name" => ["exclude_with:subject_id","required", "min:3"],
            /* @example 1 */
            "age_group_id" => ["exclude_with:age_group","required_with:subject_name","integer","exists:age_groups,id"],
            /* @example sophomores */
            "age_group" => ["exclude_with:age_group","required_with:subject_name","string"],

          
            /* @example 01:00 */
            "start_time" => ["required", Rule::date()->format("H:i")],
            /* @example 01:40 */
            "end_time" => ["required", Rule::date()->format("H:i")],
            /* @example 1,2,3 */
            "days" => ["required","regex:/^[1-7](,[1-7])*$/"],
            /* @example 2019-12-01 */
            "start_date" => ["required","date"],
            /* @example 2019-12-15 */
            "end_date" => ["present","nullable", "date"],

            "groups.*" => ["required", "array"],
            /* @example course_name_01 */
            "groups.*.name" => ["required", "string"],
            /* @example 1 */
            "groups.*.teacher_id" => ["required", "integer","exists:teachers,id"],

        ];
    }
}
