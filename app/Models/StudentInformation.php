<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nisn','rapor_ready','class_id','user_id'
    ];
    public function class() {
        return $this->belongsTo('App\Models\Classes', 'class_id');
    }
}
