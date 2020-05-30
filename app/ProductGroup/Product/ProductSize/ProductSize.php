<?php

namespace App\ProductGroup\Product\ProductSize;

use App\ProductGroup\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSize extends Model
{
    protected $table = 'product_sizes';

    protected $fillable = [
        'product_id',
        'size',
    ];

    protected $casts = [
        'product_id'    =>  'select',
        'size'          =>  'string',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
