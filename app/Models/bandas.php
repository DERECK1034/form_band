<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bandas extends Model
{
    use HasFactory;
    protected $primaryKey ='idb';
    protected $fillable = ['idma','nombre', 'id_inspo', 'genero', 'id_subgen', 'fecha_surgimiento', 'fecha_lanzamiento', 'vocalista', 'guitarrista', 'bajista', 'baterista', 'email', 'discografia', 'codigo', 'activo', 'foto', 'archivo'];
}
