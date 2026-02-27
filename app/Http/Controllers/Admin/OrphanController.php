<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\User;
use App\Models\Family;
use App\Models\Orphan;
use App\Models\Sponsor;
use App\Models\Attachment;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Traits\UploadManagerTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\StoreOrphanRequest;

class OrphanController extends Controller
{
  use UploadManagerTrait;

  public function index()
  {
    $governorates = Governorate::select('id', 'name')->get();
    $sponsors = Sponsor::select('id', 'name')->get();
    return view('admins.orphans.index', compact('governorates', 'sponsors'));
  }
  public function getOrphans(Request $request)
  {
    // 1.base query
    $orphansQuery = Orphan::with(['family:id', 'sponsor:id,name', 'governorate:id,name', 'city:id,name'])
      ->select([
        'id',
        'family_id',
        'name_ar',
        'family_name_ar',
        'academic_level',
        'sponsor_id',
        'governorate_id',
        'city_id',
        'image',
        'orphan_sponsorship_code',
        'birth_date',
      ]);

    // 2.apply filters
    if ($request->sponsorship_status === '1') {
      $orphansQuery->sponsored();
    }
    if ($request->sponsorship_status === '0') {
      $orphansQuery->unsponsored();
    }
    if ($request->filled('academic_level')) {
      $orphansQuery->academicLevel($request->academic_level);
    }
    if ($request->filled('sponsor_id')) {
      $orphansQuery->where('sponsor_id', $request->sponsor_id);
    }
    if ($request->filled('governorate_id')) {
      $orphansQuery->where('governorate_id', $request->governorate_id);
    }
    // 3.return datatable response
    return DataTables::eloquent($orphansQuery)
      ->addIndexColumn()
      ->addColumn('image', function ($orphan) {
        return '<img src="' . $orphan->image_url . '" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" alt="orphan-image" />';
      })
      ->addColumn('family_file_no', function ($orphan) {
        return $orphan->family_id;
      })
      ->editColumn('orphan_sponsorship_code', function ($orphan) {
        return $orphan->orphan_sponsorship_code ?? '-';
      })
      ->editColumn('family_name_ar', function ($orphan) {
        return $orphan->family_name_ar;
      })
      ->editColumn('name_ar', function ($orphan) {
        return $orphan->name_ar;
      })
      ->editColumn('age', function ($orphan) {
        return $orphan->age_label;
      })
      ->editColumn('academic_level', function ($orphan) {
        return $orphan->academic_level_label ?? '-';
      })
      ->addColumn('sponsorship_status', function ($orphan) {
        $style = 'color: #fff; padding: 3px 8px; border-radius: 4px; display: inline-block; font-size: 11px; font-weight: bold; line-height: 1.2;';

        if ($orphan->sponsor_id) {
          return '<span style="background-color: #28a745; ' . $style . '">مكفول</span>';
        }
        return '<span style="background-color: #dc3545; ' . $style . '">غير مكفول</span>';
      })
      ->addColumn('sponsor_name', function ($orphan) {
        return $orphan->sponsor_badge;
      })
      ->addColumn('governorate_name', function ($orphan) {
        return $orphan->governorate ? $orphan->governorate->name : '-';
      })
      ->addColumn('city_name', function ($orphan) {
        return $orphan->city ? $orphan->city->name : '-';
      })
      ->addColumn('action', function ($orphan) {
        return view('admins.orphans.datatables.actions', compact('orphan'))->render();
      })
      ->rawColumns(['image', 'orphan_sponsorship_code', 'sponsorship_status', 'sponsor_name', 'action'])
      ->make(true);
  }
  public function create(Family $family)
  {
    $governorates = Governorate::oldest('id')->pluck('name', 'id')->toArray();
    $users = User::oldest('id')->pluck('name', 'id')->toArray();
    return view('admins.orphans.create', compact('governorates', 'users', 'family'));
  }
  public function store(StoreOrphanRequest $request)
  {
    DB::beginTransaction();
    try {
      $data = $request->safe()->except(['image', 'attachments']);
      if ($request->hasFile('image')) {
        $data['image'] = $this->uploadSimpleImage($request->file('image'), 'orphans/images');
      }
      $orphan = Orphan::create($data);
      if ($request->hasFile('attachments')) {
        $directory = 'orphans/' . 'attachments/' . $orphan->id;
        $this->uploadAttachments($orphan, $request->file('attachments'), $directory);
      }
      DB::commit();
      return redirect()->route('admin.orphans.index')
        ->with(['message' => 'تم إضافة اليتيم بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollBack();
      if (isset($data['image'])) {
        $this->deleteSimpleImage($data['image']);
      }
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }
  public function show(Orphan $orphan)
  {
    return view('admins.orphans.show', compact('orphan'));
  }
  public function edit(Orphan $orphan)
  {
    $orphan = Orphan::with(['family', 'attachments'])->findOrFail($orphan->id);
    $governorates = Governorate::oldest('id')->pluck('name', 'id')->toArray();
    $users = User::oldest('id')->pluck('name', 'id')->toArray();
    $sponsors = Sponsor::oldest('id')->pluck('name', 'id')->toArray();
    $cities = [];
    if ($orphan->governorate_id) {
      $cities = City::where('governorate_id', $orphan->governorate_id)->pluck('name', 'id')->toArray();
    }
    return view('admins.orphans.edit', compact('orphan', 'governorates', 'users', 'cities', 'sponsors'));
  }

  public function update(StoreOrphanRequest $request, Orphan $orphan)
  {
    DB::beginTransaction();
    try {
      $data = $request->safe()->except(['image', 'attachments']);
      if ($request->hasFile('image')) {
        $data['image'] = $this->uploadSimpleImage(
          $request->file('image'),
          'orphans/images',
          $orphan->image
        );
      }
      $orphan->update($data);
      if ($request->hasFile('attachments')) {
        $directory = 'orphans/attachments/' . $orphan->id;
        $this->uploadAttachments($orphan, $request->file('attachments'), $directory);
      }
      DB::commit();
      return redirect()->route('admin.orphans.index')
        ->with(['message' => 'تم تعديل بيانات اليتيم بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }

  function normalizeArabic($text)
  {
    $text = trim($text);

    $search  = ['أ', 'إ', 'آ', 'ة', 'ى', 'ؤ', 'ئ'];
    $replace = ['ا', 'ا', 'ا', 'ه', 'ي', 'و', 'ي'];

    return mb_strtolower(str_replace($search, $replace, $text));
  }
  // --- attachments ---
  public function viewOrphanAttachment(Attachment $attachment)
  {
    if (Storage::disk('uploads')->exists($attachment->full_path)) {
      return Storage::disk('uploads')->response($attachment->full_path);
    }
    abort(404);
  }
  public function downloadOrphanAttachment(Attachment $attachment)
  {
    if (Storage::disk('uploads')->exists($attachment->full_path)) {
      return Storage::disk('uploads')->download($attachment->full_path, $attachment->original_name);
    }
    abort(404);
  }
  public function deleteOrphanAttachment(Attachment $attachment)
  {
    try {
      $this->deleteAttachment($attachment);
      return redirect()->back()->with(['message' => 'تم حذف المرفق بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => 'حدث خطأ أثناء الحذف']);
    }
  }
  public function changeSponsoredOrphanToUnsponsored(Request $request, Orphan $orphan)
  {
    $request->validate(
      [
        'cancellation_reason' => 'required'
      ],
      [
        'cancellation_reason.required' => 'يرجى إدخال سبب إلغاء الكفالة'
      ]
    );
    $orphan->update([
      'sponsor_id' => null,
      'orphan_sponsorship_code' => null,
      'cancellation_reason' => $request->cancellation_reason,
    ]);
    return response()->json([
      'status' => true,
      'message' => 'تم تحديث حالة اليتيم إلى غير مكفول بنجاح'
    ]);
  }
}
