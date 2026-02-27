<?php

namespace App\Models;

use App\Models\SpecialNeedsPerson;
use App\Models\DifficultCaseFamily;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportProgram extends Model
{
  use HasFactory;

  protected $table = 'support_programs';
  protected $fillable = ['name'];

  public function difficultCaseFamilies()
  {
    return $this->belongsToMany(
      DifficultCaseFamily::class,
      'difficult_cases_sub_programs',
      'support_program_id',
      'difficult_case_family_id'
    )->withPivot(['date'])->withTimestamps();
  }

  public function specialNeedsPeople()
  {
    return $this->belongsToMany(
      SpecialNeedsPerson::class,
      'special_needs_sub_programs',
      'support_program_id',
      'special_needs_person_id'
    )->withPivot(['date'])->withTimestamps();
  }
}
