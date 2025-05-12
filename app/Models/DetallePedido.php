<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetallePedido extends Model
{
    protected $fillable=['pedido_id', 'producto_id', 'cantidad', 'subtotal', 'precio_unitario'];

    //RELACION 1:N CON PEDIDO
    public function pedido(): BelongsTo{
        return $this->belongsTo(Pedido::class);
    }

    //RELACION 1:N CON PRODUCTO
    public function producto(): BelongsTo{
        return $this->belongsTo(Producto::class);
    }
}
