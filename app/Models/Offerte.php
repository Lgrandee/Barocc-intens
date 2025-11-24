<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offerte extends Model
{
    use HasFactory;

    protected $table = 'offertes';

    protected $fillable = [
        'name_company_id',
        'product_id',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'name_company_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'offerte_products')->withPivot('quantity')->withTimestamps();
    }
}
