<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DifficultCaseFamiliesSearchExport;
use App\Services\DifficultCaseFamiliesSearchService;

class DifficultCaseFamilySearchExcelExportController extends Controller
{
  protected $searchService;
  public function __construct(DifficultCaseFamiliesSearchService $searchService)
  {
    $this->searchService = $searchService;
  }
  public function exportDifficultCaseFamiliesSearch(Request $request)
  {
    ini_set('memory_limit', '-1');
    set_time_limit(0);
    $filters = $request->all();
    return Excel::download(new DifficultCaseFamiliesSearchExport($filters, $this->searchService), __('بحث  الأسر فى وضعية صعبة') . ".xlsx");
  }
}
