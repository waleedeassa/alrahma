<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\OrphansExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class OrphanExcelExportController extends Controller
{
    //exportOrphans

      // public function __construct()
  // {
  //   $this->middleware('permission:تصدير بيانات الأيتام الى اكسيل', ['only' => ['exportFamilies']]);
  // }

  public function exportOrphans(Request $request)
  {
    // dd($request->all());
    ini_set('memory_limit', '-1');
    set_time_limit(0);
    return Excel::download(new OrphansExport($request->all()), 'الأيتام.xlsx');
  }
}
