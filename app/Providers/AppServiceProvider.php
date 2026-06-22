<?php

namespace App\Providers;

use App\Models\DifficultCaseFamily;
use App\Models\Family;
use App\Models\FamilyReport;
use App\Observers\DifficultCaseFamilyObserver;
use App\Observers\FamilyObserver;
use App\Observers\FamilyReportObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
  public function register(): void {}

  public function boot(): void
  {
    // Rate Limiting for Login Requests for admin and sponsor
    RateLimiter::for('login', function (Request $request) {
      return Limit::perMinute(3)->by($request->ip());
    });

    Paginator::useBootstrap();
    Schema::defaultStringLength(191);

    Family::observe(FamilyObserver::class);
    FamilyReport::observe(FamilyReportObserver::class);
    DifficultCaseFamily::observe(DifficultCaseFamilyObserver::class);

    try {
      \Storage::extend('google', function ($app, $config) {
        $options = [];

        if (!empty($config['teamDriveId'] ?? null)) {
          $options['teamDriveId'] = $config['teamDriveId'];
        }

        if (!empty($config['sharedFolderId'] ?? null)) {
          $options['sharedFolderId'] = $config['sharedFolderId'];
        }

        $client = new \Google\Client();
        $client->setClientId($config['clientId']);
        $client->setClientSecret($config['clientSecret']);
        $client->refreshToken($config['refreshToken']);

        $service = new \Google\Service\Drive($client);
        $adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
        $driver = new \League\Flysystem\Filesystem($adapter);

        return new \Illuminate\Filesystem\FilesystemAdapter($driver, $adapter);
      });
    } catch (\Exception $e) {
      // your exception handling logic
    }
  }
}
