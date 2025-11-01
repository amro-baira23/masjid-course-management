<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Quiz extends Model
{
    /** @use HasFactory<\Database\Factories\QuizFactory> */
    use HasFactory;

    public $guarded = [];

    public function course(): BelongsTo{
        return $this->belongsTo(Course::class, "course_id");
    }

    
    public function questions(): BelongsToMany{
        return $this->belongsToMany(Question::class,"quiz_questions", "quiz_id");
    }
}
