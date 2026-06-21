<?php

namespace App\Traits;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadManagerTrait
{
  private string $defaultDisk = 'uploads';

  // ────────────────────────────────────────────
  //  الصور البسيطة (صورة واحدة لكل model)
  // ────────────────────────────────────────────

  public function uploadSimpleImage(UploadedFile $file, string $directory, ?string $oldImagePath = null): string
  {
    if ($oldImagePath) {
      Storage::disk($this->defaultDisk)->delete($oldImagePath);
    }

    $fileName = $this->generateUniqueFileName($file);
    $newPath  = $directory . '/' . $fileName;

    Storage::disk($this->defaultDisk)->putFileAs($directory, $file, $fileName);

    return $newPath;
  }

  public function deleteSimpleImage(?string $imagePath): void
  {
    if ($imagePath) {
      Storage::disk($this->defaultDisk)->delete($imagePath);
    }
  }

  // ────────────────────────────────────────────
  //  المرفقات (attachments)
  // ────────────────────────────────────────────

  public function uploadAttachment(Model $model, UploadedFile $file, string $directory): Attachment
  {
    $fileName = $this->generateUniqueFileName($file);

    Storage::disk($this->defaultDisk)->putFileAs($directory, $file, $fileName);

    return $model->attachments()->create([
      'original_name' => $file->getClientOriginalName(),
      'file_name'     => $fileName,
      'path'          => $directory,
    ]);
  }

  public function uploadAttachments(Model $model, array $files, string $directory): void
  {
    foreach ($files as $file) {
      $this->uploadAttachment($model, $file, $directory);
    }
  }

  public function deleteAttachment(Attachment $attachment): void
  {
    Storage::disk($this->defaultDisk)->delete($attachment->full_path);
    $attachment->delete();
  }

  public function deleteAllAttachments(Model $model): void
  {
    $model->attachments->each(fn($attachment) => $this->deleteAttachment($attachment));
  }

  // ────────────────────────────────────────────
  //  helper
  // ────────────────────────────────────────────

  private function generateUniqueFileName(UploadedFile $file): string
  {
    return Str::uuid() . '.' . $file->getClientOriginalExtension();
  }
}