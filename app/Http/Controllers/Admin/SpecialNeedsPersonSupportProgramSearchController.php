<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ResponseTrait;
use App\Models\SupportProgram;
use App\Http\Controllers\Controller;
use App\Services\SpecialNeedsPersonSupportProgramSearchService;
use App\Http\Requests\Admin\SearchSpecialNeedsPersonSupportProgramRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class SpecialNeedsPersonSupportProgramSearchController extends Controller  implements HasMiddleware
{
  use ResponseTrait;

  protected $searchService;

  public function __construct(SpecialNeedsPersonSupportProgramSearchService $searchService)
  {
    $this->searchService = $searchService;
  }

  public static function middleware()
  {
    return [
      new Middleware('can:تقرير دعم المرضى وذوي الاحتياجات', only: ['index', 'search']),
    ];
  }

  public function index()
  {
    $supportPrograms = SupportProgram::select('id', 'name')->get();
    return view('admins.reports.special_needs_people_support_programs.index', compact('supportPrograms'));
  }

  public function search(SearchSpecialNeedsPersonSupportProgramRequest $request)
  {
    // dd($request->all());
    $filters = array_filter($request->validated());
    if (empty($filters)) {
      return $this->errorResponse("الرجاء إدخال معيار بحث واحد على الأقل.", 422);
    }
    $data = $this->searchService->search($filters);
    return view(
      'admins.reports.special_needs_people_support_programs.partials.cases_support_program_table',
      [
        'results' => $data['results'],
        'filters' =>  $filters,
      ]
    );
  }
}
