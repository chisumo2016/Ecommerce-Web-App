<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'quantity',
        'price',
        'category_id',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The carts that belong to the product.
     */
    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class);
    }

    /**
     * Get the user that owns the product.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
