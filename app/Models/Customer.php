<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_company',
        'contact_person',
        'email',
        'phone_number',
        'bkr_number',
        'address',
        'city',
        'zipcode',
        'bkr_status',
        'offerte_id',
        'factuur_id',
        'contract_id',
    ];

    public function offerte()
    {
        return $this->belongsTo(Offerte::class);
    }

    public function factuur()
    {
        return $this->belongsTo(Factuur::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
