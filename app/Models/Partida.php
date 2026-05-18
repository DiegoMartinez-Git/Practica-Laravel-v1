<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partida extends Model
{
    use HasFactory;

    protected $fillable = [
        'torneo_id', 'equipo_id', 'fecha_programada', 'url_transmision'
    ];

    protected $table = 'partidas';

 public function torneo(): BelongsTo
    {
        return $this->belongsTo(Torneo::class);
    }
 public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
    
}
