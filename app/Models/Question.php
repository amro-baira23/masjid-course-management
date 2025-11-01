<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    public $guarded = [];

    public function quizzes(): BelongsToMany{
        return $this->belongsToMany(Quiz::class,"quiz_questions", "question_id");
    }

    public function subject(): BelongsTo{
        return $this->belongsTo(Subject::class,"subject_id");
    }

    public function options(): HasMany{
        return $this->hasMany(Option::class,"question_id");

    }
}
