<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreAgeGroupRequest extends FormRequest
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
            "age_groups" => ["required","array","size:2"],
            "age_groups.*.name" => ["required","string","distinct","unique:age_groups,name"],
              /* @example 2001-01-01 */
            "age_groups.*.min_birthdate" => ["required","date",Rule::date()->format("Y-m-01")],
            /* @example 2005-01-01 */
            "age_groups.*.max_birthdate" => ["required","date","after:min_birthdate",Rule::date()->format("Y-m-01")],
        ];
    }
}
