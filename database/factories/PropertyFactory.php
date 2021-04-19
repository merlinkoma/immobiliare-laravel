<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->randomElement(['Maison', 'Appartement', 'Baraque à frites', 'Entrepôt en tôle', 'Cabanon de plage']),
            //on prend un élément aléatoire dans le tableau donné
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl,
            'price' => $this->faker->numberBetween(25, 150) * 1000,
            'sold' => $this->faker->boolean,
            'user_id' => User::factory(),
            //si un utilisateur est déjà attaché, on l'utilise sinon on en crée un.
        ];
    }
}
