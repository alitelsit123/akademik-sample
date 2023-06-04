<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'blood_group', 'disease_history', 'physical_abnormalities', 'height', 'weight'
    ];
}
