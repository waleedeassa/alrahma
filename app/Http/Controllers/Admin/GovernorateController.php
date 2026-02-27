<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\GovernorateRequest;

class GovernorateController extends Controller
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
    return view('admins.governorates.index');
  }
  public function governoratesDataTable()
  {
    $governorates = Governorate::withCount('cities');
    return DataTables::of($governorates)
      ->addIndexColumn()
      ->addColumn('cities_count', function ($governorate) {
        return $governorate->cities_count == 0
          ? '-'
          : '<div class="count-badge">' . $governorate->cities_count . '</div>';
      })
      ->addColumn('action', function ($governorate) {
        return view('admins.governorates.datatables.actions', compact('governorate'))->render();
      })
      ->rawColumns(['action', 'cities_count'])
      ->make(true);
  }
  public function store(GovernorateRequest $request)
  {
    $governorate = Governorate::create($request->validated());
    if ($governorate) {
      return $this->successResponse('تم اضافة الاقليم بنجاح', 201);
    }
    return $this->errorResponse('حدث خطأ ما', 500);
  }
  public function update(GovernorateRequest $request, Governorate $governorate)
  {
    $governorate->update($request->validated());
    if ($governorate) {
      return $this->successResponse('تم تعديل الاقليم بنجاح', 201);
    }
    return $this->errorResponse('حدث خطأ ما', 500);
  }
  public function destroy(Governorate $governorate)
  {
    $check = $governorate->canBeDeleted();
    if ($check !== true) {
      return $this->errorResponse($check, 403);
    }
    try {
      $governorate->delete();
      return $this->successResponse('تم حذف الاقليم بنجاح', 200);
    } catch (\Exception $e) {
      return $this->errorResponse('حدث خطأ ما', 500);
    }
  }

  public function getCities($id)
  {
    $cities = City::where('governorate_id', $id)->pluck('name', 'id');
    return $cities;
  }
}
