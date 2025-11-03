<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    /** @use HasFactory<\Database\Factories\SubmissionFactory> */
    use HasFactory;

    public $guarded = [];


    public function student() : BelongsTo {
        return $this->belongsTo(Student::class,"student_id");
    }

    public function quiz() : BelongsTo {
        return $this->belongsTo(Quiz::class,"quiz_id");
    }
}
