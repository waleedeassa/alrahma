<?php

namespace Database\Seeders;

use App\Models\DifficultCaseFamily;
use App\Models\User;
use Database\Seeders\GovernoratesAndCitiesSeeder;
use Database\Seeders\SponsorsTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    // User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    // $this->call([
    //   GovernoratesAndCitiesSeeder::class,
    // ]);

    $this->call(SponsorsTableSeeder::class);

    // DifficultCaseFamily::factory()->count(3500)->create();
  }
}
