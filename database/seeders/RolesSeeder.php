<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'مدير النظام',
            'مستخدم قسم الأيتام',
            'مستخدم قسم الأسر فى وضعية صعبة',
            'مستخدم قسم المرضى وذوى الاحتياجات',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name'       => $role],
                ['guard_name' => 'web']
            );
        }
    }
}