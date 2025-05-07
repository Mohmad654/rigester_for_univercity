<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'national_id',
        'email',
        'phone',
        'total_score',
        'certificate_image',
        'selected_colleges',
        'status',

    ];
    protected $casts = [
        'selected_colleges' => 'array',
    ];
    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function selectedSpecializations()
    {
        return $this->belongsToMany(
            Specialization::class,
            'student_specialization',
            'student_id',
            'specialization_id'
        )->withTimestamps();
    }
}
