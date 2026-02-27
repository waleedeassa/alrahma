<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SponsorsTableSeeder extends Seeder
{
  public function run(): void
  {
    $password = Hash::make('12345678');

    $sponsors = [
      [
        'name'     => 'الإغاثة الإسلامية هولندا',
        'type'     => 1, // مؤسسة
        'email'    => 'sponsor@gmail.com',
        'phone'    => '0123456789',
        'address'  => 'هولندا - أمستردام',
        'status'   => true,
        'password' => $password,
      ],
      [
        'name'     => 'كرامة التضامن',
        'type'     => 1, // مؤسسة
        'email'    => 'karama@gmail.com',
        'phone'    => '0611223344',
        'address'  => 'المغرب - الرباط',
        'status'   => true,
        'password' => $password,
      ],
      [
        'name'     => 'شخص ذاتي',
        'type'     => 2, // فرد
        'email'    => 'self@gmail.com',
        'phone'    => '0655667788',
        'address'  => 'المغرب - الدار البيضاء',
        'status'   => true,
        'password' => $password,
      ],
    ];

    foreach ($sponsors as $sponsor) {
      Sponsor::updateOrCreate(
        ['email' => $sponsor['email']], 
        $sponsor
      );
    }
  }
}
