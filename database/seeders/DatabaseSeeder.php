<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Participant;
use App\Models\NfcTag;
use App\Models\Store;
use App\Models\EventStore;
use App\Enum\Role;
use App\Enum\EventStoreStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. CRÉER UN ÉVÉNEMENT (Le pivot central de ton festival)
        $event = Event::factory()->create(['name' => ' Festival 2026']);

        // 2. Utilisateurs avec compte mais SANS bracelet (Inscrits en ligne)
        User::factory(10)->create(['role' => Role::Participant])
            ->each(function ($user) use ($event) {
                Participant::factory()->create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'nfc_tag_id' => null, 
                    'balance' => 0,      
                ]);
            });

        // 3. Utilisateurs avec compte ET bracelet chargé (Prêts à consommer)
        User::factory(15)->create(['role' => Role::Participant])
            ->each(function ($user) use ($event) {
                $tag = NfcTag::factory()->create([
                    'event_id' => $event->id,
                    'status' => 'active'
                ]);
                
                Participant::factory()->create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'nfc_tag_id' => $tag->id,
                    'balance' => rand(100, 500), 
                ]);
            });

        // 4. CRÉATION DES BOUTIQUES ET LIAISONS (La partie qui manquait)
        User::factory(5)->create(['role' => Role::Store])
            ->each(function ($user) use ($event) {
                // Création de la boutique liée à l'utilisateur
                $store = Store::factory()->create([
                    'user_id' => $user->id,
                    'name' => fake()->company() . ' Shop',
                ]);

                // Création de la liaison avec le festival (Modèle métier EventStore)
                EventStore::factory()->create([
                    'event_id' => $event->id,
                    'store_id' => $store->id,
                    'status' => EventStoreStatus::ACCEPTED, // Acceptée par défaut pour le test
                ]);
            });

        // 5. Création d'un Admin pour toi te connecter
        User::factory()->create([
            'name' => 'Admin ',
            'email' => 'admin@ongmailetag.ma',
            'password' => bcrypt('password'),
            'role' => Role::Admin,
        ]);
    }
}