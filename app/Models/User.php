<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\DifficultCaseFamily;
use App\Models\Family;
use App\Models\FamilyReport;
use App\Models\Orphan;
use App\Models\OrphanReport;
use App\Models\SpecialNeedsPerson;
use App\Traits\HasHomeRoute;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasFactory, Notifiable, HasRoles, HasHomeRoute;

  // --------------------------------------------------------------------
  // Configuration
  // --------------------------------------------------------------------
  protected $fillable = [
    'name',
    'family_name',
    'email',
    'status',
    'password',
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
  // --------------------------------------------------------------------
  // Accessors & Attributes
  // --------------------------------------------------------------------
  public function getCreatedAtAttribute($value)
  {
    return date('Y-m-d ', strtotime($value));
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
  // --------------------------------------------------------------------
  // Relationships
  // --------------------------------------------------------------------
  public function familiesAdded()
  {
    return $this->hasMany(Family::class, 'added_by');
  }
  public function orphanReportsAdded()
  {
    return $this->hasMany(OrphanReport::class, 'added_by');
  }
  public function familyReportsAdded()
  {
    return $this->hasMany(FamilyReport::class, 'added_by');
  }
  public function difficultCasesAdded()
  {
    return $this->hasMany(DifficultCaseFamily::class, 'added_by');
  }
  public function specialNeedsPeopleAdded()
  {
    return $this->hasMany(SpecialNeedsPerson::class, 'added_by');
  }
  public function supervisedOrphans()
  {
    return $this->hasMany(Orphan::class, 'supervisor_id');
  }
  // --------------------------------------------------------------------
  // Helpers
  // --------------------------------------------------------------------

  public static function getPermissionsByGroupName($group_name)
  {
    $permissions = DB::table('permissions')
      ->select('name', 'id')
      ->where('group_name', $group_name)
      ->get();

    return $permissions;
  }
  public function isSuperAdmin(): bool
  {
    return $this->id === 1;
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
  // --------------------------------------------------------------------
  // Checks
  // --------------------------------------------------------------------

  public function canBeDeleted(): true|string
  {
    if ($this->familiesAdded()->exists())
      return 'لا يمكن حذف المستخدم لأنه أضاف أسراً في النظام';
    if ($this->orphanReportsAdded()->exists())
      return 'لا يمكن حذف المستخدم لأنه أضاف تقارير أيتام';
    if ($this->familyReportsAdded()->exists())
      return 'لا يمكن حذف المستخدم لأنه أضاف تقارير أسر';
    if ($this->difficultCasesAdded()->exists())
      return 'لا يمكن حذف المستخدم لأنه أضاف حالات صعبة';
    if ($this->specialNeedsPeopleAdded()->exists())
      return 'لا يمكن حذف المستخدم لأنه أضاف ذوي احتياجات خاصة';
    if ($this->supervisedOrphans()->exists())
      return 'لا يمكن حذف المستخدم لأنه مشرف على أيتام';
    return true;
  }
}
