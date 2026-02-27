<?php

namespace App\Models;

use App\Models\DifficultCaseFamily;
use App\Models\Family;
use App\Models\Governorate;
use App\Models\Orphan;
use App\Models\SpecialNeedsPerson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  use HasFactory;

  protected $table = 'cities';
  protected $fillable = ['name', 'governorate_id'];

  // --------------------------------------------------------------------
  // Accessors
  // --------------------------------------------------------------------
  public function getCreatedAtAttribute($value)
  {
    return date('Y-m-d ', strtotime($value));
  }
  // --------------------------------------------------------------------
  // RELATIONSHIPS / Checks
  // --------------------------------------------------------------------
  public function governorate()
  {
    return $this->belongsTo(Governorate::class);
  }
  public function families()
  {
    return $this->hasMany(Family::class);
  }
  public function orphans()
  {
    return $this->hasMany(Orphan::class);
  }
  public function difficultCaseFamilies()
  {
    return $this->hasMany(DifficultCaseFamily::class);
  }
  public function specialNeedsPeople()
  {
    return $this->hasMany(SpecialNeedsPerson::class);
  }
  public function canBeDeleted()
  {
    if ($this->families()->exists()) return 'لايمكن حذف المدينة لوجود عائلات تابع لها';
    if ($this->orphans()->exists()) return 'لايمكن حذف المدينة لوجود ايتام تابع لها';
    if ($this->difficultCaseFamilies()->exists()) return 'لايمكن حذف المدينة لوجود عائلات حالات صعبة تابع لها';
    if ($this->specialNeedsPeople()->exists()) return 'لايمكن حذف المدينة لوجود اشخاص ذوي احتياجات خاصة تابع لها';
    return true;
  }
}
