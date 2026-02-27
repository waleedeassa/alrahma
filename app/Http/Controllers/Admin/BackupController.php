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
    // return [
    //   new Middleware('can:manage_backups', only: ['index']),
    // ];
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
      ->with(['message' => 'تم انشاء نسخة احتياطية جديدة بنجاح', 'type' => 'success']);
  }
  public function destroy($backupName)
  {
    Storage::delete('backups/' . $backupName);
    return redirect()->route('admin.backups.index')
      ->with(['message' => 'تم حذف النسخة الاحتياطية بنجاح', 'type' => 'success']);
  }
  public function bulkDestroy(Request $request)
  {
    $backups = $request->input('backups', []);
    foreach ($backups as $backupName) {
      Storage::delete('backups/' . $backupName);
    }
    return redirect()->route('admin.backups.index')
      ->with(['message' => 'تم حذف النسخ الاحتياطية المحددة بنجاح', 'type' => 'success']);
  }
}
