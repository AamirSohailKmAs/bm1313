<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'TELEMÓVEL'
        ]);
        Product::create([
            'name' => 'REPAIR'
        ]);
        Product::create([
            'name' => 'SOFTWARE'
        ]);
        Product::create([
            'name' => 'ACCESSORIOS'
        ]);
        Product::create([
            'name' => 'CARD'
        ]);
        Product::create([
            'name' => 'OTHER'
        ]);
    }
}
