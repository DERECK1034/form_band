<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cupones extends Model
{
    use HasFactory;
    protected $primaryKey ='idcup';
    protected $fillable = ['idcup','nombre' ,'codigo', 'porcentaje'];
}
