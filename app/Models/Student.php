<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    public $guarded = [];
    
    public function user() : BelongsTo {
        return $this->belongsTo(User::class,"user_id");
    }

    public function age_group() : BelongsTo {
        return $this->belongsTo(AgeGroup::class,"age_group_id");
    }

}
