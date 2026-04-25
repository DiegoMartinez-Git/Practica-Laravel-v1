<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sede extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id', 'direccion', 'ciudad', 'pais', 'metros_cuadrados'
    ];

    protected $table = 'sedes';

        public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
}
