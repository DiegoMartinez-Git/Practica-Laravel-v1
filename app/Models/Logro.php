<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Logro extends Model
{
    protected $fillable = [
        'titulo', 'url_icono', 'puntos_experiencia'
    ];

    protected $table = 'logros';

         public function usuarios(): BelongsToMany

    {
        return $this->belongsToMany(
            Usuario::class,
            'logro_usuario',
            'logro_id',
            'usuario_id'
            
            )->withPivot('obtenido_en');
    }
    }

