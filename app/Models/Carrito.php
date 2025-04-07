<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carrito extends Model
{
    protected $fillable=['user_id', 'producto_id', 'cantidad', 'subtotal'];

    //RELACION 1:N CON USER
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    //RELACION 1:N CON PRODUCTO
    public function producto(): BelongsTo{
        return $this->belongsTo(Producto::class);
    }
}
