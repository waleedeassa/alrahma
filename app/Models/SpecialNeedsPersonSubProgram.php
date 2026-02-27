<?php

namespace App\Models;

use App\Models\SupportProgram;
use App\Models\SpecialNeedsPerson;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialNeedsPersonSubProgram extends Pivot
{
  use HasFactory;
  protected $table = 'special_needs_sub_programs';
  public $incrementing = true;

  protected $fillable = [
    'support_program_id',
    'special_needs_person_id',
    'date'
  ];
  public function person()
  {
    return $this->belongsTo(SpecialNeedsPerson::class, 'special_needs_person_id');
  }
  public function program()
  {
    return $this->belongsTo(SupportProgram::class, 'support_program_id');
  }
  // Scope search
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
