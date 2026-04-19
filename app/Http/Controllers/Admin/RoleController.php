<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class RoleController extends Controller implements HasMiddleware
{
  use ResponseTrait;
  public static function middleware()
  {
    return [
      new Middleware('can:استعراض المسؤولين', only: ['index', 'getRoles']),
      new Middleware('can:اضافة مسؤول', only: ['store']),
      new Middleware('can:تعديل مسؤول', only: ['update']),
      new Middleware('can:حذف مسؤول', only: ['destroy']),
    ];
  }
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
  public function store(RoleRequest $request)
  {
    Role::create(['name' => $request->name]);
    return $this->successResponse(__('تم اضافة المسؤول بنجاح'), 201);
  }
  public function update(RoleRequest $request, Role $role)
  {
    if ($role->id === 1) {
      return $this->errorResponse('لا يمكن تعديل الدور الأساسي', 403);
    }
    $role->update(['name' =>  $request->name]);
    return $this->successResponse(__('تم تعديل المسؤول بنجاح'), 200);
  }
  public function destroy(Role $role)
  {
    if ($role->id === 1) {
      return $this->errorResponse('لا يمكن حذف الدور الأساسي', 403);
    }
    if ($role->users()->exists()) {
      return $this->errorResponse(__('لا يمكن حذف المسؤول لانه يحتوي على مستخدمين'), 403);
    }
    $role->delete();
    return $this->successResponse(__('تم حذف المسؤول بنجاح'), 200);
  }
}
