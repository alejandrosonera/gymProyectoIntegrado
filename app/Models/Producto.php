<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $fillable=['nombre', 'descripcion', 'precio', 'stock', 'imagen'];

    //RELACION 1:N CON CARRITOS
    public function carritos(): HasMany{
        return $this->hasMany(Carrito::class);
    }

    //RELACION 1:N CON DETALLEPEDIDOS
    public function detallePedidos(): HasMany{
        return $this->hasMany(DetallePedido::class);
    }
}
