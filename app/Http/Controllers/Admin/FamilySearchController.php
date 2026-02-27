<?php

namespace App\Http\Controllers\Admin;

use App\Models\Family;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\FamiliesSearchService;
use App\Http\Requests\Admin\FamilySearchRequest;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

// class FamilySearchController extends Controller implements HasMiddleware
class FamilySearchController extends Controller
{
  use ResponseTrait;

  protected $searchService;
  public function __construct(FamiliesSearchService $searchService)
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
    return view('admins.reports.families.index', compact('governorates'));
  }

  public function search(FamilySearchRequest  $request)
  {
    $filters = array_filter($request->validated());
    if (empty($filters)) {
      return $this->errorResponse("الرجاء إدخال معيار بحث واحد على الأقل.", 422);
    }
    $data = $this->searchService->search($filters);
    return view(
      'admins.reports.families.partials.families_table',
      [
        ...$data,
        'filters' => $filters,
      ]
    )->render();
  }
}
