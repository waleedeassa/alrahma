<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\SponsorsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportSponsorsToExcelController extends Controller
{
  // public function __construct()
  // {
  //   $this->middleware('permission:تصدير بيانات الكفلاء إلى إكسيل', ['only' => ['exportSponsors']]);
  // }

  public function exportSponsors()
  {
    return Excel::download(new SponsorsExport, 'الكفلاء.xlsx');
  }
}
