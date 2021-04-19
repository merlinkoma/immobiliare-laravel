<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
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
        \App\Models\User::factory(5)->create();
        \App\Models\User::factory(5)->unverified()->create();

        //50 annonces à l'arrache
        Property::factory(50)->create([
            'user_id' => User::all()->random(),
        ]);

        //5 annonces propres
        $properties = ['Maison', 'Appartement', 'Baraque à frites', 'Entrepôt en tôle', 'Cabanon de plage'];

        foreach ($properties as $property){
            Property::factory()->create([
                'title' => $property,
                'user_id' => User::all()->random(),
            ]);
            //va créer 10 users aléatoires (5 vérifiés, 5 non-vérifiés)
        }

        /*
        

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
        */
    }
}
