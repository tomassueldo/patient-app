<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'phone_number' => $this->generateArgentinianPhoneNumber(),
            'document_image' => $this->faker->imageUrl(),
            'email_verified_at' => now()
        ];
    }

    /**
     * Generate a valid Argentinian phone number.
     *
     * @return string
     */
    private function generateArgentinianPhoneNumber(): string
    {
        // Código de país +54, seguido de 10 a 13 dígitos (total máximo 16 dígitos)
        return '549' . $this->faker->numerify('##########');
    }
}
