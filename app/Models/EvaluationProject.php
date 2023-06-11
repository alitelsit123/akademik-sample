<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationProject extends Model
{
    use HasFactory;
    protected $fillable = [
      'bb','mb','bsh','sb','user_id','project_id','semester','school_year'
    ];
}
