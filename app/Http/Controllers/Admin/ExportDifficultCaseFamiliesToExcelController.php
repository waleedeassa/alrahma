<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DifficultCaseFamiliesExport;

class ExportDifficultCaseFamiliesToExcelController extends Controller
{
    public function exportDifficultCaseFamilies()
    {
      return Excel::download(new DifficultCaseFamiliesExport, 'الأسر فى وضعية صعبة.xlsx');
    }
}
