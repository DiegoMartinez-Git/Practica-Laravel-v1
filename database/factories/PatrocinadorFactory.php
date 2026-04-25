<?php

namespace Database\Factories;

use App\Models\Patrocinador;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patrocinador>
 */
class PatrocinadorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre_marca' => $this->faker->unique()->company(),
            'sitio_web' => $this->faker->url(),
        ];
    }
}
