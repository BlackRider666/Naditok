<?php

namespace App\ProductGroup;

use App\Brand\Brand;
use App\Category\Category;
use App\ProductGroup\Product\Product;
use App\ProductGroup\ProductGroupComment\ProductGroupComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

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
        'age',
        'out_id',
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
        'age'           =>  'select',
    ];

    protected $appends = [
        'category_title',
        'brand_title',
        'comment_count',
        'comment_average_rating',
        'age_string',
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

    /**
     * @return string
     */
    public function getCategoryTitleAttribute(): string
    {
        return $this->category->title_ru;
    }

    /**
     * @return string
     */
    public function getBrandTitleAttribute(): string
    {
        return $this->brand->title;
    }

    /**
     * @return mixed
     */
    public function getCommentCountAttribute()
    {
        return $this->comments->count();
    }

    /**
     * @return mixed
     */
    public function getCommentAverageRatingAttribute()
    {
        return $this->comments->average('rating');
    }

    /**
     * @return mixed
     */
    public function getAgeStringAttribute()
    {
        if ($this->age === 1) {
            return 'От 0 до 1 года';
        } elseif ($this->age === 2) {
            return 'От 1 до 2 лет';
        } elseif ($this->age === 3) {
            return 'От 2 до 3 лет';
        } elseif ($this->age === 4) {
            return 'От 3 до 5 лет';
        } elseif ($this->age === 5) {
            return 'От 5 до 7 лет';
        } elseif ($this->age === 6) {
            return 'От 7 до 12 лет';
        } elseif ($this->age === 7) {
            return 'Старше 12 лет';
        } else {
            return 'Не указано';
        }
    }

}
