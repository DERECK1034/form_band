<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subgeneros extends Model
{
    use HasFactory;
    protected $primaryKey ='ids';
    protected $fillable = ['ids', 'nombre'];
}
