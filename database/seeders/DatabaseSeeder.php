<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        //va créer 10 users aléatoires
        $properties = ['Maison', 'Appartement', 'Baraque à frites', 'Entrepôt en tôle', 'Cabanon de plage'];

        foreach ($properties as $property){
            DB::table('properties')->insert([
                'title' => $property,
                'description' => 'Amazing '.$property,
                'price' => rand(25000, 150000),
                'sold' => rand(0, 1),
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        //! au user Illuminate/...
    }
}
