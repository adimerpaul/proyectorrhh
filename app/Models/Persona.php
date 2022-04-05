<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable=[
        "paterno",
        "materno",
        "nombres",
        "ci",
        "cargo",
        "foto",
        "sueldo",
        "fecharegistro",
    ];
}
