<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Specialization extends Model
{
    protected $fillable = ['name', 'college_id', 'minimum_rate', /* other fields */];

    // علاقة العكس (الكثير-إلى-واحد)
    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_specialization')
            ->withPivot('priority')
            ->withTimestamps();
    }
}
