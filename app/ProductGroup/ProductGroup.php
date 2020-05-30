<?php

namespace App\ProductGroup;

use App\Brand\Brand;
use App\Category\Category;
use App\ProductGroup\Product\Product;
use App\ProductGroup\ProductGroupComment\ProductGroupComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductGroup extends Model
{
    protected $table = 'product_groups';

    protected $fillable = [
        'title',
        'brand_id',
        'category_id',
        'desc',
        'weight',
        'length',
        'width',
        'height',
    ];

    protected $casts = [
        'title'         =>  'string',
        'brand_id'      =>  'select',
        'category_id'   =>  'select',
        'desc'          =>  'text',
        'weight'        =>  'integer',
        'length'        =>  'integer',
        'width'         =>  'integer',
        'height'        =>  'integer',
    ];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ProductGroupComment::class);
    }
}
