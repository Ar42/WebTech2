<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $primaryKey = 'code';
    public $incrementing = false;

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student', 'code', 'username')->withPivot('tt1', 'tt2', 'tt3', 'final', 'att', 'cgpa', 'grade')->using(Course_Student::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teacher', 'code', 'username')->withPivot('year')->using(Course_Teacher::class);
    }
}
