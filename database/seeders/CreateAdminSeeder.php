<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::create([
            'email' => 'vvan@itmo.ru',
            'name' => 'Владислав',
            'last_name' => 'Ан',
            'patronymic' => 'Вадимович',
            'department' => 'УФБ',
            'isu_number' => '323164',
            'phone_number' => '8-938-452-88-03',
            'password' => Hash::make('123456789'),
            'email_verified_at' => now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::create([
            'name' => 'admin'
        ]);

        $adminUser->assignRole('admin');
    }
}
