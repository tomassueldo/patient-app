<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $patients = \App\Models\Patient::factory(12000)->create();

        // Crear 5 citas para cada paciente
        foreach ($patients as $patient) {
            for ($i = 0; $i < 5; $i++) {
                \App\Models\Appointment::create([
                    'patient_id' => $patient->id,
                    'appointment_date' => now()->addDays(rand(1, 365)), // Cita en un rango de 1 a 365 días a partir de hoy
                    'doctor_name' => fake()->name(), // Genera un nombre de doctor ficticio
                    'reason' => fake()->sentence(), // Genera una razón ficticia
                ]);
            }
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
