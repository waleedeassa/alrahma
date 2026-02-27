<?php

namespace App\Services;

use App\Models\DifficultCaseFamily;


class DifficultCaseFamiliesSearchService

{
  public function search(array $filters = []): array
  {
    $query =  DifficultCaseFamily::query()->search($filters);
    $cases = $query->with('governorate:id,name', 'city:id,name')->latest()->get();
    return ['cases' => $cases];
  }
}
