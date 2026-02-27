<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    $governorates = Governorate::all();
    return view('admins.cities.index', compact('governorates'));
  }
  public function citiesDataTable()
  {
    $cities = City::with('governorate');
    return DataTables::of($cities)
      ->addIndexColumn()
      ->addColumn('governorate_name', function ($city) {
        return $city->governorate->name ?? 'N/A';
      })
      ->addColumn('action', function ($city) {
        return view('admins.cities.datatables.actions', compact('city'))->render();
      })
      ->rawColumns(['action'])
      ->make(true);
  }
  public function store(CityRequest $request)
  {
    $city = City::create($request->validated());
    if ($city) {
      return $this->successResponse('تم اضافة المدينة بنجاح', 201);
    }
    return $this->errorResponse('حدث خطأ ما', 500);
  }
  public function update(CityRequest $request, City $city)
  {
    $city->update($request->validated());
    if ($city) {
      return $this->successResponse('تم تعديل المدينة بنجاح', 201);
    }
    return $this->errorResponse('حدث خطأ ما', 500);
  }
  public function destroy(City $city)
  {
    $check = $city->canBeDeleted();
    if ($check !== true) {
      return $this->errorResponse($check, 403);
    }
    try {
      $city->delete();
      return $this->successResponse('تم حذف المدينة بنجاح', 200);
    } catch (\Exception $e) {
      return $this->errorResponse('حدث خطأ ما', 500);
    }
  }
}
