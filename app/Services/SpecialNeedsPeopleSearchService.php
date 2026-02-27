<?php

namespace App\Services;

use App\Models\SpecialNeedsPerson;

class SpecialNeedsPeopleSearchService
{
  public function search(array $filters = []): array
  {
    $query = SpecialNeedsPerson::query()->search($filters);
    $cases = $query->with('governorate:id,name', 'city:id,name')->latest()->get();

    return ['cases' => $cases];
  }
}
