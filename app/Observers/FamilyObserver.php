<?php

namespace App\Observers;

use App\Models\Family;
use Illuminate\Support\Facades\Auth;

class FamilyObserver
{
  public function creating(Family $family)
  {
    if (Auth::check()) {
      $family->added_by = Auth::id();
    }
  }
  public function updating(Family $family)
  {
    if (Auth::check()) {
      $family->updated_by = Auth::id();
    }
  }
}
