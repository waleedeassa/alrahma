<?php

namespace Database\Factories;

use App\Models\DifficultCaseFamily;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DifficultCaseFamilyFactory extends Factory
{
    protected $model = DifficultCaseFamily::class;

    public function definition(): array
    {
        $maleNames = [
            ['محمد', 'Mohammed'], ['أحمد', 'Ahmed'], ['يوسف', 'Youssef'],
            ['عمر', 'Omar'], ['حمزة', 'Hamza'], ['إلياس', 'Ilyas'],
            ['سعيد', 'Said'], ['رشيد', 'Rachid'], ['خالد', 'Khalid'],
            ['عبد الله', 'Abdellah'], ['حسن', 'Hassan'], ['أمين', 'Amine']
        ];

        $femaleNames = [
            ['فاطمة', 'Fatima'], ['خديجة', 'Khadija'], ['مريم', 'Mariam'],
            ['عائشة', 'Aicha'], ['زينب', 'Zineb'], ['سميرة', 'Samira'],
            ['لطيفة', 'Latifa'], ['حنان', 'Hanane'], ['نادية', 'Nadia'],
            ['سلمى', 'Salma'], ['هدى', 'Houda'], ['سعاد', 'Souad']
        ];

        $lastNames = [
            ['العلوي', 'Alaoui'], ['بناني', 'Bennani'], ['الفاسي', 'Fassi'],
            ['التازي', 'Tazi'], ['العلمي', 'Alami'], ['الناصري', 'Naciri'],
            ['الإدريسي', 'Idrissi'], ['الراجي', 'Raji'], ['بنسودة', 'Bensouda'],
            ['الداودي', 'Daoudi'], ['المنصوري', 'El Mansouri'], ['الرحماني', 'Rahmani']
        ];

        $gender = $this->faker->randomElement([1, 2]);

        if ($gender == 1) {
            $selectedName = $maleNames[array_rand($maleNames)];
        } else {
            $selectedName = $femaleNames[array_rand($femaleNames)];
        }

        $selectedLastName = $lastNames[array_rand($lastNames)];

        $nationalId = strtoupper(Str::random(2)) . $this->faker->numerify('########');

        return [
            'registration_date' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'first_name_ar' => $selectedName[0],
            'first_name_fr' => $selectedName[1],
            'last_name_ar' => $selectedLastName[0],
            'last_name_fr' => $selectedLastName[1],
            'national_id_no' => $nationalId,
            'gender' => $gender,
            'birth_date' => $this->faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
            'education_level' => $this->faker->numberBetween(1, 6),
            'family_members_count' => $this->faker->numberBetween(1, 11),
            'difficult_case_type' => $this->faker->numberBetween(1, 6),
            'social_status' => $this->faker->numberBetween(1, 5),
            'governorate_id' => $this->faker->numberBetween(1, 8),
            'city_id' => $this->faker->numberBetween(1, 5),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'added_by' => User::first()->id ?? User::factory(),
            'updated_by' => null,
        ];
    }
}