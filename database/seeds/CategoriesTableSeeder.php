<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['id' => 1, 'name' => 'Мобильные телефоны', 'code' => 'mobiles', 'description' => 'В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!', 'image' => 'categories/mobile.jpeg', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Портативная техника', 'code' => 'portable',  'description' => 'Раздел с портативной техникой', 'image' => 'categories/portable.jpeg', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Бытовая техника', 'code' => 'appliances', 'description' => 'Раздел с бытовой техникой', 'image' => 'categories/appliance.jpeg', 'created_at'=>now(), 'updated_at'=>now()],
        ]);

    }
}
