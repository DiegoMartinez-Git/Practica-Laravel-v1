<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Perfil extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id', 'ruta_avatar', 'usuario_twitter', 'biografia'
    ];

    protected $table = 'perfiles';

     public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }
}
