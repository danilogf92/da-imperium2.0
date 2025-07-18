<?php

namespace Database\Factories;

use App\Enums\Justification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Justification>
 */
class JustificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'justification_name' => $this->faker->unique()->randomElement(Justification::cases())->value,
        ];
    }
}
