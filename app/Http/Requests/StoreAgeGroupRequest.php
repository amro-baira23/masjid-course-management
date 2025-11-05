<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAgeGroupRequest extends FormRequest
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
            /* @example college first year */
            "name" => ["required","unique:age_groups,name"],
            /* @example 2001-01-01 */
            "min_birthdate" => ["required","date",Rule::date()->format("Y-m-01")],
            /* @example 2005-01-01 */
            "max_birthdate" => ["required","date","after:min_birthdate",Rule::date()->format("Y-m-01")],
        ];
    }
}
