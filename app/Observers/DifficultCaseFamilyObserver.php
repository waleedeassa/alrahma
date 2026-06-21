<?php

namespace App\Observers;

use App\Models\DifficultCaseFamily;

class DifficultCaseFamilyObserver
{
  public function updating(DifficultCaseFamily $difficultCaseFamily)
  {
    // check if old value is 2 and new value is not 2
    $oldType = $difficultCaseFamily->getOriginal('difficult_case_type');
    $newType = $difficultCaseFamily->difficult_case_type;

    if ($oldType == 2 && $newType != 2) {
      $this->clearAbuseFields($difficultCaseFamily);
    }
  }

  private function clearAbuseFields(DifficultCaseFamily $difficultCaseFamily): void
  {
    $difficultCaseFamily->aggressor_gender = null;
    $difficultCaseFamily->aggressor_relationship = null;
    $difficultCaseFamily->aggressor_education_level = null;
    $difficultCaseFamily->aggressor_family_status = null;
    $difficultCaseFamily->aggressor_kinship = null;
    $difficultCaseFamily->violence_type = null;
    $difficultCaseFamily->violence_place = null;
    $difficultCaseFamily->violence_time = null;
    $difficultCaseFamily->violence_frequency = null;
    $difficultCaseFamily->external_interventions = null;
  }
}