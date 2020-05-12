<?php

use App\Category\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' =>  'test',
        ]);

        Category::create([
            'title'     =>  'test_sub1',
            'parent_id' =>  1,
        ]);

        Category::create([
            'title'     =>  'test_sub2',
            'parent_id' =>  1,
        ]);

        Category::create([
            'title'     =>  'test_sub_sub3',
            'parent_id' =>  2,
        ]);
    }
}
