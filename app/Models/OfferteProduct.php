<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'offerte_id',
        'product_id',
    ];

    public function offerte()
    {
        return $this->belongsTo(Offerte::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
