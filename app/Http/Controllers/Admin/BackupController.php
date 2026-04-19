<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BackupController extends Controller implements HasMiddleware
{
  public static function middleware()
  {
    return [
      new Middleware('can:إدارة النسخ الإحتياطية', only: ['index']),
      new Middleware('can:تحميل نسخة إحتياطية', only: ['downloadBackup']),
      new Middleware('can:إضافة نسخة إحتياطية', only: ['createBackup']),
      new Middleware('can:حذف نسخة إحتياطية', only: ['destroy', 'bulkDestroy']),
    ];
  }
  public function index()
  {
    $files = File::allFiles(storage_path('/app/backups'));
    usort($files, function ($a, $b) {
      return $b->getCTime() - $a->getCTime();
    });
    return view('admins.backups.index')->with('backups', $files);
  }
  public function downloadBackup($backupName)
  {
    $path = storage_path('app/backups/' . $backupName);
    return response()->download($path);
  }
  public function createBackup()
  {
    Artisan::call('backup:run --only-db --disable-notifications');
    return redirect()->route('admin.backups.index')
      ->with(['message' => 'تم انشاء نسخة إحتياطية جديدة بنجاح', 'type' => 'success']);
  }
  public function destroy($backupName)
  {
    Storage::delete('backups/' . $backupName);
    return redirect()->route('admin.backups.index')
      ->with(['message' => 'تم حذف النسخة الإحتياطية بنجاح', 'type' => 'success']);
  }
  public function bulkDestroy(Request $request)
  {
    $backups = $request->input('backups', []);
    foreach ($backups as $backupName) {
      Storage::delete('backups/' . $backupName);
    }
    return redirect()->route('admin.backups.index')
      ->with(['message' => 'تم حذف النسخ الإحتياطية المحددة بنجاح', 'type' => 'success']);
  }
}
