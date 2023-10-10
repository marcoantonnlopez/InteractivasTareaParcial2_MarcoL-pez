<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitud';

    public function usuario()
{
    return $this->belongsTo(Usuario::class, 'id_usuario');
}

public function cliente()
{
    return $this->belongsTo(User::class, 'id_usuario');
}

// Relación con el detalle de solicitud
public function detalleSolicitud()
{
    return $this->hasMany(DetalleSolicitud::class, 'idsolicitud');
}
}
