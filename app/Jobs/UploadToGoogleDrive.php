<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // سنضيف Log لتتبع الأخطاء بسهولة

class UploadToGoogleDrive implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected string $fullPath;
  protected string $localDisk;
  protected string $cloudDisk;

  /**
   * Create a new job instance.
   *
   * @param string $fullPath  المسار الكامل للملف (e.g., 'families/1/abc.pdf')
   * @param string $localDisk القرص المحلي الذي يوجد عليه الملف (e.g., 'uploads')
   * @param string $cloudDisk القرص السحابي الذي سنرفع إليه (e.g., 'google_attachments')
   */
  public function __construct(string $fullPath, string $localDisk, string $cloudDisk)
  {
    $this->fullPath = $fullPath;
    $this->localDisk = $localDisk;
    $this->cloudDisk = $cloudDisk;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    // تحقق أولاً من وجود الملف على القرص المحلي
    if (Storage::disk($this->localDisk)->exists($this->fullPath)) {
      try {
        // اقرأ محتوى الملف
        $fileContents = Storage::disk($this->localDisk)->get($this->fullPath);

        // ارفع المحتوى إلى القرص السحابي
        Storage::disk($this->cloudDisk)->put($this->fullPath, $fileContents);

        // اختياري: يمكنك حذف الملف المحلي بعد رفعه بنجاح لتوفير المساحة
        // إذا قررت تفعيل هذا، تأكد من أنك لا تحتاج للملف المحلي لأي سبب آخر
        // Storage::disk($this->localDisk)->delete($this->fullPath);

      } catch (\Exception $e) {
        // في حال فشل الرفع، قم بتسجيل الخطأ في ملفات الـ log
        Log::error('Failed to upload to Google Drive: ' . $e->getMessage(), [
          'file_path' => $this->fullPath,
        ]);
        // سيقوم Laravel تلقائيًا بإعادة محاولة المهمة أو نقلها إلى failed_jobs
        // بناءً على إعدادات الـ job
        throw $e;
      }
    } else {
      // إذا لم يتم العثور على الملف المحلي، قم بتسجيل ذلك كتحذير
      Log::warning('Local file not found for Google Drive upload', [
        'file_path' => $this->fullPath,
      ]);
    }
  }
}
