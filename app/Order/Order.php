<?php

namespace App\Order;

use App\Order\OrderItem\OrderItem;
use App\ProductGroup\Product\Product;
use App\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'status',
        'created_at',
    ];

    protected $appends = [
        'price'
    ];

    protected $with = [
        'items'
    ];
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @return float
     */
    public function getPriceAttribute(): float
    {
        $price = 0;
        foreach ($this->items as $item) {
            $price += $item->total_price;
        }
        return $price;
    }
}
