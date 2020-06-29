<?php

namespace App\Order\OrderItem;

use App\Order\Order;
use App\ProductGroup\Product\Product;
use App\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'order_id',
    ];

    protected $with = ['product'];

    protected $appends = [
        'total_price'
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return float
     */
    public function getTotalPriceAttribute(): float
    {
        return $this->price * $this->quantity;
    }
}
