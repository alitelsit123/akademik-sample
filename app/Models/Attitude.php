<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attitude extends Model
{
    use HasFactory;
    protected $fillable = [
        'spiritual_predicate','spiritual_description',
        'social_predicate','social_description','semester','school_year','class_id'
    ];
    public function class() {
      return $this->hasMany('App\Classes', 'class_id');
    }
}
