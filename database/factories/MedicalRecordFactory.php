<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    protected $model = MedicalRecord::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create('ar_JO'); // Arabic locale for RTL content

        return [
            'patient_id' => Patient::factory(), // Creates a patient if none exists
            'complain' => $faker->sentence(6),
            'examination' => $faker->paragraph(2),
            'diagnosis' => $faker->sentence(5),
            'lab_test' => $faker->randomElement(['تحليل دم', 'تحليل بول', 'سكر', null]),
            'lab_test_path' => $faker->optional()->filePath(), // simulate file path
            'rad_test' => $faker->randomElement(['أشعة سينية', 'رنين مغناطيسي', 'أشعة مقطعية', null]),
            'rad_test_path' => $faker->optional()->filePath(),
            'treatment' => $faker->sentence(4),
        ];
    }
}
