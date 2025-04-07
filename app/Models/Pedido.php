<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    protected $fillable=['user_id', 'total', 'estado'];

    //RELACION 1:N CON USER
    public function usuario(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    //RELACION 1:N CON DETALLES
    public function detalles(): HasMany{
        return $this->hasMany(DetallePedido::class);
    }
}
