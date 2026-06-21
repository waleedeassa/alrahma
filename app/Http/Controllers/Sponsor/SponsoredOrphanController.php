<?php

namespace App\Http\Controllers\Sponsor;

use App\Models\Orphan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SponsoredOrphanController extends Controller
{
  public function index()
  {
    return view('sponsors.sponsor-orphans.index');
  }

  public function getSponsoredOrphans()
  {
    $orphans = Orphan::where('sponsorship_status', 1)
      ->where('sponsor_id', Auth::user()->id)
      ->with(['governorate:id,name', 'city:id,name'])
      ->select('id', 'name_ar', 'family_name_ar', 'birth_date', 'gender', 'governorate_id', 'city_id', 'image');

    return DataTables::of($orphans)
      ->addIndexColumn()
      ->editColumn('gender', function ($orphan) {
        return config('options.gender')[$orphan->gender] ?? '-';
      })
      ->editColumn('birth_date', function ($orphan) {
        return $orphan->birth_date;
      })
      ->addColumn('governorate', function ($orphan) {
        return $orphan->governorate->name ?? '-';
      })
      ->addColumn('city', function ($orphan) {
        return $orphan->city->name ?? '-';
      })
      ->addColumn('action', function ($orphan) {
        return view('sponsors.sponsor-orphans.datatables.actions', compact('orphan'))->render();
      })
      ->rawColumns(['action', 'gender', 'birth_date', 'governorate', 'city'])
      ->make(true);
  }

  public function sponsoredOrphanDetails(Orphan $orphan)
  {
    if (!auth()->user()->orphans->contains($orphan)) {
      return redirect()
        ->route('sponsor.sponsored-orphans')
        ->with(['message' => 'لا يمكنك الوصول إلى بيانات هذا اليتيم', 'type' => 'error']);
    }
    return view('sponsors.sponsor-orphans.show', compact('orphan'));
  }
}