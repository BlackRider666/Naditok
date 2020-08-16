<?php

namespace App\Category\CategoryImport;

use Illuminate\Database\Eloquent\Model;

class CategoryImport extends Model
{
    protected $table = 'category_imports';

    protected $fillable = [
        'cat_id',
        'out_id',
        'exporter',
    ];
}
