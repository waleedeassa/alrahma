<?php

namespace App\Models;

use App\Models\SupportProgram;
use App\Models\DifficultCaseFamily;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DifficultCasesSubProgram extends Pivot
{
  use HasFactory;
  protected $table = 'difficult_cases_sub_programs';
  public $incrementing = true;

  protected $fillable = [
    'support_program_id',
    'difficult_case_family_id',
    'date'
  ];

  // --------------------------------------------------------------------
  // RELATIONSHIPS
  // --------------------------------------------------------------------
  public function family()
  {
    return $this->belongsTo(DifficultCaseFamily::class, 'difficult_case_family_id');
  }
  public function program()
  {
    return $this->belongsTo(SupportProgram::class, 'support_program_id');
  }
  // --------------------------------------------------------------------
  // SCOPES
  // --------------------------------------------------------------------
  public function scopeSearch($query, $filters)
  {
    $query
      ->when(isset($filters['support_program_id']), function ($query) use ($filters) {
        return $query->where('support_program_id', $filters['support_program_id']);
      })
      ->when(isset($filters['from_date']), function ($query) use ($filters) {
        return $query->whereDate('date', '>=', $filters['from_date']);
      })
      ->when(isset($filters['to_date']), function ($query) use ($filters) {
        return $query->whereDate('date', '<=', $filters['to_date']);
      });
    return $query;
  }
}
