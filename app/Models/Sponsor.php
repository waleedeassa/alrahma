<?php

namespace App\Models;

use App\Models\Orphan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsor extends Authenticatable
{
  use HasFactory, Notifiable,  SoftDeletes;

  protected $table = 'sponsors';
  protected $fillable = [
    'name',
    'type',
    'email',
    'status',
    'address',
    'photo',
    'phone',
    'password',
  ];

  protected $casts = [
    'type' => 'integer',
    'status' => 'boolean',
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  protected $hidden = [
    'password',
  ];
  // --------------------------------------------------------------------
  //  RELATIONSHIPS 
  // --------------------------------------------------------------------
  public function orphans()
  {
    return $this->hasMany(Orphan::class, 'sponsor_id');
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
  public function getTypeLabelAttribute(): string
  {
    return $this->getOptionLabel('sponsor_type', 'type');
  }
  // --------------------------------------------------------------------
  //  CHECKS  
  // --------------------------------------------------------------------
  public function canBeDeleted()
  {
    if ($this->orphans()->exists()) return 'لايمكن حذف الكفيل لوجود ايتام تابع له';
    return true;
  }
}
