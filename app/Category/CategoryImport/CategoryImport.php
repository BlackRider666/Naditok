<?php

namespace App\Category\CategoryImport;

use App\Category\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryImport extends Model
{
    protected $table = 'category_imports';

    protected $fillable = [
        'cat_id',
        'out_id',
        'exporter',
    ];

    protected $casts = [
        'exporter'  =>  'select',
        'cat_id'    =>  'select',
        'out_id'    =>  'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }
}
