<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DifficultCasesSupportProgramsSearchExport;
use App\Services\DifficultCasesSupportProgramSearchService;

class DifficultCaseSupportProgramSearchExcelExportController extends Controller
{
  // exportDifficultCaseSupportProgramsSearch
  protected $searchService;
  public function __construct(DifficultCasesSupportProgramSearchService $searchService)
  {
    $this->searchService = $searchService;
  }
  public function exportDifficultCaseSupportProgramsSearch(Request $request)
  {
    ini_set('memory_limit', '-1');
    set_time_limit(0);

    $filters = $request->all();
    return Excel::download(
      new DifficultCasesSupportProgramsSearchExport($filters, $this->searchService),
      __('بحث  برامج الدعم للأسر في وضعية صعبة') . ".xlsx"
    );
  }
}
