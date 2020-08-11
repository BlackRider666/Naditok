<?php

namespace App\Category;

use App\Core\PathManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'title_ru',
        'title_ua',
        'parent_id',
        'thumb',
        'out_id',
        'desc_ru',
        'desc_ua',
        'slug',
    ];

    protected $casts = [
        'title_ru'      =>  'string',
        'title_ua'      =>  'string',
        'parent_id'     =>  'select',
        'thumb'         =>  'image',
        'desc_ru'       =>  'text',
        'desc_ua'       =>  'text',
        'slug'          =>  'string',
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
