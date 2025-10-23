<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'size',
        'fabric',
        'color',
        'style_description',
        'reference_image_url',
        'delivery_date',
    ];

    // Relationships
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
