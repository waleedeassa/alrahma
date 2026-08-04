<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\FamiliesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class FamilyExcelExportController extends Controller
{
  public function exportFamilies()
  {
    ini_set('memory_limit', '-1');
    set_time_limit(0);
    return Excel::download(new FamiliesExport, 'الأسر.xlsx');
  }
}
