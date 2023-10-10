<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function solicitudes()
    {
        return $this->hasMany(DetalleSolicitud::class, 'producto_id');
    }
}
