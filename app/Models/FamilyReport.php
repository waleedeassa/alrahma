<?php

namespace App\Models;

use App\Models\User;
use App\Models\Family;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyReport extends Model
{
  use HasFactory;
  protected $table = 'family_reports';
  protected $fillable = [
    'family_id',
    'sufficiency',
    'basic_food',
    'time_to_doctor',
    'time_to_hospital',
    'sewage_system',
    'electricity_network',
    'water_network',
    'kitchen_setup',
    'cooking_method',
    'bathroom_setup',
    'refrigerator_condition',
    'wardrobe_condition',
    'bed_condition',
    'salon_condition',
    'has_tv',
    'has_mobile_phone',
    'has_computer',
    'blankets_sufficiency',
    'winter_clothes_sufficiency',
    'summer_clothes_sufficiency',
    'benefits_received_details',
    'educational_activities_benefit',
    'educational_activities_reason',
    'family_changes_marriage_divorce',
    'family_changes_employment',
    'family_changes_relocation',
    'home_repairs_details',
    'new_furniture_details',
    'sponsorship_spending',
    'family_year_summary',
    'family_orphan_wish',
    'family_changes_after_sponsored',
    'family_changes_after_sponsored_2',
    'family_changes_after_sponsored_3',
    'added_by'
  ];

  protected $casts = [
    'sufficiency' => 'integer',
    'time_to_doctor' => 'integer',
    'time_to_hospital' => 'integer',
    'sewage_system' => 'boolean',
    'electricity_network' => 'integer',
    'water_network' => 'integer',
    'kitchen_setup' => 'integer',
    'cooking_method' => 'integer',
    'bathroom_setup' => 'integer',
    'refrigerator_condition' => 'integer',
    'wardrobe_condition' => 'integer',
    'bed_condition' => 'integer',
    'salon_condition' => 'integer',
    'has_tv' => 'boolean',
    'has_mobile_phone' => 'boolean',
    'has_computer' => 'boolean',
    'blankets_sufficiency' => 'integer',
    'winter_clothes_sufficiency' => 'integer',
    'summer_clothes_sufficiency' => 'integer',
    'educational_activities_benefit' => 'boolean',
    'family_changes_after_sponsored' => 'integer',
    'family_changes_after_sponsored_2' => 'integer',
    'family_changes_after_sponsored_3' => 'integer',
  ];
  // --------------------------------------------------------------------
  // RELATIONSHIPS
  // -------------------------------------------------------------------
  public function family()
  {
    return $this->belongsTo(Family::class);
  }
  public function addedBy()
  {
    return $this->belongsTo(User::class, 'added_by');
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
  public function getSufficiencyLabelAttribute(): string
  {
    return $this->getOptionLabel('sufficiency', 'sufficiency');
  }
  public function getTimeToDoctorLabelAttribute(): string
  {
    return $this->getOptionLabel('access_time', 'time_to_doctor');
  }
  public function getTimeToHospitalLabelAttribute(): string
  {
    return $this->getOptionLabel('access_time', 'time_to_hospital');
  }
  public function getSewageSystemLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'sewage_system');
  }
  public function getElectricityNetworkLabelAttribute(): string
  {
    return $this->getOptionLabel('network_availability', 'electricity_network');
  }
  public function getWaterNetworkLabelAttribute(): string
  {
    return $this->getOptionLabel('network_availability', 'water_network');
  }
  public function getKitchenSetupLabelAttribute(): string
  {
    return $this->getOptionLabel('network_availability', 'kitchen_setup');
  }
  public function getCookingMethodLabelAttribute(): string
  {
    return $this->getOptionLabel('cooking_method', 'cooking_method');
  }
  public function getBathroomSetupLabelAttribute(): string
  {
    return $this->getOptionLabel('network_availability', 'bathroom_setup');
  }
  public function getRefrigeratorConditionLabelAttribute(): string
  {
    return $this->getOptionLabel('condition_status', 'refrigerator_condition');
  }
  public function getWardrobeConditionLabelAttribute(): string
  {
    return $this->getOptionLabel('condition_status', 'wardrobe_condition');
  }
  public function getBedConditionLabelAttribute(): string
  {
    return $this->getOptionLabel('condition_status', 'bed_condition');
  }
  public function getSalonConditionLabelAttribute(): string
  {
    return $this->getOptionLabel('condition_status', 'salon_condition');
  }
  public function getHasTvLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'has_tv');
  }
  public function getHasMobilePhoneLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'has_mobile_phone');
  }
  public function getHasComputerLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'has_computer');
  }
  public function getBlanketsSufficiencyLabelAttribute(): string
  {
    return $this->getOptionLabel('sufficiency', 'blankets_sufficiency');
  }
  public function getWinterClothesSufficiencyLabelAttribute(): string
  {
    return $this->getOptionLabel('sufficiency', 'winter_clothes_sufficiency');
  }
  public function getSummerClothesSufficiencyLabelAttribute(): string
  {
    return $this->getOptionLabel('sufficiency', 'summer_clothes_sufficiency');
  }
  public function getEducationalActivitiesBenefitLabelAttribute(): string
  {
    return $this->getOptionLabel('boolean', 'educational_activities_benefit');
  }
  public function getFamilyChangesAfterSponsoredLabelAttribute(): string
  {
    return $this->getOptionLabel('family_changes_after_sponsored', 'family_changes_after_sponsored');
  }
  public function getFamilyChangesAfterSponsoredLabel2Attribute(): string
  {
    return $this->getOptionLabel('family_changes_after_sponsored', 'family_changes_after_sponsored_2');
  }
  public function getFamilyChangesAfterSponsoredLabel3Attribute(): string
  {
    return $this->getOptionLabel('family_changes_after_sponsored', 'family_changes_after_sponsored_3');
  }
}
