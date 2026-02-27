<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Traits\ResponseTrait;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
  use ResponseTrait;
  public static function middleware()
  {
    return [
      // new Middleware('can:ادارة المستخدمين', only: ['index']),
      // new Middleware('can:add_user', only: ['create', 'store']),
      // new Middleware('can:edit_user', only: ['edit', 'update']),
      // new Middleware('can:delete_user', only: ['destroy']),
      // new Middleware('can:change_user_status', only: ['changeUserStatus']),
      // new Middleware('can:show_user', only: ['show']),
    ];
  }
  public function index()
  {
    // $roles = Role::pluck('name', 'id')->toArray();
    $roles = Role::all();
    return view('admins.users.index', compact('roles'));
  }
  public function usersDataTable()
  {
    $users = User::with('roles')->select('id', 'name', 'family_name', 'email', 'status', 'phone');
    return DataTables::of($users)
      ->addIndexColumn()
      ->editColumn('status', function ($user) {
        return view('admins.users.datatables.status', compact('user'))->render();
      })
      ->addColumn('role', function ($user) {
        return view('admins.users.datatables.role', compact('user'))->render();
      })
      ->addColumn('action', function ($user) {
        return view('admins.users.datatables.actions', compact('user'))->render();
      })
      ->rawColumns(['action', 'status', 'role'])
      ->make(true);
  }
  public function store(UserRequest $request)
  {
    $data = $request->validated();
    $data = array_merge($data, ['password' => Hash::make('12345678')]);
    $user = User::create($data);
    if ($request->role_id) {
      $role = Role::find($request->role_id);
      $user->assignRole($role->name);
    }
    return $this->successResponse('تم اضافة المستخدم بنجاح', 201);
  }
  public function update(UserRequest $request, User $user)
  {
    $data = $request->except('_token', '_method', 'id');
    $user->update($data);
    if ($request->role_id) {
      $currentRoleId = $user->roles->first()?->id;
      if ($currentRoleId != $request->role_id) {
        $user->roles()->detach();
        $role = Role::find($request->role_id);
        $user->assignRole($role->name);
      }
    }
    return $this->successResponse('تم تعديل المستخدم بنجاح', 201);
  }
  public function destroy(User $user)
  {
    // check if user is used in other tables
    // if ($user->isUsedWithOrders()) {
    //   return $this->errorResponse(__('dashboard.Cannot delete user because it is used with orders'), 403);
    // }
    if (!$user->delete()) {
      return $this->errorResponse('حدث خطأ ما', 500);
    }
    return $this->successResponse('تم حذف المستخدم بنجاح', 200);
  }
  public function changeUserStatus(Request $request, string $id)
  {
    $user =  User::find($id)->update(['status' => $request->status]);;
    if (!$user) {
      return $this->errorResponse('حدث خطأ ما', 500);
    }
    return $this->successResponse('تم تغيير حالة المستخدم بنجاح', 200);
  }
}
