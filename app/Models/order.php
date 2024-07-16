<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shipping_address',
        'phone',
        'user_id',
        'product_id',
    ];

    public function user(): HasOne
    {
        return  $this->hasOne(User::class, 'id','user_id'); //'id','user_id'
    }

    public function product(): HasOne
    {
        return  $this->hasOne(Product::class, 'id', 'product_id'); //'id','product_id'
    }
}
