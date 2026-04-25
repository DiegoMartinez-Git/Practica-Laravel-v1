<?php

namespace Database\Seeders;

use App\Models\Logro;
use Illuminate\Database\Seeder;

class LogroSeeder extends Seeder
{
    public function run(): void
    {
        $logros = [
            [
                'titulo' => 'Primera victoria',
                'url_icono' => '/img/logros/primera-victoria.png',
                'puntos_experiencia' => 100,
            ],
            [
                'titulo' => 'Racha de cinco',
                'url_icono' => '/img/logros/racha-cinco.png',
                'puntos_experiencia' => 250,
            ],
            [
                'titulo' => 'Jugador estratega',
                'url_icono' => '/img/logros/jugador-estratega.png',
                'puntos_experiencia' => 300,
            ],
            [
                'titulo' => 'MVP del torneo',
                'url_icono' => '/img/logros/mvp-torneo.png',
                'puntos_experiencia' => 500,
            ],
            [
                'titulo' => 'Leyenda competitiva',
                'url_icono' => '/img/logros/leyenda-competitiva.png',
                'puntos_experiencia' => 1000,
            ],
        ];

        foreach ($logros as $logro) {
            Logro::updateOrCreate(
                ['titulo' => $logro['titulo']],
                [
                    'url_icono' => $logro['url_icono'],
                    'puntos_experiencia' => $logro['puntos_experiencia'],
                ],
            );
        }
    }
}
