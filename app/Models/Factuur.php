<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factuur extends Model
{
    use HasFactory;

    protected $table = 'facturen';

    protected $fillable = [
        'name_company_id',
        'product_id',
        'invoice_date',
        'due_date',
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
}
