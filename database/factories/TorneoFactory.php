<?php

namespace Database\Factories;

use App\Models\Torneo;
use App\Models\Videojuego;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Torneo>
 */
class TorneoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'videojuego_id' => Videojuego::factory(),
            'nombre' => $this->faker->unique()->words(3, true).' Championship',
            'fecha_inicio' => $this->faker->dateTimeBetween('now', '+1 year'),
            'bote_premios' => $this->faker->randomFloat(2, 1000, 5000000),
        ];
    }
}
