<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'documentos';
    
    protected $fillable = [
        'filename',
        'data_json',
        'usuario',
        'fecha_upload',
        'reporte'
    ];

    protected $casts = [
        'data_json' => 'array',
        'reporte' => 'array',
        'fecha_upload' => 'datetime:Y-m-d H:i:s',
    ];
}
