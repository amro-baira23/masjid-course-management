<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            "subject_name" => ["required", "min:3"],
            /* @example 1 */
            "age_group_id" => ["exclude_with:age_group","required","integer","exists:age_groups,id"],
            /* @example sophomores */
            "age_group" => ["exclude_with:age_group","required","string"],

        ];
    }
}
