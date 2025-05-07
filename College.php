<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_specialization', 'college_id', 'student_id')
            ->withPivot('priority')
            ->withTimestamps();
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }
    public function confirmedStudents()
    {
        return $this->hasMany(Student::class)->whereNotNull('confirmation_date');
    }
}
