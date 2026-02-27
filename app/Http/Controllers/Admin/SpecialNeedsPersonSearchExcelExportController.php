<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\SpecialNeedsPeopleSearchExport;
use App\Services\SpecialNeedsPeopleSearchService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SpecialNeedsPersonSearchExcelExportController extends Controller
{
  protected $searchService;
  public function __construct(SpecialNeedsPeopleSearchService $searchService)
  {
    $this->searchService = $searchService;
  }
  public function exportSpecialNeedsPeopleSearch(Request $request)
  {
    ini_set('memory_limit', '-1');
    set_time_limit(0);

    $filters = $request->all();
    return Excel::download(
      new SpecialNeedsPeopleSearchExport($filters, $this->searchService),
      __('بحث ذوي الاحتياجات الخاصة') . ".xlsx"
    );
  }
}
