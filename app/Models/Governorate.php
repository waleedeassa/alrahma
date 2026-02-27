<?php

namespace App\Models;

use App\Models\City;
use App\Models\DifficultCaseFamily;
use App\Models\Family;
use App\Models\Orphan;
use App\Models\SpecialNeedsPerson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
  use HasFactory;
  protected $table = 'governorates';
  protected $fillable = ['name'];
  /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
  public function getCreatedAtAttribute($value)
  {
    return date('Y-m-d ', strtotime($value));
  }
  /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
  public function cities()
  {
    return $this->hasMany(City::class);
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
    /*
    |--------------------------------------------------------------------------
    | Checks
    |--------------------------------------------------------------------------
    */
  public function canBeDeleted()
  {
    if ($this->cities()->exists()) return 'لايمكن حذف الاقليم لوجود مدن تابع له';
    if ($this->families()->exists()) return 'لايمكن حذف الاقليم لوجود عائلات تابع له';
    if ($this->orphans()->exists()) return 'لايمكن حذف الاقليم لوجود ايتام تابع له';
    if ($this->difficultCaseFamilies()->exists()) return 'لايمكن حذف الاقليم لوجود عائلات حالات صعبة تابع له';
    if ($this->specialNeedsPeople()->exists()) return 'لايمكن حذف الاقليم لوجود اشخاص ذوي احتياجات خاصة تابع له';
    return true;
  }
}
