<?php

namespace App\Users\UserChild;

use App\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserChild extends Model
{
    protected $table = 'user_children';

    protected $fillable = [
        'name',
        'gender',
        'birthday',
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
