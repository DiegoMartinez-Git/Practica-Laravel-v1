<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\Partida;
use App\Models\Torneo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Partida>
 */
class PartidaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'torneo_id' => Torneo::factory(),
            'equipo_id' => Equipo::factory(),
            'fecha_programada' => $this->faker->dateTimeBetween('now', '+6 months'),
            'url_transmision' => $this->faker->url(),
        ];
    }
}
