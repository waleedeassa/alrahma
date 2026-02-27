<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\SupportProgram;
use App\Http\Controllers\Controller;
use App\Services\DifficultCasesSupportProgramSearchService;
use App\Http\Requests\Admin\SearchDifficultCaseSupportProgramRequest;

class DifficultCaseSupportProgramSearchController extends Controller
{
  use ResponseTrait;

  protected $searchService;
  public function __construct(DifficultCasesSupportProgramSearchService $searchService)
  {
    $this->searchService = $searchService;
  }
  // public static function middleware()
  // {
  //   return [
  //     new Middleware('can:manage_orders_report', only: ['index', 'search']),
  //   ];
  // }
  public function index()
  {
    $supportPrograms = SupportProgram::select('id', 'name')->get();
    return view('admins.reports.difficult_cases_support_programs.index', compact('supportPrograms'));
  }
  public function search(SearchDifficultCaseSupportProgramRequest  $request)
  {
    $filters = array_filter($request->validated());
    if (empty($filters)) {
      return $this->errorResponse("الرجاء إدخال معيار بحث واحد على الأقل.", 422);
    }
    $data = $this->searchService->search($filters);
    return view(
      'admins.reports.difficult_cases_support_programs.partials.cases_support_program_table',
      [
        'results' => $data['results'],
        'filters' =>  $filters,
      ]
    );
  }
}
