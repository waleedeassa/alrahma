<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orphan;
use App\Models\OrphanReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\OrphanReportRequest;

class OrphanReportController extends Controller
{
  public function create(Orphan $orphan)
  {
    return view('admins.orphan_reports.create', compact('orphan'));
  }
  public function store(OrphanReportRequest $request)
  {
    $data = $request->validated();
   $data['added_by'] = auth()->id();
    OrphanReport::create($data);
    return redirect()->back()->with(['message' => 'تم اضافة تقرير اليتيم بنجاح', 'type' => 'success']);
  }
  public function show(OrphanReport $orphanReport)
  {
    return view('admins.orphan_reports.show', compact('orphanReport'));
  }
  public function edit(OrphanReport $orphanReport)
  {
    return view('admins.orphan_reports.edit', compact('orphanReport'));
  }
  public function update(OrphanReportRequest $request, OrphanReport $orphanReport)
  {
    $data = $request->validated();
    $data['edited_by'] = auth()->id();
    $orphanReport->update($data);
    return redirect()->back()->with(['message' => 'تم تعديل تقرير اليتيم بنجاح', 'type' => 'success']);
  }
  public function destroy(OrphanReport $orphanReport)
  {
    $orphanReport->delete();
    return redirect()->back()
      ->with(['message' => 'تم  حذف تقرير اليتيم بنجاح', 'type' => 'success']);
  }
}
