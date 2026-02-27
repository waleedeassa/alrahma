<?php

namespace App\Traits;

use App\Models\Attachment;
use Illuminate\Support\Str;
use App\Jobs\UploadToGoogleDrive;
use Illuminate\Http\UploadedFile;
use App\Jobs\DeleteFromGoogleDrive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

trait UploadManagerTrait
{
  private string $defaultDisk = 'uploads';
      public function uploadSimpleImage(UploadedFile $file, string $directory, ?string $oldImagePath = null): string
    {
        // 1. التعامل مع الصورة القديمة (الحذف)
        if ($oldImagePath) {
            // توحيد الفواصل لضمان أن المسار يعمل بشكل صحيح مع جوجل درايف والسيرفر المحلي
            $normalizedPath = str_replace('\\', '/', $oldImagePath);

            // أ) الحذف من السيرفر المحلي
            if (Storage::disk($this->defaultDisk)->exists($normalizedPath)) {
                Storage::disk($this->defaultDisk)->delete($normalizedPath);
            }

            // ب) الحذف من جوجل درايف (هذا هو السطر الذي كان ينقصك)
            // نرسل الأمر للجوب ليقوم بالحذف في الخلفية
            DeleteFromGoogleDrive::dispatch($normalizedPath, 'google_attachments');
        }

        // 2. رفع الصورة الجديدة
        $fileName = $this->generateUniqueFileName($file);
        $newPath = $directory . '/' . $fileName;

        try {
            // الحفظ محلياً
            Storage::disk($this->defaultDisk)->putFileAs($directory, $file, $fileName);
            
            // الرفع لجوجل درايف
            UploadToGoogleDrive::dispatch(
                $newPath,               
                $this->defaultDisk,     
                'google_attachments'    
            );
        } catch (\Exception $e) {
            throw $e;
        }
        
        return $newPath;
    }
  public function deleteSimpleImage(?string $imagePath): void
  {
    if ($imagePath) {
      Storage::disk($this->defaultDisk)->delete($imagePath);
      DeleteFromGoogleDrive::dispatch($imagePath, 'google_attachments');
    }
  }
  // with google drive 
  public function uploadAttachment(Model $model, UploadedFile $file, string $directory): Attachment
  {
    $fileName = $this->generateUniqueFileName($file);
    $fullPath = $directory . '/' . $fileName;
    try {
      Storage::disk($this->defaultDisk)->putFileAs($directory, $file, $fileName);
      // Storage::disk('google_attachments')->putFileAs($directory, $file, $fileName);
      UploadToGoogleDrive::dispatch(
        $fullPath,               // المسار الكامل 'families/1/xyz.pdf'
        $this->defaultDisk,      // القرص المحلي 'uploads'
        'google_attachments'     // القرص السحابي الذي نريد الرفع إليه
      );
    } catch (\Exception $e) {
      throw $e;
    }
    return $model->attachments()->create([
      'original_name' => $file->getClientOriginalName(),
      'file_name'     => $fileName,
      'path'          => $directory,
    ]);
  }
  // without google drive
  // public function uploadAttachment(Model $model, UploadedFile $file, string $directory): Attachment
  // {
  //   $fileName = $this->generateUniqueFileName($file);
  //   Storage::disk($this->defaultDisk)->putFileAs($directory, $file, $fileName);
  //   return $model->attachments()->create([
  //     'original_name' => $file->getClientOriginalName(),
  //     'file_name'     => $fileName,
  //     'path'          => $directory,
  //   ]);
  // }
  public function uploadAttachments(Model $model, array $files, string $directory): void
  {
    foreach ($files as $file) {
      $this->uploadAttachment($model, $file, $directory);
    }
  }
  public function deleteAttachment(Attachment $attachment): void
  {
    if (Storage::disk($this->defaultDisk)->exists($attachment->full_path)) {
      Storage::disk($this->defaultDisk)->delete($attachment->full_path);
    }
    DeleteFromGoogleDrive::dispatch($attachment->full_path, 'google_attachments');
    $attachment->delete();
  }
  public function deleteAllAttachments(Model $model): void
  {
    $model->attachments()->get()->each(function ($attachment) {
      $this->deleteAttachment($attachment);
    });
  }
  private function generateUniqueFileName(UploadedFile $file): string
  {
    return Str::uuid() . '.' . $file->getClientOriginalExtension();
  }
}
