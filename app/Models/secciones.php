<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class secciones extends Model
{
    use HasFactory;
    protected $primaryKey ='idsec';
    protected $fillable = ['idsec','nombre' ,'disponibilidad', 'costo'];
}
