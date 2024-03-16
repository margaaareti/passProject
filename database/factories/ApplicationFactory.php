<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
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
            'application_number'=>'21.01.2023/4',
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'object' => $this->faker->word,
            'purpose' => $this->faker->sentence,
            'applicationable_type'=> 'App\Models\PeopleApplication',
            'applicationable_id'=> $this->faker->numberBetween(1, 10),
            'application_type'=> 'Проход',
            'status'=>'new',
            'approved_by'=>null,
            'contract_number' => $this->faker->randomNumber(6),
            'equipment' => $this->faker->text,
            'responsible_person' => $this->faker->name,
            'phone_number' => $this->faker->phoneNumber,
            'additional_info' => $this->faker->text(300),
            'viewed'=>false
        ];
    }
}
