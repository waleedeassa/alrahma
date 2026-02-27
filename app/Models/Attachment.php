<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
  use HasFactory;

  protected $table = 'attachments';
  protected $fillable = ['original_name', 'file_name', 'attachmentable_id', 'attachmentable_type', 'path'];

  public function attachmentable()
  {
    return $this->morphTo();
  }

  protected function fullPath(): Attribute
  {
    return Attribute::make(
      get: fn() => $this->path . '/' . $this->file_name,
    );
  }
}
