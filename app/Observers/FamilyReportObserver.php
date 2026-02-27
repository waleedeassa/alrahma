<?php

namespace App\Observers;

use App\Models\FamilyReport;
use Illuminate\Support\Facades\Auth;

class FamilyReportObserver
{
  public function creating(FamilyReport $familyreport)
  {
    if (Auth::check()) {
      $familyreport->added_by = Auth::id();
    }
  }
}
