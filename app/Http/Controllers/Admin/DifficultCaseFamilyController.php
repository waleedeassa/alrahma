<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DifficultCaseFamily;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\StoreDifficultCaseFamilyRequest;

class DifficultCaseFamilyController extends Controller
{
  public function index()
  {
    return view('admins.difficult_case_families.index');
  }

  public function getDifficultCaseFamilies()
  {
    $cases = DifficultCaseFamily::with('governorate', 'city')
      ->select([
        'id',
        'first_name_ar',
        'last_name_ar',
        'governorate_id',
        'city_id',
        'family_members_count',
        'difficult_case_type',
        'social_status',
        'phone',
        'national_id_no',
        'birth_date',
      ]);
    return DataTables::eloquent($cases)
      ->addIndexColumn()
      ->addColumn('governorate_name', function ($case) {
        return $case->governorate->name ?? 'غير محدد';
      })
      ->addColumn('city_name', function ($case) {
        return $case->city->name ?? 'غير محدد';
      })
      ->addColumn('difficult_case_type_label', function ($case) {
        return $case->difficult_case_type_label;
      })
      ->addColumn('social_status_label', function ($case) {
        return $case->social_status_label;
      })
      ->editColumn('family_members_count', function ($case) {
        return $case->family_members_count == 0
          ? '-'
          // : '<div class="count-badge">' . $case->family_members_count . '</div>';
          :  $case->family_members_count_for_display;
      })
      ->addColumn('action', function ($case) {
        return view('admins.difficult_case_families.datatables.actions', ['difficultCaseFamily' => $case])->render();
      })
      ->rawColumns(['action', 'governorate_name', 'city_name', 'family_members_count', 'difficult_case_type_label', 'social_status_label'])
      ->make(true);
  }
  public function create()
  {
    $governorates = Governorate::oldest('id')->pluck('name', 'id')->toArray();
    return view('admins.difficult_case_families.create', compact('governorates'));
  }
  public function store(StoreDifficultCaseFamilyRequest $request)
  {
    $validatedData = $request->validated();
    $validatedData['added_by'] = auth()->id();
    DB::beginTransaction();
    try {
      DifficultCaseFamily::create($validatedData);
      DB::commit();
      return redirect()->route('admin.difficult-case-families.index')
        ->with(['message' => 'تم اضافة البيانات بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }
  public function show(DifficultCaseFamily $difficultCaseFamily)
  {
    return view('admins.difficult_case_families.show', compact('difficultCaseFamily'));
  }
  public function edit(DifficultCaseFamily $difficultCaseFamily)
  {
    $governorates = Governorate::oldest('id')->pluck('name', 'id')->toArray();
    $cities = City::oldest('id')->select('name', 'id')->get();
    return view('admins.difficult_case_families.edit', compact('difficultCaseFamily', 'governorates', 'cities'));
  }
  public function update(StoreDifficultCaseFamilyRequest $request, DifficultCaseFamily $difficultCaseFamily)
  {
    $validatedData = $request->validated();
    $validatedData['updated_by'] = auth()->id();
    // dd($validatedData);
    DB::beginTransaction();
    try {
      $difficultCaseFamily->update($validatedData);
      DB::commit();
      return redirect()->route('admin.difficult-case-families.index')
        ->with(['message' => 'تم تعديل البيانات بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }
  public function destroy(DifficultCaseFamily $difficultCaseFamily)
  {
    $check = $difficultCaseFamily->canBeDeleted();
    if ($check !== true) {
      return redirect()->back()->with(['message' => __($check), 'type' => 'error']);
    }
    $difficultCaseFamily->delete();
    return redirect()->route('admin.difficult-case-families.index')
      ->with(['message' => 'تم حذف البيانات بنجاح', 'type' => 'success']);
  }
}
