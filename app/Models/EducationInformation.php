<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_name', 'level', 'sttb_date_number', 'study_duration', 'move_school', 'transfer_date', 'reason'
    ];
}
