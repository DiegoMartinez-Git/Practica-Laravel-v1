<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id', 'alias', 'correo', 'correo_verificado_en', 'contrasena'
    ];

    protected $table = 'usuarios';

       public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
       public function perfil(): HasOne
    {
        return $this->hasOne(Perfil::class);
    }
       public function logros(): BelongsToMany

    {
        return $this->belongsToMany(
            Logro::class,
            'logro_usuario',
            'usuario_id',
            'logro_id',
            )->withPivot('obtenido_en');
    }
}
