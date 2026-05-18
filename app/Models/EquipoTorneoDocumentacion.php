<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EquipoTorneoDocumentacion extends Pivot
{
    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'equipo_id', 'torneo_id', 'posicion_siembra'
    ];

    protected $table = 'equipo_torneo';

    /*
     * Ejemplo de modelo pivot personalizado.
     * Para activarlo en la relacion N:M:
     * ->using(EquipoTorneo::class)
     */

    public function torneo(): BelongsTo{
          return $this->belongsTo(Torneo::class,'torneo_id');
    }
    public function equipo(): BelongsTo{
          return $this->belongsTo(Equipo::class,'equipo_id');
    }

}
