<?php

namespace App\Http\Controllers\Admin;

use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\SpecialNeedsPeopleSearchService;
use App\Http\Requests\Admin\SpecialNeedsPeopleSearchRequest;

class SpecialNeedsPersonSearchController extends Controller
{
  use ResponseTrait;

  protected $searchService;

  public function __construct(SpecialNeedsPeopleSearchService $searchService)
  {
    $this->searchService = $searchService;
  }

  // public static function middleware()
  // {
  //     return [
  //         new Middleware('can:manage_special_needs_report', only: ['index', 'search']),
  //     ];
  // }

  public function index()
  {
    $governorates = Governorate::select('id', 'name')->pluck('name', 'id')->toArray();
    return view('admins.reports.special_needs_people.index', compact('governorates'));
  }

  public function search(SpecialNeedsPeopleSearchRequest $request)
  {
    $filters = array_filter($request->validated());
    if (empty($filters)) {
      return $this->errorResponse("الرجاء إدخال معيار بحث واحد على الأقل.", 422);
    }
    $data = $this->searchService->search($filters);
    return view(
      'admins.reports.special_needs_people.partials.cases_table',
      [
        ...$data,
        'filters' => $filters,
      ]
    )->render();
  }
}
