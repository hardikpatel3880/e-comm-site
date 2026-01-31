<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
      protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Calculate subtotal for this cart item
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->price;
    }
}
