<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_head_class','from_parent','semester','school_year','class_id'
    ];
    public function class() {
      return $this->hasMany('App\Classes', 'class_id');
    }
}
