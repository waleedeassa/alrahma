<?php

namespace App\Services;

use App\Models\DifficultCaseFamily;
use App\Models\DifficultCasesSubProgram;


class DifficultCasesSupportProgramSearchService

{
  public function search(array $filters = []): array
  {
    $query =  DifficultCasesSubProgram::query()->search($filters);
    $results = $query->with(['family', 'program'])
      ->orderBy('date', 'desc')
      ->get();
    return ['results' => $results];
  }
}
