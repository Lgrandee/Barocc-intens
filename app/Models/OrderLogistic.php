<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLogistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'amount',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
