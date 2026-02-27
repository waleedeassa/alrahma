<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

// class DeleteFromGoogleDrive implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     protected $fullPath;

//     /**
//      * Create a new job instance.
//      *
//      * @return void
//      */
//     public function __construct(string $fullPath)
//     {
//         $this->fullPath = $fullPath;
//     }

//     /**
//      * Execute the job.
//      *
//      * @return void
//      */
//     public function handle()
//     {
//         try {
//             if (Storage::disk('google_attachments')->exists($this->fullPath)) {
//                 Storage::disk('google_attachments')->delete($this->fullPath);
//                 Log::info("Successfully deleted from Google Drive: {$this->fullPath}");
//             } else {
//                 Log::warning("File not found on Google Drive for deletion: {$this->fullPath}");
//             }
//         } catch (\Exception $e) {
//             Log::error("Failed to delete from Google Drive: {$this->fullPath} - Error: {$e->getMessage()}");
//         }
//     }
// }

class DeleteFromGoogleDrive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $path;
    protected string $cloudDisk;

    public function __construct(string $path, string $cloudDisk = 'google_attachments')
    {
        $this->path = $path;
        $this->cloudDisk = $cloudDisk;
    }

    public function handle()
    {
        try {
            if (Storage::disk($this->cloudDisk)->exists($this->path)) {
                Storage::disk($this->cloudDisk)->delete($this->path);
            }
        } catch (\Exception $e) {
            \Log::error('فشل الحذف من جوجل درايف: ' . $e->getMessage());
        }
    }
}