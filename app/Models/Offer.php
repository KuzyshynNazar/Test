<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_user_id',
        'title'
    ];

    public function products()
    {
        return  $this->belongsToMany(Product::class, 'offer_products');
    }

    public function offerUser()
    {
        return $this->hasOne(OfferUser::class, 'id','offer_user_id');    }

}
