<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            "text" => $this->text,
            "subject_id" => $this->subject->id,
            "subject" => $this-> subject->name,
            "options" => $this->whenLoaded("options",function (){
                return OptionResource::collection($this->options);
            }),
        ];
    }
}
