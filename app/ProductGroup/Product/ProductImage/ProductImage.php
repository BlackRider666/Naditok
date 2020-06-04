<?php

namespace App\ProductGroup\Product\ProductImage;

use App\ProductGroup\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'thumb',
    ];

    protected $casts = [
        'product_id'    =>  'select',
        'thumb'         =>  'image',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
