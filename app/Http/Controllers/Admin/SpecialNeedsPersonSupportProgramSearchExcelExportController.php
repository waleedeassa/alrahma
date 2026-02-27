<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SpecialNeedsPersonSupportProgramSearchService;
use App\Exports\SpecialNeedsPersonSupportProgramsSearchExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SpecialNeedsPersonSupportProgramSearchExcelExportController extends Controller
{
  protected $searchService;

  public function __construct(SpecialNeedsPersonSupportProgramSearchService $searchService)
  {
    $this->searchService = $searchService;
  }

  public function exportSpecialNeedsPersonSupportProgramsSearch(Request $request)
  {
    ini_set('memory_limit', '-1');
    set_time_limit(0);
    $filters = $request->all();
    return Excel::download(
      new SpecialNeedsPersonSupportProgramsSearchExport($filters, $this->searchService),
      __('بحث برامج الدعم للمرضى وذوي الاحتياجات') . ".xlsx"
    );
  }
}
