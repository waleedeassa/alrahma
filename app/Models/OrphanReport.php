<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrphanReport extends Model
{
  use HasFactory;
  protected $table = 'orphan_reports';
  protected $fillable = [
    'orphan_id',
    'name',
    'family_name',
    'health_status',
    'going_to_nearest_doctor_or_hospital_time',
    'education',
    'going_to_school_by',
    'going_to_nearest_school_time',
    'preferred_subject',
    'unpreferred_subject',
    'personal',
    'like_to_become',
    'school_progress',
    'quality_of_housing',
    'dwelling_place',
    'type_of_dwelling',
    'hobbies',
    'favorite_food',
    'basic_food',
    'school_name',
    'first_term_average',
    'second_term_average',
    'end_year_decision',
    'educational_level_changes',
    'added_by',
    'edited_by',
    'supervisor_notes',
  ];

  protected $casts = [
    'health_status' => 'integer',
    'going_to_nearest_doctor_or_hospital_time' => 'integer',
    'education' => 'integer',
    'going_to_school_by' => 'integer',
    'going_to_nearest_school_time' => 'integer',
    'preferred_subject' => 'integer',
    'unpreferred_subject' => 'integer',
    'personal' => 'integer',
    'like_to_become' => 'integer',
    'school_progress' => 'integer',
    'quality_of_housing' => 'integer',
    'dwelling_place' => 'integer',
    'type_of_dwelling' => 'integer',
    'hobbies' => 'integer',
    'favorite_food' => 'integer',
    'basic_food' => 'integer',
    'end_year_decision' => 'integer',
    'educational_level_changes' => 'integer',
  ];
  // --------------------------------------------------------------------
  // relations
  // --------------------------------------------------------------------
  public function orphan()
  {
    return $this->belongsTo(Orphan::class, 'orphan_id', 'id');
  }
  public function addedBy()
  {
    return $this->belongsTo(User::class, 'added_by');
  }
  public function editedBy()
  {
    return $this->belongsTo(User::class, 'edited_by');
  }
  // --------------------------------------------------------------------
  // ACCESSORS 
  // --------------------------------------------------------------------
  private function getOptionLabel(string $optionType, string $attributeName): string
  {
    $key = $this->attributes[$attributeName] ?? null;
    if (is_null($key)) {
      return 'غير متوفر';
    }
    return config("options.{$optionType}.{$key}", $key);
  }
  // --------------------------------------------------------------------
  // Accessors
  // --------------------------------------------------------------------
  public function getHealthStatusLabelAttribute(): string
  {
    return $this->getOptionLabel('report_health_status', 'health_status');
  }
  public function getGoingToDoctorOrHospitalLabelAttribute(): string
  {
    return $this->getOptionLabel('going_to_nearest_doctor_or_hospital_time', 'going_to_nearest_doctor_or_hospital_time');
  }
  public function getEducationLabelAttribute(): string
  {
    return $this->getOptionLabel('academic_level', 'education');
  }
  public function getGoingToSchoolByLabelAttribute(): string
  {
    return $this->getOptionLabel('going_to_school_by', 'going_to_school_by');
  }
  public function getGoingToNearestSchoolTimeLabelAttribute(): string
  {
    return $this->getOptionLabel('going_to_nearest_school_time', 'going_to_nearest_school_time');
  }
  public function getPreferredSubjectLabelAttribute(): string
  {
    return $this->getOptionLabel('preferred_subject', 'preferred_subject');
  }
  public function getUnpreferredSubjectLabelAttribute(): string
  {
    return $this->getOptionLabel('unpreferred_subject', 'unpreferred_subject');
  }

  public function getSchoolProgressLabelAttribute(): string
  {
    return $this->getOptionLabel('school_progress', 'school_progress');
  }

  public function getEndYearDecisionLabelAttribute(): string
  {
    return $this->getOptionLabel('end_year_decision', 'end_year_decision');
  }
  public function getEducationalLevelChangesLabelAttribute(): string
  {
    return $this->getOptionLabel('educational_level_changes', 'educational_level_changes');
  }
  public function getPersonalLabelAttribute(): string
  {
    return $this->getOptionLabel('personal', 'personal');
  }
  public function getLikeToBecomeLabelAttribute(): string
  {
    return $this->getOptionLabel('like_to_become', 'like_to_become');
  }
  public function getHobbiesLabelAttribute(): string
  {
    return $this->getOptionLabel('hobbies', 'hobbies');
  }
  public function getFavoriteFoodLabelAttribute(): string
  {
    return $this->getOptionLabel('favorite_food', 'favorite_food');
  }
  public function getBasicFoodLabelAttribute(): string
  {
    return $this->getOptionLabel('basic_food', 'basic_food');
  }
  public function getQualityOfHousingLabelAttribute(): string
  {
    return $this->getOptionLabel('quality_of_housing', 'quality_of_housing');
  }
  public function getDwellingPlaceLabelAttribute(): string
  {
    return $this->getOptionLabel('dwelling_place', 'dwelling_place');
  }
  public function getTypeOfDwellingLabelAttribute(): string
  {
    return $this->getOptionLabel('type_of_dwelling', 'type_of_dwelling');
  }
}
