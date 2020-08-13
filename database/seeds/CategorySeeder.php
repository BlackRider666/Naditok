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
            'title_ru'     =>  'Боди и человечки',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Верхняя одежда',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Пеленки для новорожденных',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Рукавицы',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Носки и пинетки',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Комплекты и костюмы',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Головные уборы',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Платья и юбки',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Колготки,носки,леггинсы',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Рубашки и свитера',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Штаны и джинсы',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Нижнее белье',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Купальники и плавки',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Спортивная одежда',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Костюмы на праздник',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Школьная форма',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Обувь детская',
            'parent_id' =>  1,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Постельные принадлежности для детей',
            'parent_id' =>  3,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Слюнявчики',
            'parent_id' =>  5,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Соски',
            'parent_id' =>  5,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Пустышки',
            'parent_id' =>  5,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Бутылочки',
            'parent_id' =>  5,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Детская посуда',
            'parent_id' =>  5,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Боди',
            'parent_id' =>  9,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Песочники',
            'parent_id' =>  9,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Человечки',
            'parent_id' =>  9,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Ползунки',
            'parent_id' =>  9,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Распашонки',
            'parent_id' =>  9,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Конверты',
            'parent_id' =>  10,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Комбинезоны',
            'parent_id' =>  10,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Полукомбинезоны',
            'parent_id' =>  10,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Куртки',
            'parent_id' =>  10,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Пальто',
            'parent_id' =>  10,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Жилетки',
            'parent_id' =>  10,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Бомберы',
            'parent_id' =>  10,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Зимние комплекты',
            'parent_id' =>  10,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Царапки',
            'parent_id' =>  12,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Рукавички',
            'parent_id' =>  12,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Детские перчатки',
            'parent_id' =>  12,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Рукавицы',
            'parent_id' =>  12,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Краги',
            'parent_id' =>  12,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Носочки',
            'parent_id' =>  13,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Пинетки',
            'parent_id' =>  13,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Колготки',
            'parent_id' =>  13,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Одежда для крещения',
            'parent_id' =>  14,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Одежда на выписку',
            'parent_id' =>  14,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Шапочки',
            'parent_id' =>  15,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Чепчики',
            'parent_id' =>  15,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Комплекты',
            'parent_id' =>  15,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Шапки',
            'parent_id' =>  15,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Панамки',
            'parent_id' =>  15,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Шарфики',
            'parent_id' =>  15,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Кепки',
            'parent_id' =>  15,
            'slug'      =>  ''
        ]);


        Category::create([
            'title_ru'     =>  'Платья',
            'parent_id' =>  16,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Нарядные комплекты',
            'parent_id' =>  16,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Сарафаны',
            'parent_id' =>  16,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Юбки',
            'parent_id' =>  16,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Комплекты с юбками',
            'parent_id' =>  16,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Носки',
            'parent_id' =>  17,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Леггинсы',
            'parent_id' =>  17,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Колготки',
            'parent_id' =>  17,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Кофты',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Кардиганы',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Джемпер',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Регланы',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Футболки',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Свитеры',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Болеро',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Рубашки',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Блузки',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Туники',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Гольфы',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Свитшоты',
            'parent_id' =>  18,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Штаны',
            'parent_id' =>  19,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Джинсы',
            'parent_id' =>  19,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Шорты',
            'parent_id' =>  19,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Бриджи',
            'parent_id' =>  19,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Комплекты со штанами',
            'parent_id' =>  19,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Майки',
            'parent_id' =>  20,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Трусики',
            'parent_id' =>  20,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Комплекты белья',
            'parent_id' =>  20,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Пижамы',
            'parent_id' =>  20,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Купальники',
            'parent_id' =>  21,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Плавки',
            'parent_id' =>  21,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Костюмы',
            'parent_id' =>  22,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Штаны',
            'parent_id' =>  22,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Кофты',
            'parent_id' =>  22,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Новогодние костюмы',
            'parent_id' =>  23,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Костюмы на хеллоуин',
            'parent_id' =>  23,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Блузки',
            'parent_id' =>  24,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Рубашки',
            'parent_id' =>  24,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Сарафаны',
            'parent_id' =>  24,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Юбки',
            'parent_id' =>  24,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Брюки',
            'parent_id' =>  24,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Костюмы',
            'parent_id' =>  24,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Кардиганы',
            'parent_id' =>  24,
            'slug'      =>  ''
        ]);

        Category::create([
            'title_ru'     =>  'Кроссовки',
            'parent_id' =>  25,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Туфли',
            'parent_id' =>  25,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Сапоги',
            'parent_id' =>  25,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Ботинки',
            'parent_id' =>  25,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Босоножки',
            'parent_id' =>  25,
            'slug'      =>  ''
        ]);
        Category::create([
            'title_ru'     =>  'Тапочки',
            'parent_id' =>  25,
            'slug'      =>  ''
        ]);
    }
}
