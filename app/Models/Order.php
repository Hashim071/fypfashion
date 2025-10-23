<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'delivery_address',
        'payment_method',
        'status',
        'payment_status',
    ];

    // Order belongs to a User (customer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order has many Order Items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Order can have one Review
    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function returnRequest()
    {
        return $this->hasOne(ReturnRequest::class, 'order_id');
    }

    // Order has many Customizations through Order Items
    public function customizations()
    {
        return $this->hasManyThrough(Customization::class, OrderItem::class);
    }

    public function orderItems()
    {
        // Assuming you have an OrderItem model that belongs to an Order
        return $this->hasMany(OrderItem::class);
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isUnpaid(): bool
    {
        return $this->payment_status === 'unpaid';
    }

    public function isPartial(): bool
    {
        return $this->payment_status === 'partial';
    }

    public function isFailed(): bool
    {
        return $this->payment_status === 'failed';
    }
}
