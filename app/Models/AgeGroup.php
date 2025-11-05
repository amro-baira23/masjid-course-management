<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgeGroup extends Model
{
    /** @use HasFactory<\Database\Factories\AgeGroupFactory> */
    use HasFactory;

    public $guarded = [];

    const CREATED_AT = null;
    const UPDATED_AT = null;

       public function students() : HasMany {
        return $this->hasMany(Student::class,"age_group_id");
    }


}
