<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Torneo extends Model
{
    use HasFactory;

    protected $fillable = [
        'videojuego_id', 'nombre', 'fecha_inicio', 'bote_premios'
    ];

    protected $table = 'torneos';

       public function videojuego(): BelongsTo
    {
        return $this->belongsTo(Videojuego::class);
    }

    public function equipos(): BelongsToMany
    {
         return $this->belongsToMany( // - 1. <- En ambos modelos belongToMany en pivot belogTo
        Equipo::class, // - <- 2. Lamar al modelo a relacionar
        'equipo_torneo', // - <- 3. Nombre de la tabla pivot
        'torneo_id', // - <- 4.FK de este modelo 
        'equipo_id' // - <- 5.FK del modelo a relacionar
    )->withPivot('posicion_siembra'); // - <- 5. Atributos propios si los tiene de la tabla pivot
    }
    

    /* ! MAL ASI NO SE RELACIONA UNA TABLA N:M CON LA PIVOT  

     public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class,'torneo_id');
    } */
      public function partidas(): HasMany
    {
        return $this->hasMany(Partida::class);
    }

}
