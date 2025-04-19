<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentHasClass extends Model
{
    protected $guarded = [];

    public function students(){
        return $this->belongsTo(Student::class, 'students_id', 'id');
    }

    public function homeroom(){
        return $this->belongsTo(Homeroom::class, 'homerooms_id', 'id');
    }
}
