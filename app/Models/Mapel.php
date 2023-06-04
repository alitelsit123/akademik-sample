<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function teachers() {
        return $this->belongsToMany('App\Models\User', 'mapel_teachers', 'mapel_id', 'teacher_id');
    }
    public function studentEvaluation() {
        return $this->belongsToMany('App\Models\User', 'evaluations', 'mapel_id','student_id')->withPivot(['number','predicate','description','semester','school_year'])->withTimestamps();
    }
}
