<?php

namespace App\Models;

use App\Models\Orphan;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Sponsor extends Authenticatable
{
  use HasFactory, Notifiable,  SoftDeletes;

  protected $table = 'sponsors';
  protected $fillable = [
    'name',
    'email',
    'status',
    'address',
    'photo',
    'phone',
    'password',
  ];

  protected $casts = [
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

    protected function photoUrl(): Attribute
  {
    return Attribute::make(
      get: function () {
        if ($this->photo) {
          return \Storage::disk('uploads')->url($this->photo);
        }
        return url('dashboard/assets/images/profile-avatar.jpg');
      }
    );
  }
  private function getOptionLabel(string $optionType, string $attributeName): string
  {
    $key = $this->attributes[$attributeName] ?? null;

    if (is_null($key)) {
      return 'غير متوفر';
    }

    return config("options.{$optionType}.{$key}", 'قيمة غير معروفة');
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