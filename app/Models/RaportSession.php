<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportSession extends Model
{
    use HasFactory;
    protected $fillable = [
      'school_year','semester','user_id','class_id'
    ];
    public function class() {
      return $this->hasMany('App\Classes', 'class_id');
    }
}
