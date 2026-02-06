<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\Store;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventStore>
 */
class EventStoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
        'store_id' => Store::factory(),
        'status' => \App\Enum\EventStoreStatus::PENDING,
        ];
    }
}
