<?php

namespace App\ProductGroup\ProductGroupComment;

use App\ProductGroup\ProductGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductGroupComment extends Model
{
    protected $table = 'product_group_comments';

    protected $fillable = [
        'product_group_id',
        'author',
        'comment',
        'rating',
    ];

    protected $casts = [
        'product_group_id'  =>  'select',
        'author'            =>  'string',
        'comment'           =>  'text',
        'rating'            =>  'float',
    ];

    /**
     * @return BelongsTo
     */
    public function productGroup(): BelongsTo
    {
        return $this->belongsTo(ProductGroup::class);
    }
}
