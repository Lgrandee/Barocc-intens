<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'feedback',
        'employee_id',
        'customer_id',
        'description',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function planningTickets()
    {
        return $this->hasMany(PlanningTicket::class, 'feedback_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'feedback_product')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
