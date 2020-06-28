<?php

namespace App\ProductGroup\Product;

use App\Discount\Discount;
use App\ProductGroup\Product\ProductImage\ProductImage;
use App\ProductGroup\Product\ProductSize\ProductSize;
use App\ProductGroup\ProductGroup;
use App\Shipment\Shipment;
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
        'discount_id',
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

    protected $with = ['images','sizes','discount'];

    protected $appends = [
        'new_price',
        'full_title'
    ];

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(ProductGroup::class,'product_group_id');
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

    /**
     * @return BelongsTo
     */
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    /**
     * @return int|null
     */
    public function getNewPriceAttribute(): ?int
    {
        if($this->discount && $this->discount->type === 0)
        {
            return $this->price*(100-$this->discount->size)/100;
        }
        if($this->discount && $this->discount->type === 1)
        {
            return $this->price-$this->discount->size;
        }
        return null;
    }

    /**
     * @return HasMany
     */
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    /**
     * @return string
     */
    public function getFullTitleAttribute(): string
    {
        return $this->group->title.' '.$this->title;
    }
}
