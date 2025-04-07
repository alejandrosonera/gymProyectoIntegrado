<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Clase extends Model
{
    /** @use HasFactory<\Database\Factories\ClaseFactory> */
    use HasFactory;

    protected $fillable=['nombre', 'descripcion', 'fecha_hora', 'max_participantes', 'entrenador_id'];

    //RELACION 1:N CON USER
    public function entrenador(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    //RELACION N:M CON CLIENTES
    public function clientes(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }
}
