<?php

namespace App\Category;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'title',
        'parent_id',
        'thumb',
    ];

    protected $casts = [
        'title'       =>  'string',
        'parent_id'   =>  'select',
        'thumb'       =>  'image',
    ];
    public function child()
    {
        return $this->hasMany($this,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo($this,'parent_id');
    }
}

