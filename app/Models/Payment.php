<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'amount',
        'payment_method',
        'payment_status',
        'paid_at'
    ];

    /**
     * Get the order associated with this payment.
     */
    public function order(){
        return $this->belongsTo(Orders::class);
    }

}
