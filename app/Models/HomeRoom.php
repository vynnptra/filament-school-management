<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeRoom extends Model
{
    protected $guarded = [];

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teachers_id', 'id');
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class, 'classrooms_id', 'id');
    }
    public function periode(){
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }
}
