<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $table = "images";
    protected $fillable = [
        'id_offering_petani',
        'link_images'
    ];

    public function OfferPetani(){
        return $this->hasOne(Offer_petanis::class,'id','id_offering_petani');
    }


}
