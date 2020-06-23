<?php

namespace App\Discount;

use App\Core\PathManager;
use App\ProductGroup\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $fillable = [
        'title',
        'thumb',
        'size',
        'type',
        'start',
        'finish'
    ];

    protected $casts = [
        'title' =>  'string',
        'thumb' =>  'image',
        'size'  =>  'integer',
        'type'  =>  'select',
        'start' =>  'date',
        'finish'=>  'date',
    ];

    protected $appends = [
        'thumb_url',
    ];

    public function getThumbUrlAttribute(): string
    {
        return $this->thumb?
            (new PathManager())->getFile($this->thumb,'discount')
            :
            (new PathManager())->getDefaultPicture();
    }
    /**
     * @return hasMany
     */
    public function products(): hasMany
    {
        return $this->hasMany(Product::class);
    }
}
