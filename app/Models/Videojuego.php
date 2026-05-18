<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Videojuego extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'categoria', 'desarrollador'
    ];

    protected $table = 'videojuegos';

    public function torneos(): HasMany
    {
        return $this->hasMany(Torneo::class);
    }
}
