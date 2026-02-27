<?php

namespace App\Models;

use App\Models\Attachment;
use App\Models\City;
use App\Models\Family;
use App\Models\Governorate;
use App\Models\OrphanReport;
use App\Models\Sponsor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Orphan extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'sponsor_id',
    'family_id',
    'supervisor_id',
    'orphan_sponsorship_code',
    'cancellation_reason',
    'name_ar',
    'name_fr',
    'family_name_ar',
    'family_name_fr',
    'birth_date',
    'gender',
    'governorate_id',
    'city_id',
    'city_in_french',
    'address',
    'address_in_french',
    'arrangement_between_brothers',
    'income_status',
    'other_income',
    'academic_level',
    'shoe_size',
    'clothes_size',
    'phone',
    'blood_type',
    'health_status',
    'image'
  ];
  protected $casts = [
    // 'birth_date'      => 'date',
    'gender'          => 'integer',
    'health_status'   => 'integer',
    'academic_level'  => 'integer',
    'blood_type'      => 'integer',
    'income_status'   => 'integer',
    'cancellation_reason' => 'integer',
  ];
  protected $appends = ['age'];

  // --------------------------------------------------------------------
  //  RELATIONSHIPS 
  // --------------------------------------------------------------------
  public function attachments()
  {
    return $this->morphMany(Attachment::class, 'attachmentable');
  }
  public function family()
  {
    return $this->belongsTo(Family::class);
  }
  public function sponsor()
  {
    return $this->belongsTo(Sponsor::class);
  }
  public function governorate()
  {
    return $this->belongsTo(Governorate::class);
  }
  public function city()
  {
    return $this->belongsTo(City::class);
  }
  public function supervisor()
  {
    return $this->belongsTo(User::class);
  }
  public function reports()
  {
    return $this->hasMany(OrphanReport::class);
  }

  // --------------------------------------------------------------------
  //  ACCESSORS 
  // --------------------------------------------------------------------
  // Image Helper
  public function getImageUrlAttribute()
  {
    if ($this->image && Storage::disk('uploads')->exists($this->image)) {
      return Storage::disk('uploads')->url($this->image);
    }
    // default image if no image is set or the file doesn't exist
    return asset('assets/img/user_avatar.png');
  }
  // -- Age Helpers --
  public function getAgeAttribute()
  {
    if (!$this->birth_date) {
      return 0;
    }
    return Carbon::parse($this->birth_date)->age;
  }
  public function getAgeLabelAttribute()
  {
    $age = $this->age;
    if ($age == 0) return 'أقل من سنة';
    if ($age == 1) return 'سنة واحدة';
    if ($age == 2) return 'سنتان';
    if ($age >= 3 && $age <= 10) return $age . ' سنوات';
    return $age . ' سنة';
  }
  // -- Sponsor Badge Helper --
  public function getSponsorBadgeAttribute()
  {
    // 1- if no sponsor assigned
    if (! $this->sponsor_id || ! $this->sponsor) {
      return '<span class="badge bg-danger">بدون كفيل</span>';
    }
    $nameOriginal = $this->sponsor->name;
    $name = $this->normalizeArabic($nameOriginal);
    // 2- determine badge color based on sponsor name
    if (str_contains($name, $this->normalizeArabic('الإغاثة الإسلامية هولندا'))) {
      $badgeClass = 'bg-primary';
    } elseif (str_contains($name, $this->normalizeArabic('كرامة التضامن'))) {
      $badgeClass = 'bg-success';
    } elseif (str_contains($name, $this->normalizeArabic('شخص ذاتي'))) {
      $badgeClass = 'bg-warning text-dark';
    } else {
      $badgeClass = 'bg-info';
    }
    return '<span class="badge ' . $badgeClass . '">' . $nameOriginal . '</span>';
  }

  private function getOptionLabel(string $optionType, string $attributeName): string
  {
    $key = $this->attributes[$attributeName] ?? null;
    if (is_null($key)) {
      return 'غير متوفر';
    }
    return config("options.{$optionType}.{$key}", 'قيمة غير معروفة');
  }
  public function getAcademicLevelLabelAttribute(): string
  {
    return $this->getOptionLabel('academic_level', 'academic_level');
  }
  public function getCancellationReasonLabelAttribute(): string
  {
    return $this->getOptionLabel('sponsorship_cancellation_reason', 'cancellation_reason');
  }
  public function getGenderLabelAttribute(): string
  {
    return $this->getOptionLabel('gender', 'gender');
  }
  public function getIncomeStatusLabelAttribute(): string
  {
    return $this->getOptionLabel('income_status', 'income_status');
  }
  public function getBloodTypeLabelAttribute(): string
  {
    return $this->getOptionLabel('blood_type', 'blood_type');
  }
  public function getHealthStatusLabelAttribute(): string
  {
    return $this->getOptionLabel('health_status', 'health_status');
  }
  // --------------------------------------------------------------------
  //  SCOPES
  // --------------------------------------------------------------------
  public function scopeWhereAgeBetween($query, $minAge, $maxAge)
  {
    $startDate = Carbon::now()->subYears($maxAge)->startOfDay(); 
    $endDate   = Carbon::now()->subYears($minAge)->endOfDay();   
    return $query->whereBetween('birth_date', [$startDate, $endDate]);
  }
  public function scopeSponsored($query)
  {
    return $query->whereNotNull('sponsor_id');
  }
  public function scopeUnsponsored($query)
  {
    return $query->whereNull('sponsor_id');
  }
  public function scopeAcademicLevel($query, $level)
  {
    return $query->where('academic_level', $level);
  }
  // $orphans = Orphan::whereAgeBetween(5, 10)->get();
  // --------------------------------------------------------------------
  //  HELPERS
  // --------------------------------------------------------------------
  private function normalizeArabic($text)
  {
    $text = trim($text);
    $search  = ['أ', 'إ', 'آ', 'ة', 'ى', 'ؤ', 'ئ'];
    $replace = ['ا', 'ا', 'ا', 'ه', 'ي', 'و', 'ي'];
    return mb_strtolower(str_replace($search, $replace, $text));
  }
}
