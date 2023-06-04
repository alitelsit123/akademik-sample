<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGuardianInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'birth_information','religion','relation','hightst_certificate','working_at','income','address','phone','citizen'
    ];
}
