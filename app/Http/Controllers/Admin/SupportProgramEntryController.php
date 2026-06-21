<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSupportProgramEntryRequest;
use App\Models\Attachment;
use App\Models\SupportProgram;
use App\Models\SupportProgramEntry;
use App\Traits\ResponseTrait;
use App\Traits\UploadManagerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class SupportProgramEntryController extends Controller implements HasMiddleware
{
  use UploadManagerTrait, ResponseTrait;

  public static function middleware()
  {
    return [
      new Middleware('can:إدارة سجلات الاستفادة من برامج الدعم', only: ['index', 'getSupportProgramEntries', 'show']),
      new Middleware('can:إضافة سجل استفادة من برامج الدعم', only: ['create', 'store']),
      new Middleware('can:تعديل سجل استفادة من برامج الدعم', only: ['edit', 'update']),
      new Middleware('can:حذف سجل استفادة من برامج الدعم', only: ['destroy']),
    ];
  }

  public function index()
  {
    $programs = SupportProgram::select('id', 'name')->get();
    $categories = config('options.support_beneficiary_categories');
    return view('admins.support-programs-entries.index', compact('programs', 'categories'));
  }

  public function getSupportProgramEntries(Request $request)
  {
    $entriesQuery = SupportProgramEntry::with(['program:id,name', 'attachments'])
      ->select([
        'id',
        'support_program_id',
        'beneficiary_category',
        'beneficiaries_count',
        'funding_source',
        'date',
      ]);

    if ($request->filled('support_program_id')) {
      $entriesQuery->where('support_program_id', $request->support_program_id);
    }
    if ($request->filled('beneficiary_category')) {
      $entriesQuery->where('beneficiary_category', $request->beneficiary_category);
    }
    if ($request->filled('funding_source')) {
      $entriesQuery->where('funding_source', 'like', '%' . $request->funding_source . '%');
    }
    if ($request->filled('date_from')) {
      $entriesQuery->whereDate('date', '>=', $request->date_from);
    }
    if ($request->filled('date_to')) {
      $entriesQuery->whereDate('date', '<=', $request->date_to);
    }

    return DataTables::eloquent($entriesQuery)
      ->addIndexColumn()
      ->addColumn('program_name', fn($entry) => $entry->program->name ?? '-')
      ->addColumn('category_label', fn($entry) => $entry->category_label)
      ->editColumn('date_formatted', fn($entry) => optional($entry->date)->format('Y-m-d'))
      ->addColumn('attachments_count', function ($entry) {
        $count = $entry->attachments->count();
        return $count
          ? '<span class="badge bg-success">' . $count . ' صورة</span>'
          : '<span class="badge bg-danger">لا يوجد</span>';
        // : '<span class="text-muted">لا يوجد</span>';
      })
      ->addColumn('action', fn($entry) => view('admins.support-programs-entries.datatables.actions', compact('entry'))->render())
      ->rawColumns(['attachments_count', 'action'])
      ->make(true);
  }

  public function create()
  {
    $programs = SupportProgram::select('id', 'name')->get();
    $categories = config('options.support_beneficiary_categories');
    return view('admins.support-programs-entries.create', compact('programs', 'categories'));
  }

  public function store(StoreSupportProgramEntryRequest $request)
  {
    DB::beginTransaction();
    try {
      $data = $request->safe()->except('attachments');
      $entry = SupportProgramEntry::create($data);

      if ($request->hasFile('attachments')) {
        $directory = 'support-programs/attachments/' . $entry->id;
        $this->uploadAttachments($entry, $request->file('attachments'), $directory);
      }

      DB::commit();
      return redirect()->route('admin.support-program-entries.index')
        ->with(['message' => 'تم إضافة السجل بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }

  public function show(SupportProgramEntry $supportProgramEntry)
  {
    $supportProgramEntry->load(['program', 'attachments']);
    return view('admins.support-programs-entries.show', ['entry' => $supportProgramEntry]);
  }

  public function edit(SupportProgramEntry $supportProgramEntry)
  {
    $programs = SupportProgram::select('id', 'name')->get();
    $categories = config('options.support_beneficiary_categories');
    $supportProgramEntry->load('attachments');

    return view('admins.support-programs-entries.edit', compact('supportProgramEntry', 'programs', 'categories'));
  }

  public function update(StoreSupportProgramEntryRequest $request, SupportProgramEntry $supportProgramEntry)
  {
    DB::beginTransaction();
    try {
      $data = $request->safe()->except('attachments');
      $supportProgramEntry->update($data);

      if ($request->hasFile('attachments')) {
        $directory = 'support-programs/attachments/' . $supportProgramEntry->id;
        $this->uploadAttachments($supportProgramEntry, $request->file('attachments'), $directory);
      }

      DB::commit();
      return redirect()->route('admin.support-program-entries.index')
        ->with(['message' => 'تم تعديل السجل بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }

  public function destroy(SupportProgramEntry $supportProgramEntry)
  {
    $this->deleteAllAttachments($supportProgramEntry);
    $supportProgramEntry->delete();
    return $this->successResponse('تم حذف السجل بنجاح');
  }

  public function deleteSupportProgramEntryAttachment(Attachment $attachment)
  {
    $this->deleteAttachment($attachment);
    return $this->successResponse('تم حذف المرفق بنجاح');
  }
}
