<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PeopleApplication>
 */
class PeopleApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'signed_by' => $this->faker->name,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'object' => $this->faker->word,
            'rooms' => $this->faker->word,
            'purpose' => $this->faker->sentence,
            'contract_number' => $this->faker->randomNumber(6),
            'equipment' => $this->faker->text,
            'guests_count' => $this->faker->numberBetween(1, 10),
            'responsible_person' => $this->faker->name,
            'phone_number' => $this->faker->phoneNumber,
            'additional_info' => $this->faker->text(300)

        ];
    }
}
