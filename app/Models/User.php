<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function direccion()
    {
        return $this->hasOne(Direccion::class, 'id_usuario');
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'id_usuario');
    }
}

