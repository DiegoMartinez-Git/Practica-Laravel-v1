<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patrocinador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_marca', 'sitio_web'
    ];

    protected $table = 'patrocinadores';


      public function equipos() :BelongsToMany{

        return $this->belongsToMany(
            Equipo::class,
            'patrocinador_equipo',
            'patrocinador_id',
            'equipo_id',
            
        )->withPivot('fin_contrato');
    }
}
