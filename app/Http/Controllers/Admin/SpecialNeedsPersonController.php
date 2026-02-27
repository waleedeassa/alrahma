<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Governorate;
use App\Models\SpecialNeedsPerson;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\StoreSpecialNeedsPersonRequest;

class SpecialNeedsPersonController extends Controller
{
  public function index()
  {
    return view('admins.special_needs_people.index');
  }

  public function getSpecialNeedsPeople()
  {
    $cases = SpecialNeedsPerson::with('governorate', 'city')
      ->select([
        'id',
        'first_name_ar',
        'last_name_ar',
        'governorate_id',
        'city_id',
        'family_members_count',
        'special_needs_type',
        'social_status',
        'phone',
        'national_id_no',
        'birth_date',
      ]);
    return DataTables::eloquent($cases)
      ->addIndexColumn()
      ->addColumn('governorate_name', function ($case) {
        return optional($case->governorate)->name ?? 'غير محدد';
      })
      ->addColumn('city_name', function ($case) {
        return optional($case->city)->name ?? 'غير محدد';
      })
      ->addColumn('special_needs_type_label', function ($case) {
        return $case->special_needs_type_label;
      })
      ->addColumn('social_status_label', function ($case) {
        return $case->social_status_label;
      })
      ->editColumn('family_members_count', function ($case) {
        return $case->family_members_count == 0
          ? '-'
          : $case->family_members_count_for_display;
      })
      ->addColumn('action', function ($case) {
        return view('admins.special_needs_people.datatables.actions', ['specialNeedsPerson' => $case])->render();
      })
      ->rawColumns(['action', 'governorate_name', 'city_name', 'family_members_count', 'special_needs_type_label', 'social_status_label'])
      ->make(true);
  }

  public function create()
  {
    $governorates = Governorate::oldest('id')->pluck('name', 'id')->toArray();
    return view('admins.special_needs_people.create', compact('governorates'));
  }

  public function store(StoreSpecialNeedsPersonRequest $request)
  {
    $validatedData = $request->validated();
    $validatedData['added_by'] = auth()->id();

    DB::beginTransaction();
    try {
      SpecialNeedsPerson::create($validatedData);
      DB::commit();
      return redirect()->route('admin.special-needs-people.index')
        ->with(['message' => 'تم إضافة البيانات  بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }
  public function show(SpecialNeedsPerson $specialNeedsPerson)
  {
    return view('admins.special_needs_people.show', compact('specialNeedsPerson'));
  }
  public function edit(SpecialNeedsPerson $specialNeedsPerson)
  {
    $governorates = Governorate::oldest('id')->pluck('name', 'id')->toArray();
    $cities = City::where('governorate_id', $specialNeedsPerson->governorate_id)
      ->oldest('id')
      ->pluck('name', 'id')
      ->toArray();

    return view('admins.special_needs_people.edit', compact('specialNeedsPerson', 'governorates', 'cities'));
  }
  public function update(StoreSpecialNeedsPersonRequest $request, SpecialNeedsPerson $specialNeedsPerson)
  {
    $validatedData = $request->validated();
    $validatedData['updated_by'] = auth()->id();

    DB::beginTransaction();
    try {
      $specialNeedsPerson->update($validatedData);
      DB::commit();
      return redirect()->route('admin.special-needs-people.index')
        ->with(['message' => 'تم تعديل البيانات بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }

  public function destroy(SpecialNeedsPerson $specialNeedsPerson)
  {
    $check = $specialNeedsPerson->canBeDeleted();
    if ($check !== true) {
      return redirect()->back()->with(['message' => __($check), 'type' => 'error']);
    }
    $specialNeedsPerson->delete();
    return redirect()->route('admin.special-needs-people.index')
      ->with(['message' => 'تم حذف البيانات بنجاح', 'type' => 'success']);
  }
}
