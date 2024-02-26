<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer_petanis extends Model
{
    use HasFactory;
    protected $table = "offer_petanis";
    protected $fillable = [
        'id_petani',
        'name_product',
        'quantity',
        'price_start_sell',
    ];

    public function petani(){
        return $this->hasOne(Petanis::class,'id','id_petani');
    }


}
