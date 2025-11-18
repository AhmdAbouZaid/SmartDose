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
        'total',   // مطابق للـ migration
    ];

    /*------------------------------------
     |             Relations
     ------------------------------------*/

    // Order → belongsTo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order → hasMany Payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Order → hasMany Order Items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
