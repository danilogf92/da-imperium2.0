<?php

namespace Database\Factories;

use App\Enums\ClassificationOfInvestments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassificationOfInvestment>
 */
class ClassificationOfInvestmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'classification_name' => $this->faker->unique()->randomElement(ClassificationOfInvestments::cases())->value,
        ];
    }
}
