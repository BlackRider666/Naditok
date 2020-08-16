<?php

use App\Category\CategoryImport\CategoryImport;
use Illuminate\Database\Seeder;

class ImportTorgSoftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryImport::create([
            'cat_id'  => 32,
            'out_id'    =>  41,
        ]);
        CategoryImport::create([
            'cat_id'  => 33,
            'out_id'    =>  4105,
        ]);
        CategoryImport::create([
            'cat_id'  => 34,
            'out_id'    =>  40,
        ]);
        CategoryImport::create([
            'cat_id'  => 35,
            'out_id'    =>  42,
        ]);
        CategoryImport::create([
            'cat_id'  => 36,
            'out_id'    =>  43,
        ]);
        CategoryImport::create([
            'cat_id'  => 10,
            'out_id'    =>  11,
        ]);
        CategoryImport::create([
            'cat_id'  => 37,
            'out_id'    =>  1102,
        ]);
        CategoryImport::create([
            'cat_id'  => 38,
            'out_id'    =>  1101,
        ]);
        CategoryImport::create([
            'cat_id'  => 36,
            'out_id'    =>  43,
        ]);
        CategoryImport::create([
            'cat_id'  => 11,
            'out_id'    =>  8803,
        ]);
        CategoryImport::create([
            'cat_id'  => 11,
            'out_id'    =>  8805,
        ]);
        CategoryImport::create([
            'cat_id'  => 36,
            'out_id'    =>  43,
        ]);
        CategoryImport::create([
            'cat_id'  => 45,
            'out_id'    =>  3304,
        ]);
        CategoryImport::create([
            'cat_id'  => 46,
            'out_id'    =>  3301,
        ]);
        CategoryImport::create([
            'cat_id'  => 51,
            'out_id'    =>  4806,
        ]);
        CategoryImport::create([
            'cat_id'  => 52,
            'out_id'    =>  29,
        ]);
        CategoryImport::create([
            'cat_id'  => 24,
            'out_id'    =>  32,
        ]);
    }
}
