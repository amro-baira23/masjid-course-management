<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            "name" => $this->name,
            "subject_id" => $this->subject->id,
            "subject_name" => $this->subject->name,
            "age_group_id" => $this->subject->age_group->id,
            "age_group" => $this->subject->age_group->name,
            "teacher_id" => $this->teacher_id,
            "start_time" => $this->start_time,
            "end_time" => $this->end_time,
            "days" => $this->days,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
        ];
    }
}
