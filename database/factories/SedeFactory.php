<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\Sede;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sede>
 */
class SedeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'equipo_id' => Equipo::factory(),
            'direccion' => $this->faker->streetAddress(),
            'ciudad' => $this->faker->city(),
            'pais' => $this->faker->country(),
            'metros_cuadrados' => $this->faker->numberBetween(120, 2500),
        ];
    }
}
