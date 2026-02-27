<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFamilyRequest;
use App\Models\Attachment;
use App\Models\City;
use App\Models\Family;
use App\Models\Governorate;
use App\Traits\ResponseTrait;
use App\Traits\UploadManagerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class FamilyController extends Controller
{
  use ResponseTrait;
  use UploadManagerTrait;
  public function index()
  {
    return view('admins.families.index');
  }

  public function getFamilies()
  {
    $families = Family::with('governorate', 'city')
      ->select(['id', 'governorate_id', 'city_id', 'number_of_family_members', 'mother_name', 'mother_family_name', 'mother_id_no', 'mother_birth_date', 'bank_account_number'])
      ->latest('id');

    return DataTables::eloquent($families)
      ->addIndexColumn()
      ->addColumn('governorate_name', function ($family) {
        return $family->governorate->name;
      })
      ->addColumn('city_name', function ($family) {
        return $family->city->name;
      })
      ->editColumn('number_of_family_members', function ($family) {
        return $family->number_of_family_members == 0
          ? '-'
          :  $family->family_members_for_display;
      })
      ->addColumn('action', function ($family) {
        return view('admins.families.datatables.actions', compact('family'))->render();
      })
      ->rawColumns(['action', 'governorate_name', 'city_name', 'number_of_family_members'])
      ->make(true);
  }
  public function create()
  {
    $governorates = Governorate::oldest('id')->pluck('name', 'id')->toArray();
    return view('admins.families.create', compact('governorates'));
  }
  public function store(StoreFamilyRequest $request)
  {
    DB::beginTransaction();
    try {
      $data = $request->safe()->except(['attachments']);
      $family = Family::create($data);
      if ($request->hasFile('attachments')) {
        $directory = 'families/' . $family->id;
        $this->uploadAttachments(
          $family,
          $request->file('attachments'),
          $directory
        );
      }
      DB::commit();
      return redirect()->route('admin.families.index')
        ->with(['message' => 'تم اضافة الأسرة بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }
  public function show(Family $family)
  {
    return view('admins.families.show', compact('family'));
  }
  public function edit(Family $family)
  {
    $governorates = Governorate::oldest('id')->pluck('name', 'id')->toArray();
    $cities = City::oldest('id')->select('name', 'id')->get();
    return view('admins.families.edit', compact('family', 'governorates', 'cities'));
  }

  public function update(StoreFamilyRequest $request, Family $family)
  {
    DB::beginTransaction();
    try {
      $family->update($request->safe()->except(['attachments']));
      if ($request->hasFile('attachments')) {
        $directory = 'families/' . $family->id;
        $this->uploadAttachments(
          $family,
          $request->file('attachments'),
          $directory
        );
      }
      DB::commit();
      return redirect()->route('admin.families.index')
        ->with(['message' => 'تم تعديل الأسرة بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }
  public function destroy(Family $family)
  {
   
    $check = $family->canBeDeleted();
    if ($check !== true) {
      return redirect()->back()->with(['message' => __($check), 'type' => 'error']);
    }
    $family->delete();
    return redirect()->route('admin.families.index')
      ->with(['message' => 'تم حذف الأسرة بنجاح', 'type' => 'success']);
  }
  public function viewFamilyAttachment(Attachment $attachment)
  {
    if (Storage::disk('uploads')->exists($attachment->full_path)) {
      return Storage::disk('uploads')->response($attachment->full_path);
    }
    abort(404);
  }
  public function downloadFamilyAttachment(Attachment $attachment)
  {
    if (Storage::disk('uploads')->exists($attachment->full_path)) {
      return Storage::disk('uploads')->download($attachment->full_path, $attachment->original_name);
    }
    abort(404);
  }
  public function deleteFamilyAttachment(Attachment $attachment)
  {
    try {
      $this->deleteAttachment($attachment);
      return redirect()->back()->with(['message' => 'تم حذف المرفق بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => 'حدث خطأ أثناء الحذف']);
    }
  }
}
