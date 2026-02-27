<?php

namespace App\Services;

use App\Models\SpecialNeedsPersonSubProgram;

class SpecialNeedsPersonSupportProgramSearchService
{
  public function search(array $filters = []): array
  {
    $query = SpecialNeedsPersonSubProgram::query()->search($filters);
    $results = $query->with(['person', 'program'])
      ->latest()
      ->orderBy('date', 'desc')
      ->get();

    return ['results' => $results];
  }
}
