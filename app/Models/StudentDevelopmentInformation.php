<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDevelopmentInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'registration_date','scholarship_grantee','reason','finish_date','sttb_date_number','plan'
    ];
}
