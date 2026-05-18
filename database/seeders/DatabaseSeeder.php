<?php

namespace Database\Seeders;

use App\Models\Equipo;
use App\Models\Logro;
use App\Models\Partida;
use App\Models\Patrocinador;
use App\Models\Perfil;
use App\Models\Sede;
use App\Models\Torneo;
use App\Models\User;
use App\Models\Usuario;
use App\Models\Videojuego;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $videojuegos = Videojuego::factory()->count(6)->create();
        $equipos = Equipo::factory()->count(8)->create();
        $patrocinadores = Patrocinador::factory()->count(5)->create();

        $torneos = Torneo::factory()
            ->count(6)
            ->state(fn () => [
                'videojuego_id' => $videojuegos->random()->id,
            ])
            ->create();

        $equipos->each(function (Equipo $equipo): void {
            Sede::factory()->create([
                'equipo_id' => $equipo->id,
            ]);
        });

        $usuarios = Usuario::factory()
            ->count(24)
            ->state(fn () => [
                'equipo_id' => $equipos->random()->id,
            ])
            ->create();

        $usuarios->each(function (Usuario $usuario): void {
            Perfil::factory()->create([
                'usuario_id' => $usuario->id,
            ]);
        });

        Partida::factory()
            ->count(18)
            ->state(fn () => [
                'torneo_id' => $torneos->random()->id,
                'equipo_id' => $equipos->random()->id,
            ])
            ->create();

        $this->call(LogroSeeder::class);

        $logros = Logro::all();

        $torneos->each(function (Torneo $torneo) use ($equipos): void {
            $torneo->equipos()->attach(
                $equipos->random(4)
                    ->values()
                    ->mapWithKeys(fn (Equipo $equipo, int $posicion) => [
                        $equipo->id => ['posicion_siembra' => $posicion + 1],
                    ])
                    ->all(),
            );
        });

        $equipos->each(function (Equipo $equipo) use ($patrocinadores): void {
            $equipo->patrocinadores()->attach(
                $patrocinadores->random(2)
                    ->mapWithKeys(fn (Patrocinador $patrocinador) => [
                        $patrocinador->id => [
                            'fin_contrato' => fake()->dateTimeBetween('+6 months', '+2 years')->format('Y-m-d'),
                        ],
                    ])
                    ->all(),
            );
        });

        $usuarios->each(function (Usuario $usuario) use ($logros): void {
            $usuario->logros()->attach(
                $logros->random(random_int(1, 3))
                    ->mapWithKeys(fn (Logro $logro) => [
                        $logro->id => [
                            'obtenido_en' => fake()->dateTimeBetween('-1 year', 'now'),
                        ],
                    ])
                    ->all(),
            );
        });
    }
}
