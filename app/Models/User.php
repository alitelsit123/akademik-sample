<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'email',
    'password',
    'level'
  ];


  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password'
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'password' => 'hashed'
  ];

  public function personalInformation() {
    return $this->hasOne('App\Models\PersonalInformation', 'user_id');
  }
  public function educationInformation() {
    return $this->hasOne('App\Models\EducationInformation', 'user_id');
  }
  public function healthInformation() {
    return $this->hasOne('App\Models\HealthInformation', 'user_id');
  }
  public function parentInformation() {
    return $this->hasOne('App\Models\ParentInformation', 'user_id');
  }
  public function passionInformation() {
    return $this->hasOne('App\Models\PassionInformation', 'user_id');
  }
  public function residenceInformation() {
    return $this->hasOne('App\Models\ResidenceInformation', 'user_id');
  }
  public function studentDevelopmentInformation() {
    return $this->hasOne('App\Models\StudentDevelopmentInformation', 'user_id');
  }
  public function studentGuardianInformation() {
    return $this->hasOne('App\Models\StudentGuardianInformation', 'user_id');
  }
  public function studentInformation() {
    return $this->hasOne('App\Models\StudentInformation', 'user_id');
  }
  public function studentEvaluations() {
    return $this->belongsToMany('App\Models\Mapel', 'evaluations', 'student_id','mapel_id')->withPivot(['number','predicate','description','semester','school_year'])->withTimestamps();
  }
  public function studentEvaluationsCurrentSession() {
    $school = \App\Models\School::first();
    return $this->belongsToMany('App\Models\Mapel', 'evaluations', 'student_id','mapel_id')->withPivot(['number','predicate','description','semester','school_year'])->withTimestamps()
      ->wherePivot('semester', $school->semester)->wherePivot('school_year', $school->school_year_from.'/'.$school->school_year_to);
  }
  public function teaches() {
    return $this->belongsToMany('App\Models\Mapel', 'mapel_teachers', 'teacher_id', 'mapel_id');
  }
  public function attitude() {
    return $this->hasOne('App\Models\Attitude','student_id');
  }
  public function unpresent() {
    return $this->hasOne('App\Models\Unpresent','student_id');
  }
  public function note() {
    return $this->hasOne('App\Models\Note','student_id');
  }
  public function extracurriculars() {
    return $this->hasMany('App\Models\Extracurricular','student_id');
  }
  public function performances() {
    return $this->hasMany('App\Models\Performance','student_id');
  }

  public function getInformation($name, $attr) {
    $info = $this->{$name};
    if($info) {
        return $info->{$attr};
    }

    return null;
  }

}
