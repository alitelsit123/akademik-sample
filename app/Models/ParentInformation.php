<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'father_name', 'mother_name',
        'father_birth_information', 'mother_birth_information',
        'father_religion', 'mother_religion',
        'father_citizen', 'mother_citizen',
        'father_hightst_certificate', 'mother_hightst_certificate',
        'father_working_at', 'mother_working_at',
        'father_income', 'mother_income',
        'father_address', 'mother_address',
        'father_phone', 'mother_phone',
        'father_alive', 'mother_alive'
    ];
}
