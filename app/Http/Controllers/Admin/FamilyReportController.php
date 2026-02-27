<?php

namespace App\Http\Controllers\Admin;

use App\Models\Family;
use App\Models\FamilyReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFamilyReportRequest;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class FamilyReportController extends Controller
{
  //   public function __construct()
  //   {
  //     $this->middleware('permission:إضافة تقرير اليتيم', ['only' => ['create', 'store']]);
  //     $this->middleware('permission:تعديل تقرير اليتيم', ['only' => ['edit', 'update']]);
  //     $this->middleware('permission:حذف تقرير اليتيم', ['only' => ['destroy']]);
  //     $this->middleware('permission:معاينة تقرير اليتيم', ['only' => ['show']]);
  //     $this->middleware('permission:الإطلاع على مرفقات تقرير اليتيم', ['only' => ['showOrphanReportAttachments']]);
  //     $this->middleware('permission:معاينة مرفقات تقرير اليتيم', ['only' => ['viewOrphanReportAttachment']]);
  //     $this->middleware('permission:تحميل مرفقات تقرير اليتيم', ['only' => ['downloadwOrphanReportAttachment']]);
  //     $this->middleware('permission:حذف مرفقات تقرير اليتيم', ['only' => ['deleteOrphanReportAttachment']]);
  //   }

  public function create(Family $family)
  {
    return view('admins.annual_family_reports.create', compact('family'));
  }
  public function store(StoreFamilyReportRequest $request)
  {
    $familyReport = FamilyReport::create($request->validated());
    if ($familyReport) {
      return redirect()->back()->with(['message' => 'تم اضافة تقرير الأسرة بنجاح', 'type' => 'success']);
    }
    return redirect()->back()->withErrors(['error' => 'حدث خطأ ما']);
  }
  public function show(FamilyReport $familyReport)
  {
    return view('admins.annual_family_reports.show', compact('familyReport'));
  }
  public function edit(FamilyReport $familyReport)
  {
    return view('admins.annual_family_reports.edit', compact('familyReport'));
  }
  public function update(StoreFamilyReportRequest $request, FamilyReport $familyReport)
  {
    $familyReport->update($request->validated());
    return redirect()->back()
      ->with(['message' => 'تم تعديل تقرير اليتيم بنجاح', 'type' => 'success']);
  }
  public function destroy(FamilyReport $familyReport)
  {
    $familyReport->delete();
    return redirect()->back()
      ->with(['message' => 'تم  حذف تقرير الأسرة بنجاح', 'type' => 'success']);
  }
}
