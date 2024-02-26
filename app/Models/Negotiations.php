<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negotiations extends Model
{
    use HasFactory;
    protected $table = "negotiations";

    protected $fillable = [
        'id_distributor',
        'id_penawaran',
        'price_submitted',
        'price_deal',
        'quantity',
        'date_approve_petani',
        'status_negotiation',
    ];
}
