<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'image',
        'name',
        'description',
        'category_id',
        'retail_price',
        'actual_price',
        'quantity',
        'status',
        'action',
        'is_customizable',
        'customization_fields',
    ];

    protected $casts = [
        'is_customizable' => 'boolean',
        'customization_fields' => 'array',
        'gallery' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
