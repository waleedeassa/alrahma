<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionsController extends Controller
{
  // public function __construct()
  // {
  //   $this->middleware('permission:استعراض صلاحيات المسؤولين', ['only' => ['index']]);
  //   $this->middleware('permission:اضافة صلاحيات مسؤول', ['only' => ['create', 'store']]);
  //   $this->middleware('permission:تعديل صلاحيات مسؤول', ['only' => ['edit', 'update']]);
  //   $this->middleware('permission:حذف مسؤول مع صلاحياته', ['only' => ['destroy']]);
  // }

  public function index()
  {
    $data['roles'] = Role::all();
    return view('admins.role_permissions.index', $data);
  }

  public function create()
  {
    $data['roles'] = Role::pluck('name', 'id')->toArray();;
    // $data['permissions'] = Permission::all();
    $data['permission_groups'] = $this->getPermissionsGroupName();
    return view('admins.role_permissions.create', $data);
  }

  public function getPermissionsGroupName()
  {
    $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
    return $permission_groups;
  }

  public function store(Request $request)
  {
    $role_id = $request->role_id;
    $permissions =  $request->permission;

    foreach ($permissions as $key => $value) {
      DB::table('role_has_permissions')->insert([
        'permission_id' =>  $value,
        'role_id' => $role_id,
      ]);
    }
    return redirect()->route('admin.role-permissions.index')
      ->with(['message' => 'تم اضافة صلاحيات المسؤول بنجاح', 'type' => 'success']);;
  }

  public function edit($id)
  {
    $data['role'] = Role::find($id);
    $data['permissions'] = Permission::all();
    $data['permission_groups'] = $this->getPermissionsGroupName();
    return view('admins.role_permissions.edit', $data);
  }

  public function update(Request $request, $id)
  {
    $role = Role::findOrFail($id);
    $permissions = $request->permission;

    if (!empty($permissions)) {
      $permissionNames = Permission::whereIn('id',$permissions)->pluck('name')->toArray();
      $role->syncPermissions($permissionNames);
      // $role->permissions()->sync($request->input('permission'));
    }
    return redirect()->route('admin.role-permissions.index')
      ->with(['message' => 'تم تعديل صلاحيات المسؤول بنجاح', 'type' => 'success']);
  }

  public function destroy($id)
  {
    $role = Role::findOrFail($id);
    if (!is_null($role)) {
      $role->delete();
    }
    return redirect()->route('admin.role-permissions.index')
      ->with(['message' => 'تم حذف المسؤول وصلاحياته بنجاح', 'type' => 'success']);
  }
}
