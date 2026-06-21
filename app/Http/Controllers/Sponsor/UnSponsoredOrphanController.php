<?php

namespace App\Http\Controllers\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Orphan;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UnSponsoredOrphanController extends Controller
{
  public function index()
  {
    return view('sponsors.unsponsored-orphans.index');
  }

  public function getData()
  {
    $orphans = Orphan::where('sponsorship_status', 0)
      ->whereNull('sponsor_id')
      ->with(['governorate:id,name', 'city:id,name'])
      ->select('id', 'name_ar', 'family_name_ar', 'birth_date', 'gender', 'governorate_id', 'city_id');

    return DataTables::of($orphans)
      ->addIndexColumn()
      ->editColumn('gender', function ($orphan) {
        return config('options.gender')[$orphan->gender] ?? '-';
      })
      ->editColumn('birth_date', function ($orphan) {
        return $orphan->birth_date ?? '-';
      })
      ->addColumn('governorate', function ($orphan) {
        return $orphan->governorate->name ?? '-';
      })
      ->addColumn('city', function ($orphan) {
        return $orphan->city->name ?? '-';
      })
      ->make(true);
  }
}