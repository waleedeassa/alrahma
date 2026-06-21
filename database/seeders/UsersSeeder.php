<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
  public function run(): void
  {
    $users = [
      [
        'id' => 1,
        'name' => 'admin',
        'family_name' => 'الإدارة',
        'email' => 'admin@gmail.com',
        'status' => 1,
        'email_verified_at' => null,
        'photo' => null,
        'phone' => '0123456789',
        'password' => Hash::make('12345678'),
        'remember_token' => null,
      ],
      [
        'id' => 2,
        'name' => 'user',
        'family_name' => 'عبدالله',
        'email' => 'user1@gmail.com',
        'status' => 1,
        'email_verified_at' => null,
        'photo' => null,
        'phone' => '0123456789',
        'password' => Hash::make('12345678'),
        'remember_token' => null,
      ],
      [
        'id' => 3,
        'name' => 'user2',
        'family_name' => 'محمد',
        'email' => 'user2@gmail.com',
        'status' => 1,
        'email_verified_at' => null,
        'photo' => null,
        'phone' => '0123456789',
        'password' => Hash::make('12345678'),
        'remember_token' => null,
      ],
      [
        'id' => 4,
        'name' => 'user3',
        'family_name' => 'أحمد',
        'email' => 'user3@gmail.com',
        'status' => 1,
        'email_verified_at' => null,
        'photo' => null,
        'phone' => '0123456789',
        'password' => Hash::make('12345678'),
        'remember_token' => null,
      ],
    ];

    foreach ($users as $userData) {
      User::updateOrCreate(
        ['email' => $userData['email']],
        $userData
      );
    }
  }
}
