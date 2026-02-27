<?php

namespace App\Models;

use App\Models\City;
use App\Models\Orphan;
use App\Models\Governorate;
use App\Models\FamilyReport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Family extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'families';

  protected $fillable = [
    'orphan_guardian_name',
    'relationship_to_the_orphan',
    'phone1',
    'phone2',
    'address',
    'governorate_id',
    'city_id',
    'father_job',
    'father_death_reason',
    'father_death_date',
    'mother_alive',
    'mother_death_date',
    'mother_death_reason',
    'mother_name',
    'mother_birth_date',
    'mother_family_name',
    'mother_name_in_french',
    'mother_family_name_in_french',
    'mother_id_no',
    'mother_id_expire_date',
    'bank_account_number',
    'medical_insurance',
    'mother_health_status',
    'number_of_family_members',
    'mother_education_level',
    'mother_qualifications',
    'does_mother_work',
    'mother_working_type',
    'mother_widows_support',
    'mother_widows_support_amount',
    'has_retirement_compensation',
    'husband_retirement_compensation_amount',
    'is_there_another_source_of_income',
    'mother_other_income_type',
    'mother_other_income_amount',
    'is_mother_other_income_fixed',
    'housing_ownership',
    'housing_type',
    'housing_status',
    'housing_area',
    'has_breadwinner',
    'breadwinner_name',
    'breadwinner_french_name',
    'breadwinner_family_name',
    'breadwinner_family_in_french',
    'breadwinner_job',
    'breadwinner_id_no',
    'breadwinner_phone',
    'added_by',
    'updated_by',
  ];

  protected $casts = [
    'mother_id_no'        => 'encrypted',
    'bank_account_number' => 'encrypted',
    'breadwinner_id_no'   => 'encrypted',
  ];

  // --------------------------------------------------------------------
  //  RELATIONSHIPS 
  // --------------------------------------------------------------------
  public function attachments()
  {
    return $this->morphMany('App\Models\Attachment', 'attachmentable');
  }
  public function orphans()
  {
    return $this->hasMany(Orphan::class);
  }
  public function governorate()
  {
    return $this->belongsTo(Governorate::class);
  }
  public function city()
  {
    return $this->belongsTo(City::class);
  }
  public function reports()
  {
    return $this->hasMany(FamilyReport::class);
  }
  // --------------------------------------------------------------------
  //  ACCESSORS 
  // --------------------------------------------------------------------
  private function getOptionLabel(string $optionType, string $attributeName): string
  {
    $key = $this->attributes[$attributeName] ?? null;

    if (is_null($key)) {
      return 'غير متوفر';
    }

    return config("options.{$optionType}.{$key}", 'قيمة غير معروفة');
  }
  public function getRelationshipToTheOrphanLabelAttribute(): string
  {
    return $this->getOptionLabel('relationship_to_the_orphan', 'relationship_to_the_orphan');
  }

  public function getHousingTypeLabelAttribute(): string
  {
    return $this->getOptionLabel('housing_type', 'housing_type');
  }

  public function getHousingOwnershipLabelAttribute(): string
  {
    return $this->getOptionLabel('housing_ownership', 'housing_ownership');
  }
  public function getHousingStatusLabelAttribute(): string
  {
    return $this->getOptionLabel('housing_status', 'housing_status');
  }
  public function getHousingAreaLabelAttribute(): string
  {
    return $this->getOptionLabel('housing_area', 'housing_area');
  }
  public function getFatherDeathReasonLabelAttribute(): string
  {
    return $this->getOptionLabel('father_death_reason', 'father_death_reason');
  }
  public function getMedicalInsuranceLabelAttribute(): string
  {
    return $this->getOptionLabel('medical_insurance', 'medical_insurance');
  }
  public function getMotherOtherIncomeTypeLabelAttribute(): string
  {
    return $this->getOptionLabel('mother_other_income_type', 'mother_other_income_type');
  }
  public function getMotherEducationLevelLabelAttribute(): string
  {
    return $this->getOptionLabel('mother_education_level', 'mother_education_level');
  }
  public function getMotherQualificationsLabelAttribute(): string
  {
    return $this->getOptionLabel('mother_qualifications', 'mother_qualifications');
  }
  public function getMotherWorkingTypeLabelAttribute(): string
  {
    return $this->getOptionLabel('mother_working_type', 'mother_working_type');
  }
  public function getMotherDeathReasonLabelAttribute(): string
  {
    return $this->getOptionLabel('mother_death_reason', 'mother_death_reason');
  }
  public function getMotherHealthStatusLabelAttribute(): string
  {
    return $this->getOptionLabel('mother_health_status', 'mother_health_status');
  }
  public function getMotherAliveLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'mother_alive');
  }
  public function getDoesMotherWorkLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'does_mother_work');
  }
  public function getMotherWidowsSupportLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'mother_widows_support');
  }
  public function getHasRetirementCompensationLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'has_retirement_compensation');
  }
  public function getIsThereAnotherSourceOfIncomeLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'is_there_another_source_of_income');
  }
  public function getIsMotherOtherIncomeFixedLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'is_mother_other_income_fixed');
  }
  public function getHasBreadwinnerLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'has_breadwinner');
  }
  public function getFamilyMembersForDisplayAttribute()
  {
    return $this->number_of_family_members > 10
      // more than 10
      ? config('options.number_of_family_members.11')
      : $this->number_of_family_members;
  }
  // --------------------------------------------------------------------
  //  SCOPES
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
      ->when(isset($filters['housing_status']), function ($query) use ($filters) {
        return $query->where('housing_status', $filters['housing_status']);
      })
      ->when(isset($filters['mother_qualifications']), function ($query) use ($filters) {
        return $query->where('mother_qualifications', $filters['mother_qualifications']);
      })
      ->when(isset($filters['mother_education_level']), function ($query) use ($filters) {
        return $query->where('mother_education_level', $filters['mother_education_level']);
      })
      ->when(isset($filters['number_of_family_members']), function ($query) use ($filters) {
        return $query->where('number_of_family_members', $filters['number_of_family_members']);
      });
    return $query;
  }
    /*
    |--------------------------------------------------------------------------
    | Checks
    |--------------------------------------------------------------------------
    */
  public function canBeDeleted()
  {
    if ($this->orphans()->exists()) return 'لايمكن حذف الأسرة لوجود ايتام تابع لها';
    return true;
  }
}
