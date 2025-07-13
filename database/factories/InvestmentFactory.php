<?php

namespace Database\Factories;

use App\Enums\Investment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investment>
 */
class InvestmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'investment_name' => $this->faker->unique()->randomElement(Investment::cases())->value,
        ];
    }
}
