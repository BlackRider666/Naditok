<?php

namespace App\Category;

use App\Core\PathManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'title',
        'parent_id',
        'thumb',
        'out_id',
    ];

    protected $casts = [
        'title'       =>  'string',
        'parent_id'   =>  'select',
        'thumb'       =>  'image',
    ];

    protected $appends = [
        'thumb_url',
    ];

    protected $with = 'child';

    public function getThumbUrlAttribute(): string
    {
        return $this->thumb?
            (new PathManager())->getFile($this->thumb,'category')
            :
            (new PathManager())->getDefaultPicture();
    }

    public function child()
    {
        return $this->hasMany($this,'parent_id');
    }
}
