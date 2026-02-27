<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\SupportProgram;
use App\Models\DifficultCaseFamily;
use App\Http\Controllers\Controller;
use App\Models\DifficultCasesSubProgram;
use App\Services\DifficultCaseSupportProgramService;
use App\Http\Requests\Admin\DifficultCaseSupportProgramRequest;

class DifficultCaseSupportProgramController extends Controller
{
  use ResponseTrait;

  protected $service;
  public function __construct(DifficultCaseSupportProgramService $service)
  {
    $this->service = $service;
  }
  public function create()
  {
    $programs = SupportProgram::all();
    return view('admins.difficult_case_support_programs.create', compact('programs'));
  }
  public function getEligibleFamilies()
  {
    $data = $this->service->getEligibleFamiliesData();
    return response()->json($data);
  }
  public function store(DifficultCaseSupportProgramRequest $request)
  {
    try {
      $this->service->assignFamiliesToProgram($request->validated());
      return response()->json(['status' => 'success', 'message' => 'تم إضافة الدعم للأسر المحددة بنجاح']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
  }
  public function getFamilyHistory($family_id)
  {
    $family = DifficultCaseFamily::with('supportPrograms')->findOrFail($family_id);
    $history = $family->supportPrograms->map(function ($program) {
      return [
        'pivot_id' => $program->pivot->id, 
        'program_name' => $program->name,
        'date' => $program->pivot->date,
      ];
    });
    return response()->json($history);
  }
  public function destroy($id)
  {
    try {
      $record = DifficultCasesSubProgram::findOrFail($id);
      $record->delete();
      return response()->json(['status' => 'success', 'message' => 'تم حذف سجل الدعم بنجاح']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => 'حدث خطأ أثناء الحذف'], 500);
    }
  }
}
