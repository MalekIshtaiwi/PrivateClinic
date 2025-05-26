<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use App\Models\MedicalRecord;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Patient::factory()->count(30)->create();
        $patients = Patient::all();

        foreach ($patients as $patient) {
            MedicalRecord::factory()->create([
                'patient_id' => $patient->id,
            ]);
        }

        User::create([
            'name' => 'اشتيوي',
            'email' => 'test@example.com',
            'password' => ('Az_1959$'),
            'role' => 'doctor',
        ]);

        $this->call(ScheduleSeeder::class);

    }
}
