<?php

namespace App\Traits;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait UploadManagerTrait

{
  public function uploadFile($path, $file, $disk)
  {
    $fileName  = $this->generateFileName($file);
    $this->storeFile($file, $path, $fileName, $disk);
    return $fileName;
  }
  public function generateFileName($file)
  {
    return Str::uuid() . time() . '.' . $file->getClientOriginalExtension();
  }
  public function storeFile($file, $path, $fileName, $disk)
  {
    $file->storeAs($path, $fileName, ['disk' => $disk]);
  }
  public function deleteFile($filePath): void
  {
    if ($filePath && File::exists(public_path($filePath))) {
      File::delete(public_path($filePath));
    }
  }
  public function uploadMultipleFiles($files, $model, $disk)
  {
    foreach ($files as $file) {
      $fileName   = $this->generateFileName($file);
      $this->storeFile($file, '/', $fileName, $disk);
      $model->attachments()->create(['file' => $fileName]);
    }
  }
}
