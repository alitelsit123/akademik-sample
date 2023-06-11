<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unpresent extends Model
{
    use HasFactory;
    protected $fillable = [
        'sick','permission','alpha','semester','school_year','class_id'
    ];
    public function class() {
      return $this->hasMany('App\Classes', 'class_id');
    }
}
