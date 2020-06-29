<?php

namespace App\Users;

use App\Core\PathManager;
use App\Order\Order;
use App\Shipment\Shipment;
use App\Users\UserAddress\UserAddress;
use App\Users\UserChild\UserChild;
use App\Users\UserFavorite\UserFavorite;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'admin',
        'avatar',
        'subscribe',
    ];

    protected $appends = [
        'full_name',
        'avatar_url',
    ];

    protected $with = ['address','children'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name'    => 'string',
        'last_name'     => 'string',
        'email'         => 'email',
        'password'      => 'password',
        'password_confirmation' =>  'password',
        'phone'                 =>  'phone',
        'admin'                 =>  'boolean',
        'avatar'                =>  'image',
    ];

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(UserChild::class);
    }

    /**
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(UserAddress::class);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * @return string
     */
    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar?
            (new PathManager())->getFile($this->avatar,'user_avatar')
            :
            (new PathManager())->getDefaultPicture();
    }

    /**
     * @return HasMany
     */
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    /**
     * @return HasMany
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(UserFavorite::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
