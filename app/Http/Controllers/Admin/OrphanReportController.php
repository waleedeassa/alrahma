<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrphanReportRequest;
use App\Models\Attachment;
use App\Models\Orphan;
use App\Models\OrphanReport;
use App\Traits\UploadManagerTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrphanReportController extends Controller
{
  use UploadManagerTrait;
  public function create(Orphan $orphan)
  {
    return view('admins.orphan_reports.create', compact('orphan'));
  }
  public function store(OrphanReportRequest $request)
  {
    DB::beginTransaction();
    try {
      $data             = $request->safe()->except(['attachments']);
      $data['added_by'] = auth()->id();

      $orphanReport = OrphanReport::create($data);

      if ($request->hasFile('attachments')) {
        $directory = 'orphan_reports/attachments/' . $orphanReport->id;
        $this->uploadAttachments($orphanReport, $request->file('attachments'), $directory);
      }

      DB::commit();
      return redirect()->back()
        ->with(['message' => 'تم إضافة تقرير اليتيم بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->withErrors(['error' => $e->getMessage()])
        ->withInput();
    }
  }
  public function show(OrphanReport $orphanReport)
  {
    return view('admins.orphan_reports.show', compact('orphanReport'));
  }
  public function edit(OrphanReport $orphanReport)
  {
    $orphanReport->load('attachments');
    return view('admins.orphan_reports.edit', compact('orphanReport'));
  }
  public function update(OrphanReportRequest $request, OrphanReport $orphanReport)
  {
    DB::beginTransaction();
    try {
      $data              = $request->safe()->except(['attachments']);
      $data['edited_by'] = auth()->id();

      $orphanReport->update($data);

      if ($request->hasFile('attachments')) {
        $directory = 'orphan_reports/attachments/' . $orphanReport->id;
        $this->uploadAttachments($orphanReport, $request->file('attachments'), $directory);
      }

      DB::commit();

      return redirect()->back()
        ->with(['message' => 'تم تعديل تقرير اليتيم بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->withErrors(['error' => $e->getMessage()])
        ->withInput();
    }
  }
  public function destroy(OrphanReport $orphanReport)
  {
    $this->deleteAllAttachments($orphanReport);
    $orphanReport->delete();
    return redirect()->back()
      ->with(['message' => 'تم حذف تقرير اليتيم بنجاح', 'type' => 'success']);
  }

  // ────────────────────────────────────────────
  //  Attachment methods
  // ────────────────────────────────────────────

  public function viewOrphanReportAttachment(Attachment $attachment)
  {
    $disk = Storage::disk('uploads');
    abort_unless($disk->exists($attachment->full_path), 404);

    return response()->file(
      $disk->path($attachment->full_path),
      ['Content-Type' => $disk->mimeType($attachment->full_path)]
    );
  }

  public function downloadOrphanReportAttachment(Attachment $attachment)
  {
    $disk = Storage::disk('uploads');
    abort_unless($disk->exists($attachment->full_path), 404);

    return $disk->download($attachment->full_path, $attachment->original_name);
  }

  public function deleteOrphanReportAttachment(Attachment $attachment)
  {
    $this->deleteAttachment($attachment);

    return redirect()->back()
      ->with(['message' => 'تم حذف المرفق بنجاح', 'type' => 'success']);
  }
}