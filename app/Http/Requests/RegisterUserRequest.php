<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
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
            "first_name" => ["required","string", "min:3"],
            "last_name" => ["required","string", "min:3"],
            /* @example username_12 */
            "username" => ["required","alpha_dash", Rule::unique("users", "username")],
            /* @example password123 */
            "password" => ["required", "confirmed", Password::min(8)->numbers()],
            /* @example password123 */
            "password_confirmation" => ["required", "same:password"],
            "email" => ["required", "email",Rule::unique("users", "email")],
            /* @example 0900000000 */
            "phone_number" => ["required","string", "size:10"],
        ];
    }
}
