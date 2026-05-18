<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Usuario>
 */
class UsuarioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'equipo_id' => Equipo::factory(),
            'alias' => $this->faker->unique()->userName(),
            'correo' => $this->faker->unique()->safeEmail(),
            'correo_verificado_en' => $this->faker->optional(0.8)->dateTimeBetween('-1 year', 'now'),
            'contrasena' => Hash::make('password'),
        ];
    }
}
