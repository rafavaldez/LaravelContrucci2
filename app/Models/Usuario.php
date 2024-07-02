<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'usuarios';
    
    protected $fillable = [
        'nombreUsuario',
        'nombre',
        'apellido',
        'dni',
        'correoElectronico',
        'contrasenaHash',
        'fechaRegistro',
        'roles',
        'activo'
    ];

    protected $casts = [
        'roles' => 'array',
        'fechaRegistro' => 'datetime:Y-m-d\TH:i:s',
        'activo' => 'boolean',
    ];
}
