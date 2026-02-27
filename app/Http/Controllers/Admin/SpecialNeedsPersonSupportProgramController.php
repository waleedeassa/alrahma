<?php

namespace App\Http\Controllers\Admin;

use App\Models\SupportProgram;
use App\Traits\ResponseTrait; 
use App\Models\SpecialNeedsPerson;
use App\Http\Controllers\Controller;
use App\Models\SpecialNeedsPeopleSubProgram;
use App\Models\SpecialNeedsPersonSubProgram;
use App\Services\SpecialNeedsPersonSupportProgramService;
use App\Http\Requests\Admin\SpecialNeedsPersonSupportProgramRequest;

class SpecialNeedsPersonSupportProgramController extends Controller
{
  use ResponseTrait;
  protected $service;
  public function __construct(SpecialNeedsPersonSupportProgramService $service)
  {
    $this->service = $service;
  }
  public function create()
  {
    $programs = SupportProgram::all();
    return view('admins.special_needs_people_support_programs.create', compact('programs'));
  }
  public function getEligibleFamilies()
  {
    $data = $this->service->getEligiblePeopleData();
    return response()->json($data);
  }
  public function store(SpecialNeedsPersonSupportProgramRequest $request)
  {
    try {
      $this->service->assignPeopleToProgram($request->all());
      return response()->json(['status' => 'success', 'message' => 'تم إضافة الدعم للمستفيدين المحدد بنجاح']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
  }
  public function getFamilyHistory($person_id)
  {
    // $person_id here represents the SpecialNeedsPerson id
    $person = SpecialNeedsPerson::with('supportPrograms')->findOrFail($person_id);
    $history = $person->supportPrograms->map(function ($program) {
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
    // dd($id);
    try {
      $record = SpecialNeedsPersonSubProgram::findOrFail($id);
      $record->delete();
      return response()->json(['status' => 'success', 'message' => 'تم حذف سجل الدعم بنجاح']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => 'حدث خطأ أثناء الحذف'], 500);
    }
  }
}
