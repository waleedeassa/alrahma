<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
  use ResponseTrait;
  // public function __construct()
  // {
  //   $this->middleware('permission:استعراض المسؤولين', ['only' => ['index']]);
  //   $this->middleware('permission:اضافة مسؤول', ['only' => ['create', 'store']]);
  //   $this->middleware('permission:تعديل مسؤول', ['only' => ['edit', 'update']]);
  //   $this->middleware('permission:حذف مسؤول', ['only' => ['destroy']]);
  // }
  public function index()
  {
    return view('admins.roles.index');
  }
  public function getRoles()
  {
    $roles = Role::get();
    return DataTables::of($roles)
      ->addIndexColumn()
      ->addColumn('created_at', function ($role) {
        return $role->created_at->format('Y-m-d');
      })
      ->addColumn('action', function ($role) {
        return view('admins.roles.datatables.actions', compact('role'))->render();
      })
      ->rawColumns(['action'])
      ->make(true);
  }
  public function create()
  {
    return view('admins.roles.create');
  }
  public function store(RoleRequest $request)
  {
    Role::create(['name' => $request->name]);
    return $this->successResponse(__('تم اضافة المسؤول بنجاح'), 201);
  }
  public function update(RoleRequest $request, Role $role)
  {
    $role->update(['name' =>  $request->name]);
    return $this->successResponse(__('تم تعديل المسؤول بنجاح'), 200);
  }
  public function destroy(Role $role)
  {
    if ($role->users()->exists()) {
      return $this->errorResponse(__('لا يمكن حذف المسؤول لانه يحتوي على مستخدمين'), 403);
    }
    $role->delete();
    return $this->successResponse(__('تم حذف المسؤول بنجاح'), 200);
  }
}
