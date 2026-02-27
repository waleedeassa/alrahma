<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\FamilySearchExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\FamiliesSearchService;

class FamilySearchExcelExportController extends Controller
{
  protected $searchService;
  public function __construct(FamiliesSearchService $searchService)
  {
    $this->searchService = $searchService;
  }
  public function exportFamiliesSearch(Request $request)
  {
    ini_set('memory_limit', '-1');
    set_time_limit(0);
    $filters = $request->all();
    return Excel::download(new FamilySearchExport($filters, $this->searchService),__('بحث أسر الأيتام') . ".xlsx");
  }
}
