<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'table_id',
        'subtotal',
        'total_discount',
        'total_amount',
        'status',
        'payment_status',
    ];

    // Get the user who placed or served the order.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Get the restaurant table assigned to the order.
    public function table()
    {
        return $this->belongsTo(RestaurantTable::class);
    }
    // Get the items included in the order.

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Get the payment record for the order.
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
