<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'NSPN','website','address','semester','address','head_office_name','head_office_nip','email','regency','province','postal_code','phone','fax','school_year_from','school_year_to'
    ];
}
