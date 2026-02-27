<?php

namespace App\Http\Controllers\Admin;

use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\DifficultCaseFamily;
use App\Http\Controllers\Controller;
use App\Services\DifficultCaseFamiliesSearchService;
use App\Http\Requests\Admin\DifficultCaseFamilySearchRequest;

class DifficultCaseFamilySearchController extends Controller
{
  use ResponseTrait;

  protected $searchService;
  public function __construct(DifficultCaseFamiliesSearchService $searchService)
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
    $governorates = Governorate::select('id', 'name')->pluck('name', 'id')->toArray();
    return view('admins.reports.difficult_case_families.index', compact('governorates'));
  }

  public function search(DifficultCaseFamilySearchRequest $request)
  {
    // dd($request->all());
    $filters = array_filter($request->validated());
    if (empty($filters)) {
      return $this->errorResponse("الرجاء إدخال معيار بحث واحد على الأقل.", 422);
    }
    $data = $this->searchService->search($filters);
    return view(
      'admins.reports.difficult_case_families.partials.cases_table',
      [
        ...$data,
        'filters' => $filters,
      ]
    )->render();
  }
}
