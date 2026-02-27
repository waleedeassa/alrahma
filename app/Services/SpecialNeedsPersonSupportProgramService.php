<?php

namespace App\Services;

use App\Models\SpecialNeedsPerson;
use App\Models\SupportProgram;

class SpecialNeedsPersonSupportProgramService
{
  // Get eligible people data
  public function getEligiblePeopleData()
  {
    $people = SpecialNeedsPerson::select([
      'id',
      'first_name_ar',
      'last_name_ar',
      'national_id_no',
      'family_members_count',
      'special_needs_type',
    ])->get();

    return $people->map(function ($person) {
      return [
        'id' => $person->id,
        'full_name' => $person->first_name_ar . ' ' . $person->last_name_ar,
        'national_id' => $person->national_id_no,
        'members_count' => $person->family_members_count_for_display, 
        'type_text' => $person->special_needs_type_label, 
      ];
    });
  }

  // Assign people to program
  public function assignPeopleToProgram(array $data)
  {
    $program = SupportProgram::findOrFail($data['support_program_id']);
    $pivotData = [];
    $pivotData = [];
    foreach ($data['beneficiary_ids'] as $id) {
      $pivotData[$id] = ['date' => $data['date']];
    }
    $program->specialNeedsPeople()->attach($pivotData);
    return true;
  }
}
