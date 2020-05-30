<?php

namespace App\ProductGroup\Product;

use App\ProductGroup\Product\ProductImage\ProductImage;
use App\ProductGroup\Product\ProductSize\ProductSize;
use App\ProductGroup\ProductGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_group_id',
        'title',
        'price',
        'quantity',
        'minimum',
        'status',
        'view_count',
        'color',
        'product_code',
    ];

    protected $casts = [
        'product_group_id'  =>  'select',
        'title'             =>  'string',
        'price'             =>  'float',
        'quantity'          =>  'integer',
        'minimum'           =>  'integer',
        'status'            =>  'select',
        'color'             =>  'color',
        'product_code'      =>  'string',
    ];

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(ProductGroup::class);
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @return HasMany
     */
    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }
}
