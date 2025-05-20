<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            ['day_of_week' => 'saturday', 'is_active' => true, 'start_time' => '08:00:00', 'end_time' => '12:00:00'],
            ['day_of_week' => 'sunday', 'is_active' => true, 'start_time' => '08:00:00', 'end_time' => '17:00:00'],
            ['day_of_week' => 'monday', 'is_active' => true, 'start_time' => '08:00:00', 'end_time' => '17:00:00'],
            ['day_of_week' => 'tuesday', 'is_active' => true, 'start_time' => '08:00:00', 'end_time' => '17:00:00'],
            ['day_of_week' => 'wednesday', 'is_active' => true, 'start_time' => '08:00:00', 'end_time' => '17:00:00'],
            ['day_of_week' => 'thursday', 'is_active' => true, 'start_time' => '08:00:00', 'end_time' => '17:00:00'],
        ];

        Schedule::insert($days);
    }
}
