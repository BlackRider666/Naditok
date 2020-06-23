<?php

namespace App\Discount;

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

    /**
     * @return hasMany
     */
    public function products(): hasMany
    {
        return $this->hasMany(Product::class);
    }
}
