<?php

namespace App\Category\CategoryImport;

use Illuminate\Database\Eloquent\Model;

class CategoryImport extends Model
{
    protected $table = 'category_imports';

    protected $fillable = [
        'category_id',
        'out_id',
        'exporter',
    ];
}
