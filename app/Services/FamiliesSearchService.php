<?php

namespace App\Services;

use App\Models\Family;

class FamiliesSearchService
{
  public function search(array $filters = []): array
  {
    $query =  Family::query()->search($filters);
    $families = $query->with('governorate:id,name', 'city:id,name')->latest()->get();
    return ['families' => $families];
  }
}
