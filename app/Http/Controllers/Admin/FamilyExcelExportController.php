<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\FamiliesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class FamilyExcelExportController extends Controller
{
  // public function __construct()
  // {
  //   $this->middleware('permission:تصدير بيانات الأسر الى اكسيل', ['only' => ['exportFamilies']]);
  // }

  public function exportFamilies()
  {
    ini_set('memory_limit', '-1');
    set_time_limit(0);
    return Excel::download(new FamiliesExport, 'الأسر.xlsx');
  }
}
