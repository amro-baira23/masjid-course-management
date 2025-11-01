<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AdminResource extends JsonResource
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
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "username" => $this->username,
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "role" => $this->role->name, 
            "role_id" => $this->role->id, 
            "is_active" => $this->is_active,
            "session" => [
                "access_token" => $this->access_token,
                "token_type" => "bearer",
                "expires_in" => Auth::factory()->getTTL(),
            ]
        ];
    }
}
