<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassionInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'art', 'pysics', 'organization', 'etc'
    ];
}
