<?php

namespace App\Shipment;

use App\ProductGroup\Product\Product;
use App\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    protected $table = 'shipments';

    protected $fillable =[
        'user_id',
        'product_id',
        'quantity',
        'size',
    ];

    protected $with = [
        'product'
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
}
