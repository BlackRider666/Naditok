<?php

namespace App\Users\UserComparison;

use App\ProductGroup\Product\Product;
use App\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserComparison extends Model
{
    protected $table = 'user_comparisons';

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    protected $with = [
        'product'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
