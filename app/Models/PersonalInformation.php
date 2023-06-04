<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'nickname', 'nisn', 'school_name', 'gender', 'birth_info', 'religion', 'citizen', 'child_number', 'total_siblings', 'total_half_siblings', 'total_a_siblings', 'child_type', 'language', 'phone','level'
    ];
}
