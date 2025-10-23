<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'password',
        'address',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
