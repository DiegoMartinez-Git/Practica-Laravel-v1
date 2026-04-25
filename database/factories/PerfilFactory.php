<?php

namespace Database\Factories;

use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Perfil>
 */
class PerfilFactory extends Factory
{
    public function definition(): array
    {
        return [
            'usuario_id' => Usuario::factory(),
            'ruta_avatar' => $this->faker->imageUrl(256, 256, 'people', true),
            'usuario_twitter' => '@'.$this->faker->unique()->userName(),
            'biografia' => $this->faker->paragraph(),
        ];
    }
}
