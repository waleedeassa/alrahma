<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernoratesAndCitiesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Truncate tables
    Schema::disableForeignKeyConstraints();
    City::truncate();
    Governorate::truncate();
    Schema::enableForeignKeyConstraints();

    DB::transaction(function () {
      $data = [
        [
          'governorate' => 'إقليم الناظور',
          'cities' => [
            'مدينة الناظور',
            'مدينة العروي',
            'مدينة بني انصار',
            'مدينة زايو',
            'مدينة أزغنغان',
            'مدينة رأس الماء',
            'جماعة سلوان',
            'جماعة أفسو',
            'جماعة بني شيكر',
            'جماعة إيحدادن',
            'جماعة فرخانة',
            'جماعة البركانيين',
            'جماعة ايعزانن',
            'جماعة أركمان',
            'جماعة أولاد ستوت',
            'جماعة إيكسان',
            'جماعة اولاد داوود الزخانين',
            'جماعة بني بويفرور',
            'جماعة بني سيدال لوطا',
            'جماعة بني سيدال الجبل',
            'جماعة بني وكيل أولاد امحند',
            'جماعة تزطوطين',
            'جماعة بوعرك',
            'جماعة حاسي بركان'
          ]
        ],
        [
          'governorate' => 'إقليم فجيج',
          'cities' => [
            'جماعة فجيج',
            'جماعة بوعرفة',
            'جماعة تندرارة',
            'بني تدجيت',
            'عين الشواطر',
            'بوشاون',
            'بني كيل',
            'بوعنان',
            'تالسينت',
            'عبو لكحل',
            'عين الشعير',
            'بومريم',
            'معتركة'
          ]
        ],
        [
          'governorate' => 'إقليم كرسيف',
          'cities' => [
            'جماعة كرسيف',
            'جماعة صاكا',
            'جماعة بركين',
            'جماعة هوارة أولاد رحو',
            'جماعة لمريجة'
          ]
        ],
        [
          'governorate' => 'إقليم الحسيمة',
          'cities' => [
            'الحسيمة',
            'إمزورن',
            'بني بوعياش',
            'تارجيست',
            'أجدير',
            'دائرة بني بوفراح',
            'دائرة تارجيست',
            'دائرة كتامة',
            'دائرة بني أورياغل الغربية',
            'دائرة بني أورياغل الشرقية'
          ]
        ],
        [
          'governorate' => 'إقليم الدريوش',
          'cities' => [
            'مدينة الدريوش',
            'جماعة بن الطيب',
            'جماعة أولاد بوبكر',
            'جماعة عين الزهرة',
            'جماعة دار الكبداني',
            'جماعة تازاغين',
            'جماعة أمجاو',
            'جماعة آيت مايت',
            'جماعة أمطالسة',
            'ميضار',
            'بودينار',
            'آيت مايت',
            'تليليت',
            'وردانة',
            'أولاد أمغار',
            'أمهاجر',
            'تمسمان',
            'تازاغين',
            'تفرسيت',
            'إجرماواس',
            'مركز كاسيطا',
            'مركز كرونة',
            'مركز تفرسيت'
          ]
        ],
        [
          'governorate' => 'إقليم تاوريرت',
          'cities' => [
            'تاوريرت',
            'العيون سيدي ملوك',
            'دبدو'
          ]
        ],
        [
          'governorate' => 'اقليم وجدة',
          'cities' => [
            'مدينة وجدة',
            'بني درار',
            'نعيمة',
            'أهل أنكاد',
            'عين صفا',
            'بني خالد',
            'لبصارة',
            'إسلي',
            'مستفركي',
            'سيدي بولنوار',
            'سيدي موسى لمهاية'
          ]
        ],
        [
          'governorate' => 'إقليم بركان',
          'cities' => [
            'مدينة بركان',
            'عين الركادة',
            'مداغ',
            'تافوغالت',
            'السعيدية',
            'أكليم',
            'أغبال',
            'فزوان',
            'أحفير',
            'سيدي سليمان الشراعة',
            'العثامنة'
          ]
        ],
      ];

      foreach ($data as $item) {
        $governorate = Governorate::firstOrCreate(['name' => $item['governorate']]);
        if (!empty($item['cities']) && is_array($item['cities'])) {
          foreach ($item['cities'] as $cityName) {
            City::firstOrCreate([
              'name' => $cityName,
              'governorate_id' => $governorate->id
            ]);
          }
        }
      }
    });

    $this->command->info('Governorates and cities seeded successfully.');
  }
}
