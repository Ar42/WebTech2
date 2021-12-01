<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Course_Student extends Pivot 
{
    protected $table = 'course_student';
}
