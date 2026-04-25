<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Equipo extends Model
{ 
    use HasFactory;
           protected $fillable = [
        'nombre', 'url_logo', 'region'
    ];

    protected $table = 'equipos';
    public function partidas() :HasMany{

        return $this->hasMany(Partida::class);
    }
    public function torneos() :BelongsToMany{

        return $this->belongsToMany(
            Torneo::class,
            'equipo_torneo',
            'equipo_id',
             'torneo_id'
        )->withPivot('posicion_siembra');
    }
  /* * Manera simple de tabla pivot siempre que este todo estructurado con nombres para laravel    
   public function torneos() :BelongsToMany{

        return $this->belongsToMany(
            Torneo::class
        )->withPivot('posicion_siembra');
    } */


    public function sede() :HasOne{

        return $this->hasOne(Sede::class);
    }

 public function usuarios() :HasMany{

        return $this->hasMany(Usuario::class);
    }

     public function patrocinadores() :BelongsToMany{

        return $this->belongsToMany(
            Patrocinador::class,
            'patrocinador_equipo',
            'equipo_id',
            'patrocinador_id'
        )->withPivot('fin_contrato');
    }
}
