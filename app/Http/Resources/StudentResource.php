<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class StudentResource extends JsonResource
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
            "birth_date" => $this->birth_date,
            "education" => $this->education,
            "father_name" => $this->father_name,
            "father_occupation" => $this->father_occupation,
            "mother_name" => $this->mother_name,
            "mother_occupation" => $this->mother_occupation,
            "address" => $this->address,
            "gender" => $this->gender,
            "role_id" => $this->user->role->id, 
            "role" => $this->user->role->name, 
            "is_active" => $this->user->is_active,
            "age_group_id" => $this->whenLoaded("age_group",function(){
                return $this->age_group->id;
            }),
            "age_group" => $this->whenLoaded("age_group",function(){
                return $this->age_group->name;
            }),
            $this->mergeWhen(
                $this->access_token != null,[
                "session" => [
                    "access_token" => $this->access_token,
                    "token_type" => "bearer",
                    "expires_in" => Auth::factory()->getTTL(),
                ]
            ]),
            "courses" => $this->whenLoaded(
                "courses",
                CourseResource::collection($this->courses()->get())
            ),
         
        ];
    }
}
