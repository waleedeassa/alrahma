<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\PermissionRequest;

class PermissionController extends Controller
{
  use ResponseTrait;
  // public function __construct()
  // {
  //   $this->middleware('permission:استعراض الصلاحيات', ['only' => ['index']]);
  //   $this->middleware('permission:اضافة صلاحية', ['only' => ['create', 'store']]);
  //   $this->middleware('permission:تعديل صلاحية', ['only' => ['edit', 'update']]);
  //   $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
  // }

  public function index()
  {
    $groups = config('options.PERMISSION_GROUP');
    return view('admins.permissions.index', compact('groups'));
  }

  public function getPermissions()
  {
    $permissions = Permission::get();
    return DataTables::of($permissions)
      ->addIndexColumn()
      ->addColumn('created_at', function ($permission) {
        return $permission->created_at->format('Y-m-d');
      })
      ->addColumn('action', function ($permission) {
        return view('admins.permissions.datatables.actions', compact('permission'))->render();
      })
      ->rawColumns(['action'])
      ->make(true);
  }
  public function store(PermissionRequest $request)
  {
    Permission::create($request->validated());
    return $this->successResponse(__('تم اضافة الصلاحيه بنجاح'), 201);
  }
  public function update(PermissionRequest $request, Permission $permission)
  {
    $permission->update($request->validated());
    return $this->successResponse(__('تم تعديل الصلاحيه بنجاح'), 200);
  }

  public function destroy(Permission $permission)
  {
    if ($permission->roles()->exists()) {
      return $this->errorResponse(__('لا يمكن حذف الصلاحية لأنها مُسندة لأحد الأدوار.'), 403);
      return response()->json(['status' => 'error', 'message' => 'لا يمكن حذف الصلاحية لأنها مُسندة لأحد الأدوار.'], 422);
    }
    $permission->delete();
    return $this->successResponse(__('تم حذف الصلاحية بنجاح'), 200);
  }
}
