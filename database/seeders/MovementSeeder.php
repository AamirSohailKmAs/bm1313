<?php

namespace Database\Seeders;

use App\Models\Movement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movement::create([
            'name' => 'SALARIES'
        ]);
        Movement::create([
            'name' => 'RENT'
        ]);
        Movement::create([
            'name' => 'SEG. SOCIAL / ACOUNTANT'
        ]);
        Movement::create([
            'name' => 'BILLS'
        ]);
        Movement::create([
            'name' => 'TRANSPORT/ FUEL/ TICKETS'
        ]);
        Movement::create([
            'name' => 'LUNCH/DRINKS'
        ]);
        Movement::create([
            'name' => 'BOX/CABLES/LOGS'
        ]);
        Movement::create([
            'name' => 'PRINTING MATERIAL'
        ]);
        Movement::create([
            'name' => 'VINOD / FAISAL / NIKKA'
        ]);
        Movement::create([
            'name' => 'BANK DEPOSIT'
        ]);
        Movement::create([
            'name' => 'OTHERS'
        ]);
    }
}
