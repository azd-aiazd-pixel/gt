<?php

namespace Database\Factories;

use App\Models\Event; 
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NfcTagFactory extends Factory
{
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(), 
            'nfc_code' => 'NFC-' . Str::upper(Str::random(10)),
            'status' => 'active',
        ];
    }
}