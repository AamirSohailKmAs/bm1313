<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'id' => 1,
            'name' => 'Samsung',
            'parent_id' => null,
        ]);
        Category::create([
            'id' => 2,
            'name' => 'APPLE',
            'parent_id' => null,
        ]);
        Category::create([
            'id' => 3,
            'name' => 'OPPO',
            'parent_id' => null,
        ]);
        Category::create([
            'id' => 4,
            'name' => 'Huawei',
            'parent_id' => null,
        ]);
        Category::create([
            'id' => 5,
            'name' => 'Redmi',
            'parent_id' => null,
        ]);
        Category::create([
            'id' => 6,
            'name' => 'WIKO',
            'parent_id' => null,
        ]);
        Category::create([
            'id' => 7,
            'name' => 'SONY ',
            'parent_id' => null,
        ]);
        Category::create([
            'id' => 8,
            'name' => 'ALCATEL',
            'parent_id' => null,
        ]);
        Category::create([
            'id' => 9,
            'name' => 'VIVO',
            'parent_id' => null,
        ]);
        Category::create([
            'id' => 10,
            'name' => 'Asus',
            'parent_id' => null,
        ]);
        Category::create([
            'id' => 11,
            'name' => 'BATRRY',
            'parent_id' => 2,
        ]);
        Category::create([
            'id' => 12,
            'name' => 'PHONE',
            'parent_id' => 2,
        ]);
        Category::create([
            'id' => 13,
            'name' => 'PHONE',
            'parent_id' => 3,
        ]);
        Category::create([
            'id' => 14,
            'name' => 'Huawei lcd',
            'parent_id' => 4,
        ]);
        Category::create([
            'id' => 15,
            'name' => ' Huawei lcd-Tablet',
            'parent_id' => 4,
        ]);
        Category::create([
            'id' => 16,
            'name' => 'Redmi lcd',
            'parent_id' => 5,
        ]);
        Category::create([
            'id' => 17,
            'name' => 'Xiaomi lcd',
            'parent_id' => 5,
        ]);
        Category::create([
            'id' => 18,
            'name' => 'Nokia Lcd',
            'parent_id' => 6,
        ]);
        Category::create([
            'id' => 19,
            'name' => 'SONY XPERIA',
            'parent_id' => 7,
        ]);
        Category::create([
            'id' => 20,
            'name' => 'ALCATEL',
            'parent_id' => 7,
        ]);
        Category::create([
            'id' => 21,
            'name' => 'A Serie',
            'parent_id' => 1,
        ]);
        Category::create([
            'id' => 22,
            'name' => 'S Serie',
            'parent_id' => 1,
        ]);
        Category::create([
            'id' => 23,
            'name' => 'J Serie',
            'parent_id' => 1,
        ]);
        Category::create([
            'id' => 24,
            'name' => 'Note Serie',
            'parent_id' => 1,
        ]);
        Category::create([
            'id' => 25,
            'name' => 'M Serie',
            'parent_id' => 1,
        ]);
        Category::create([
            'id' => 26,
            'name' => 'phone',
            'parent_id' => 4,
        ]);
    }
}
