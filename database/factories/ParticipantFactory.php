<?php

namespace Database\Factories;
use App\Models\User;  
use App\Models\Event;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participant>
 */
class ParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
  
public function definition(): array
{
    return [
        'user_id' => User::factory(), 
        'event_id' => Event::factory(), 
        'nfc_tag_id' => null,
        'balance' => fake()->randomFloat(2, 0, 500),
    ];
}
}