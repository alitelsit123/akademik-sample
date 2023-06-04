<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = ['name','head_class_id'];
    public function students() {
        return $this->belongsToMany('App\Models\User', 'student_information', 'class_id', 'user_id');
    }
    public function headClass() {
        return $this->belongsTo('App\Models\User', 'head_class_id');
    }
}
