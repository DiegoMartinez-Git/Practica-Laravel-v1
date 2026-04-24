<?php

namespace Database\Factories;

use App\Models\Videojuego;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Videojuego>
 */
class VideojuegoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->unique()->words(2, true),
            'categoria' => $this->faker->randomElement(['MOBA', 'FPS', 'Battle Royale', 'Estrategia', 'Deportes']),
            'desarrollador' => $this->faker->company(),
        ];
    }
}
