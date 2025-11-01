<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "first_name" => $this->user->first_name,
            "last_name" => $this->user->last_name,
            "username" => $this->user->username,
            "email" => $this->user->email,
            "phone_number" => $this->user->phone_number,
            "address" => $this->address,
            "birth_date" => $this->birth_date,
            "proficiency_id" => $this->proficiency->id,
            "proficiency" => $this->proficiency->name,
            "role" => $this->user->role->name, 
            "role_id" => $this->user->role->id, 
            "is_active" => $this->user->is_active,
            "session" => [
                "access_token" => $this->access_token,
                "token_type" => "bearer",
                "expires_in" => Auth::factory()->getTTL(),
            ]
        ];
    }
}
