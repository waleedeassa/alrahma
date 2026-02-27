<?php

namespace App\Models;

use App\Models\SupportProgram;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialNeedsPerson extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'special_needs_people';

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
    'special_needs_type',
    'social_status',
    'governorate_id',
    'city_id',
    'address',
    'phone',
    'added_by',
    'updated_by',
  ];

  protected $casts = [
    'national_id_no' => 'encrypted',
  ];

  // --------------------------------------------------------------------
  // RELATIONSHIPS
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
  public function supportPrograms()
  {
    return $this->belongsToMany(
      SupportProgram::class,
      'special_needs_sub_programs',
      'special_needs_person_id',
      'support_program_id'
    )->withPivot(['id', 'date'])->withTimestamps();
  }
  // --------------------------------------------------------------------
  //   ACCESSORS 
  // --------------------------------------------------------------------
  private function getOptionLabel(string $optionType, string $attributeName): string
  {
    $key = $this->attributes[$attributeName] ?? null;
    if (is_null($key)) {
      return 'غير متوفر';
    }
    return config("options.{$optionType}.{$key}", 'قيمة غير معروفة');
  }
  public function getSpecialNeedsTypeLabelAttribute(): string
  {
    return $this->getOptionLabel('special_needs_type', 'special_needs_type');
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
      ->when(isset($filters['special_needs_type']), function ($query) use ($filters) {
        return $query->where('special_needs_type', $filters['special_needs_type']);
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
    if ($this->supportPrograms()->exists()) {
      return 'لا يمكن حذف الحالة لوجود برامج دعم مرتبطة بها';
    }
    return true;
  }
}
