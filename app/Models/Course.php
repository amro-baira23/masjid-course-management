<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    public $guarded = [];

    public function subject() : BelongsTo {
        return $this->belongsTo(Subject::class,"subject_id");
    }

    public function students() : BelongsToMany {
        return $this->belongsToMany(Student::class,"enrollments");
    }
}
