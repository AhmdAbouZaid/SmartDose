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
        'image', // ✅ Add image to fillable
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /*------------------------------------
     |         Relations
     ------------------------------------*/

    /**
     * Product has many OrderItems
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /*------------------------------------
     |      Stock Check Methods
     ------------------------------------*/

    /**
     * Check if product is in stock
     */
    public function inStock()
    {
        return $this->stock > 0;
    }

    /**
     * Decrease stock when ordered
     */
    public function decreaseStock($quantity)
    {
        if ($this->stock >= $quantity) {
            $this->stock -= $quantity;
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * Increase stock when order cancelled
     */
    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
        $this->save();
    }

    /*------------------------------------
     |       Image Helper Methods
     ------------------------------------*/

    /**
     * Get full image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        // Return placeholder if no image
        return asset('images/placeholder-product.png');
    }

    /**
     * Check if product has image
     */
    public function hasImage()
    {
        return !is_null($this->image) && !empty($this->image);
    }
}