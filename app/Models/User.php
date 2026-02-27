<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory, Notifiable, HasRoles;

  protected $fillable = [
    'name',
    'family_name',
    'email',
    'status',
    'password',
    'status',
    'photo',
    'phone',
  ];
  protected $hidden = [
    'password',
    'remember_token',
  ];
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }
  public function getCreatedAtAttribute($value)
  {
    return date('Y-m-d ', strtotime($value));
  }

  public static function getPermissionsByGroupName($group_name)
  {
    $permissions = DB::table('permissions')
      ->select('name', 'id')
      ->where('group_name', $group_name)
      ->get();

    return $permissions;
  }
  public static function roleHasPermissions($role, $permissions)
  {
    $hasPermission = true;
    foreach ($permissions as $permission) {
      if (!$role->hasPermissionTo($permission->name)) {
        $hasPermission = false;
        return $hasPermission;
      }
      return $hasPermission;
    }
  }
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
}
