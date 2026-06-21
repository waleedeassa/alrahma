<?php

namespace Database\Seeders;

use Database\Seeders\GovernoratesAndCitiesSeeder;
use Database\Seeders\PermissionsAndRolesSeeder;
use Database\Seeders\SponsorsTableSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      PermissionsAndRolesSeeder::class,
      GovernoratesAndCitiesSeeder::class,
      UsersSeeder::class,
      SponsorsTableSeeder::class,
    ]);
  }
}
