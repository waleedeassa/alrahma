<?php

namespace App\Services;

use App\Models\SupportProgram;
use App\Models\DifficultCaseFamily;

class DifficultCaseSupportProgramService
{
  // get eligible families data
  public function getEligibleFamiliesData()
  {
    $families = DifficultCaseFamily::select([
      'id',
      'first_name_ar',
      'last_name_ar',
      'national_id_no',
      'family_members_count',
      'difficult_case_type'
    ])->get();

    return $families->map(function ($family) {
      return [
        'id' => $family->id,
        'full_name' => $family->first_name_ar . ' ' . $family->last_name_ar,
        'national_id' => $family->national_id_no,
        'members_count' => $family->family_members_count_for_display, 
        'type_text' => $family->difficult_case_type_label, 
      ];
    });
  }
  // assign families to program
  public function assignFamiliesToProgram(array $data)
  {
    $program = SupportProgram::findOrFail($data['support_program_id']);
    $pivotData = [];
    foreach ($data['family_ids'] as $id) {
      $pivotData[$id] = ['date' => $data['date']];
    }
    $program->difficultCaseFamilies()->attach($pivotData);
    return true;
  }
}
