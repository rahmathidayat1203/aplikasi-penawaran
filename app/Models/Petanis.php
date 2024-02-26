<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petanis extends Model
{
    use HasFactory;

    protected $table = "petanis";
    protected $fillable = [
        'name',
        'no_hp',
        'email'
    ];
}
