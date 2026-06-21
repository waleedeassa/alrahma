<?php

namespace App\Models;

use App\Models\Attachment;
use App\Models\SupportProgram;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportProgramEntry extends Model
{
  use HasFactory;

  protected $table = 'support_program_entries';

  protected $fillable = [
    'support_program_id',
    'beneficiary_category',
    'beneficiaries_count',
    'funding_source',
    'date',
    'notes',
  ];

  protected $casts = [
    'date' => 'date',
    'beneficiaries_count' => 'integer',
  ];

  public function program()
  {
    return $this->belongsTo(SupportProgram::class, 'support_program_id');
  }

  public function attachments()
  {
    return $this->morphMany(Attachment::class, 'attachmentable');
  }

  // get the label for the beneficiary category
  public function getCategoryLabelAttribute()
  {
    return config('options.support_beneficiary_categories')[$this->beneficiary_category] ?? $this->beneficiary_category;
  }
}
