<?php

namespace App\Http\Controllers\Sponsor;

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
  public function show(OrphanReport $orphanReport)
  {
    return view('sponsors.orphan_reports.show', compact('orphanReport'));
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
}
