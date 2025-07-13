<?php

namespace Database\Factories;

use App\Models\ClassificationOfInvestment;
use App\Models\Company;
use App\Models\Investment;
use App\Models\Justification;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-6 months', 'now');
        $finishDate = $this->faker->dateTimeBetween($startDate, '+6 months');

        return [
            'name' => $this->faker->sentence(3),
            'pda_code' => strtoupper($this->faker->bothify('PDA-###')),
            'data_uploaded' => $this->faker->boolean(),
            'rate' => $this->faker->randomFloat(2, 1, 5),

            // Si no hay registros, crea uno con factory
            'state_id' => State::query()->inRandomOrder()->value('id') ?? State::factory(),
            'investment_id' => Investment::query()->inRandomOrder()->value('id') ?? Investment::factory(),
            'classification_of_investment_id' => ClassificationOfInvestment::query()->inRandomOrder()->value('id') ?? ClassificationOfInvestment::factory(),
            'justification_id' => Justification::query()->inRandomOrder()->value('id') ?? Justification::factory(),

            'start_date' => $startDate->format('Y-m-d'),
            'finish_date' => $finishDate->format('Y-m-d'),
        ];
    }
}
