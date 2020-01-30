<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table= 'events';

    //
    protected $fillable = [
        'titulo', 'descripcion', 'prioridad', 'propietario', 'broadcast', 'fecha', 'estado',
    ];

    //public $timestamps = false;
}