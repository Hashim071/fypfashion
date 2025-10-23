<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image', // ✅ now image field is fillable
    ];

    /**
     * ✅ Accessor for category image URL
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-category.png'); // fallback default image
    }

    /**
     * ✅ Relationship: Category has many Products
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
