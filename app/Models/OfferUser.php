<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'email'
    ];

    public function offer()
    {
        return $this->hasMany(Offer::class, 'offer_user_id', 'id');
    }
}
