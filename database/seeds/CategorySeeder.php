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
            'title' =>  'Одежда и обувь',
        ]);
        Category::create([
            'title'     =>  'Игрушки',
        ]);
        Category::create([
            'title'     =>  'Детская комната',
        ]);
        Category::create([
            'title'     =>  'Коляски и автокресла',
        ]);
        Category::create([
            'title'     =>  'Все для кормления',
        ]);
        Category::create([
            'title'     =>  'Уход и гигиена',
        ]);
        Category::create([
            'title'     =>  'Детский транспорт',
        ]);
        Category::create([
            'title'     =>  'Детские аксессуары',
        ]);

        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  1,
        ]);
        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  2,
        ]);
        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  3,
        ]);
        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  4,
        ]);
        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  5,
        ]);
        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  6,
        ]);
        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  7,
        ]);
        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  8,
        ]);

        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  9,
        ]);
        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  10,
        ]);
        Category::create([
            'title'     =>  'Test',
            'parent_id' =>  11,
        ]);
    }
}
