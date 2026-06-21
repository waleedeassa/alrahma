<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DifficultCaseFamily extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'difficult_case_families';
  protected $fillable = [
    'registration_date',
    'first_name_ar',
    'last_name_ar',
    'first_name_fr',
    'last_name_fr',
    'national_id_no',
    'gender',
    'birth_date',
    'education_level',
    'family_members_count',
    'difficult_case_type',
    'social_status',
    'governorate_id',
    'city_id',
    'address',
    'phone',
    'previously_benefited',
    'required_service',
    'housing_area',
    'beneficiary_activity',
    'aggressor_gender',
    'aggressor_relationship',
    'aggressor_education_level',
    'aggressor_family_status',
    'aggressor_kinship',
    'violence_type',
    'violence_place',
    'violence_time',
    'violence_frequency',
    'external_interventions',
    'added_by',
    'updated_by',
  ];

  protected $casts = [
    'national_id_no' => 'encrypted',
    'previously_benefited' => 'boolean',
  ];

  // --------------------------------------------------------------------
  // START: RELATIONSHIPS
  // --------------------------------------------------------------------
  public function governorate()
  {
    return $this->belongsTo(Governorate::class);
  }
  public function city()
  {
    return $this->belongsTo(City::class);
  }
  public function addedBy()
  {
    return $this->belongsTo(User::class, 'added_by');
  }
  public function updatedBy()
  {
    return $this->belongsTo(User::class, 'updated_by');
  }

  // --------------------------------------------------------------------
  //  ACCESSORS
  // --------------------------------------------------------------------
  private function getOptionLabel(string $optionType, string $attributeName): string
  {
    $key = $this->attributes[$attributeName] ?? null;

    if (is_null($key)) {
      return ' ';
    }

    return config("options.{$optionType}.{$key}", 'قيمة غير معروفة');
  }
  public function getDifficultCaseTypeLabelAttribute(): string
  {
    return $this->getOptionLabel('difficult_case_type', 'difficult_case_type');
  }
  public function getGenderLabelAttribute(): string
  {
    return $this->getOptionLabel('gender', 'gender');
  }
  public function getSocialStatusLabelAttribute(): string
  {
    return $this->getOptionLabel('social_status', 'social_status');
  }
  public function getEducationLevelLabelAttribute(): string
  {
    return $this->getOptionLabel('education_level', 'education_level');
  }
  public function getFamilyMembersCountForDisplayAttribute()
  {
    return $this->family_members_count > 10
      ? config('options.number_of_family_members.11')
      : $this->family_members_count;
  }
  public function getPreviouslyBenefitedLabelAttribute(): string
  {
    return $this->getOptionLabel('previously_benefited', 'previously_benefited');
  }

  public function getRequiredServiceLabelAttribute(): string
  {
    return $this->getOptionLabel('required_service', 'required_service');
  }

  public function getHousingAreaLabelAttribute(): string
  {
    return $this->getOptionLabel('housing_area', 'housing_area');
  }

  public function getBeneficiaryActivityLabelAttribute(): string
  {
    return $this->getOptionLabel('beneficiary_activity', 'beneficiary_activity');
  }
  public function getAggressorGenderLabelAttribute(): string
  {
    return $this->getOptionLabel('gender', 'aggressor_gender');
  }

  public function getAggressorRelationshipLabelAttribute(): string
  {
    return $this->getOptionLabel('aggressor_relationship', 'aggressor_relationship');
  }

  public function getAggressorEducationLevelLabelAttribute(): string
  {
    return $this->getOptionLabel('education_level', 'aggressor_education_level');
  }

  public function getAggressorFamilyStatusLabelAttribute(): string
  {
    return $this->getOptionLabel('social_status', 'aggressor_family_status');
  }

  public function getAggressorKinshipLabelAttribute(): string
  {
    return $this->getOptionLabel('aggressor_kinship', 'aggressor_kinship');
  }

  public function getViolenceTypeLabelAttribute(): string
  {
    return $this->getOptionLabel('violence_type', 'violence_type');
  }

  public function getViolencePlaceLabelAttribute(): string
  {
    return $this->getOptionLabel('violence_place', 'violence_place');
  }

  public function getViolenceTimeLabelAttribute(): string
  {
    return $this->getOptionLabel('violence_time', 'violence_time');
  }

  public function getViolenceFrequencyLabelAttribute(): string
  {
    return $this->getOptionLabel('violence_frequency', 'violence_frequency');
  }

  public function getExternalInterventionsLabelAttribute(): string
  {
    return $this->getOptionLabel('external_interventions', 'external_interventions');
  }
  // --------------------------------------------------------------------
  // SCOPES
  // --------------------------------------------------------------------
  public function scopeSearch($query, $filters)
  {
    $query
      ->when(isset($filters['governorate_id']), function ($query) use ($filters) {
        return $query->where('governorate_id', $filters['governorate_id']);
      })
      ->when(isset($filters['city_id']), function ($query) use ($filters) {
        return $query->where('city_id', $filters['city_id']);
      })
      ->when(isset($filters['difficult_case_type']), function ($query) use ($filters) {
        return $query->where('difficult_case_type', $filters['difficult_case_type']);
      })
      ->when(isset($filters['social_status']), function ($query) use ($filters) {
        return $query->where('social_status', $filters['social_status']);
      })
      ->when(!empty($filters['gender']), function ($query) use ($filters) {
        return $query->where('gender', $filters['gender']);
      })
      ->when(isset($filters['education_level']), function ($query) use ($filters) {
        return $query->where('education_level', $filters['education_level']);
      })
      ->when(isset($filters['family_members_count']), function ($query) use ($filters) {
        return $query->where('family_members_count', $filters['family_members_count']);
      });
    return $query;
  }
  // --------------------------------------------------------------------
  // CHECKS
  // --------------------------------------------------------------------
  public function canBeDeleted()
  {
  }
}
