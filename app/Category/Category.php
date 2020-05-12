<?php

namespace App\Category;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'title',
        'parent_id',
    ];

    protected $casts = [
      'title'       =>  'string',
      'parent_id'   =>  'select'
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

