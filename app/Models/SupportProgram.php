<?php

namespace App\Models;

use App\Models\SupportProgramEntry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportProgram extends Model
{
  use HasFactory;

  protected $table = 'support_programs';
  protected $fillable = ['name'];

  public function entries()
  {
    return $this->hasMany(SupportProgramEntry::class, 'support_program_id');
  }
}
