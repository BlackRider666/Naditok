<?php

namespace App\Brand;

use App\Core\PathManager;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'title',
        'thumb',
    ];

    protected $casts = [
        'title'       =>  'string',
        'thumb'       =>  'image',
    ];

    protected $appends = [
        'thumb_url',
    ];
    public function getThumbUrlAttribute(): string
    {
        return $this->thumb?
            (new PathManager())->getFile($this->thumb,'brand')
            :
            (new PathManager())->getDefaultPicture();
    }
}
