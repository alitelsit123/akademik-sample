<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','description','semester','school_year','class_id'
    ];
    protected $attributes = [
      'class_id' => 0
    ];
    public function class() {
      return $this->hasMany('App\Classes', 'class_id');
    }
}
