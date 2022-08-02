<?php

namespace Database\Seeders;

use App\Models\Activation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activation::create([
            'name' => 'TEL. VODA.'
        ]);
        Activation::create([
            'name' => 'TEL. TMN'
        ]);
        Activation::create([
            'name' => 'TEL. OPT'
        ]);
        Activation::create([
            'name' => 'CARD VODA'
        ]);
        Activation::create([
            'name' => 'CARD TMN'
        ]);
        Activation::create([
            'name' => 'CARD OPT'
        ]);
        Activation::create([
            'name' => 'UPG. VODA'
        ]);
        Activation::create([
            'name' => 'UPG. TMN'
        ]);
        Activation::create([
            'name' => 'UPG. OPT'
        ]);
    }
}
