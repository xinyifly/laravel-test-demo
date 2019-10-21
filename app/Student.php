<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name'];

    public function courses() {
        return $this->belongsToMany('App\Course');
    }

    public function selectCourse($course)
    {
        $this->courses()->attach($course);
    }
}
