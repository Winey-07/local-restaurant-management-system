<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongTo;

class MenuItem extends Model
{
    protected $fillable =[
        'id',
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'status',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
