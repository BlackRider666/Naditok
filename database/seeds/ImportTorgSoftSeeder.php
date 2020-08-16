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
            'category_id'  => 32,
            'out_id'    =>  41,
        ]);
        CategoryImport::create([
            'category_id'  => 33,
            'out_id'    =>  4105,
        ]);
        CategoryImport::create([
            'category_id'  => 34,
            'out_id'    =>  40,
        ]);
        CategoryImport::create([
            'category_id'  => 35,
            'out_id'    =>  42,
        ]);
        CategoryImport::create([
            'category_id'  => 36,
            'out_id'    =>  43,
        ]);
    }
}
