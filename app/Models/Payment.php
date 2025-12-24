<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'status',
        'transaction_id',
        'payment_gateway',
        'payment_method',
        'response_data',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'response_data' => 'array',
    ];

    // Relationship: Payment belongs to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Check if payment is successful
    public function isSuccessful()
    {
        return $this->status === 'success';
    }

    // Check if payment is pending
    public function isPending()
    {
        return $this->status === 'pending';
    }

    // Mark payment as success
    public function markAsSuccess($transactionId = null)
    {
        $this->status = 'success';
        if ($transactionId) {
            $this->transaction_id = $transactionId;
        }
        $this->save();
    }

    // Mark payment as failed
    public function markAsFailed()
    {
        $this->status = 'failed';
        $this->save();
    }

    // Mark payment as refunded
    public function markAsRefunded()
    {
        $this->status = 'refunded';
        $this->save();
    }
}