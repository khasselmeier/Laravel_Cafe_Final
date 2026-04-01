<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Mass-assignable fields
    protected $fillable = [
        'name',
        'description',
        'price',        // stored in cents
        'image',        // URL or path
        'category',
        'is_available',
    ];

    // Casts
    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'integer',
    ];

    /**
     * Get all order items for this product
     */
    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    /**
     * Optional: get all orders containing this product
     */
    public function orders()
    {
        return $this->hasManyThrough(
            \App\Models\Order::class,
            \App\Models\OrderItem::class,
            'product_id', // Foreign key on OrderItem table...
            'id',         // Foreign key on Order table
            'id',         // Local key on Product table
            'order_id'    // Local key on OrderItem table
        );
    }
}
