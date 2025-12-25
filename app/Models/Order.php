<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    /*------------------------------------
     |             Relations
     ------------------------------------*/

    // Order → belongsTo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order → hasOne Payment (order has one payment, not many)
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Order → hasMany Payments (backup relation if you need history)
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Order → hasMany Order Items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /*------------------------------------
     |        Status Check Methods
     ------------------------------------*/

    // Check if order is pending
    public function isPending()
    {
        return $this->status === 'pending';
    }

    // Check if order is completed
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Check if order is cancelled
    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    /*------------------------------------
     |      Status Update Methods
     ------------------------------------*/

    // Mark order as completed
    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->save();
    }

    // Mark order as cancelled
    public function markAsCancelled()
    {
        $this->status = 'cancelled';
        $this->save();
    }

    // Mark order as pending
    public function markAsPending()
    {
        $this->status = 'pending';
        $this->save();
    }

    /*------------------------------------
     |         Helper Methods
     ------------------------------------*/

    // Calculate total from items (in case you need to recalculate)
    public function calculateTotal()
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    // Get total items count
    public function getTotalItemsCount()
    {
        return $this->items->sum('quantity');
    }
}