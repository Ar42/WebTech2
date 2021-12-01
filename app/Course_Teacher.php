<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Course_Teacher extends Pivot
{
    protected $table = 'course_teacher';
}
