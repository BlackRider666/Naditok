<?php

namespace App\Order;

use App\ProductGroup\Product\Product;
use App\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'status',
    ];

    protected $with = ['product'];

    protected $appends = [
        'total_price'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return float
     */
    public function getTotalPriceAttribute(): float
    {
        return $this->price * $this->quantity;
    }
}
