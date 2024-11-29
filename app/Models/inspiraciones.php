<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inspiraciones extends Model
{
    use HasFactory;
    protected $primaryKey ='idi';
    protected $fillable = ['idi', 'nombre'];
}
