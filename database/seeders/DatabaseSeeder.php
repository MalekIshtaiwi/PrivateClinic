<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        User::create([
            'name' => 'اشتيوي',
            'email' => 'test@example.com',
            'password' => ('Az_1959$'),
            'role' => 'doctor',
        ]);

        $this->call(ScheduleSeeder::class);

    }
}
