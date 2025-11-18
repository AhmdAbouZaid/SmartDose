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
        'response_data',
    ];

    protected $casts = [
        'response_data' => 'array',
    ];

    /*------------------------------------
     |             Relations
     ------------------------------------*/

    // Payment → belongsTo Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
