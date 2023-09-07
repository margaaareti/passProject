<?php

namespace Database\Seeders;

use App\Models\PeopleApplication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PeopleApplication::factory(10)->create(['user_id' => 1]);
    }
}
