<?php

namespace App\ProductGroup\Product\ProductImage;

use App\Core\PathManager;
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

    protected $appends = [
        'thumb_url',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getThumbUrlAttribute(): string
    {
        return $this->thumb?
            (new PathManager())->getFile($this->thumb,'product-image')
            :
            (new PathManager())->getDefaultPicture();
    }
}
