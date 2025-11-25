<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'stock',
        'price',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function linkedContracts()
    {
        return $this->belongsToMany(Contract::class, 'contract_product');
    }

    public function facturen()
    {
        return $this->hasMany(Factuur::class);
    }

    public function offertes()
    {
        return $this->hasMany(Offerte::class);
    }

    public function orderLogistics()
    {
        return $this->hasMany(OrderLogistic::class);
    }

    public function feedbacks()
    {
        return $this->belongsToMany(Feedback::class, 'feedback_product')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
