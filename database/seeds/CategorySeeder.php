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
            'title_ru' =>  'Одежда и обувь',
            'slug'  =>  'odezhda-i-obuv'
        ]);
        Category::create([
            'title_ru'     =>  'Игрушки',
            'slug'      =>  'igrushki'
        ]);
        Category::create([
            'title_ru'     =>  'Детская комната',
            'slug'      =>  'detskaya-komnata'
        ]);
        Category::create([
            'title_ru'     =>  'Коляски и автокресла',
            'slug'      =>  'detskie-kolyaski'
        ]);
        Category::create([
            'title_ru'     =>  'Все для кормления',
            'slug'      =>  'vse-dlya-kormleniya'
        ]);
        Category::create([
            'title_ru'     =>  'Уход и гигиена',
            'slug'      =>  'uhod-i-gigiena'
        ]);
        Category::create([
            'title_ru'     =>  'Детский транспорт',
            'slug'      =>  'detskij-transport'
        ]);
        Category::create([
            'title_ru'     =>  'Детские аксессуары',
            'slug'      =>  'detskie-aksesuary'
        ]);

        Category::create([
            'title_ru'     =>  'Test',
            'parent_id' =>  1,
            'slug'      =>  'test_1'
        ]);
        Category::create([
            'title_ru'     =>  'Test',
            'parent_id' =>  2,
            'slug'      =>  'test_2'
        ]);
        Category::create([
            'title_ru'     =>  'Test',
            'parent_id' =>  3,
            'slug'      =>  'test_3'
        ]);
        Category::create([
            'title_ru'     =>  'Test',
            'parent_id' =>  4,
            'slug'      =>  'test_4'
        ]);
        Category::create([
            'title_ru'     =>  'Test',
            'parent_id' =>  5,
            'slug'      =>  'test_5'
        ]);
        Category::create([
            'title_ru'     =>  'Test',
            'parent_id' =>  6,
            'slug'      =>  'test_6'
        ]);
        Category::create([
            'title_ru'     =>  'Test',
            'parent_id' =>  7,
            'slug'      =>  'test_7'
        ]);
        Category::create([
            'title_ru'     =>  'Test',
            'parent_id' =>  8,
            'slug'      =>  'test_8'
        ]);
    }
}
