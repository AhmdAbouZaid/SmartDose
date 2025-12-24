<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    // Relationship: Product has many OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Check if product is in stock
    public function inStock()
    {
        return $this->stock > 0;
    }

    // Decrease stock when ordered
    public function decreaseStock($quantity)
    {
        if ($this->stock >= $quantity) {
            $this->stock -= $quantity;
            $this->save();
            return true;
        }
        return false;
    }

    // Increase stock when order cancelled
    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
        $this->save();
    }
}