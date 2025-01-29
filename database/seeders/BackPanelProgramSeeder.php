<?php

namespace Database\Seeders;

use App\Models\BackPanel\Program;
use App\Models\Product;
use Illuminate\Database\Seeder;

class BackPanelProgramSeeder extends Seeder
{
    public function run()
    {
        Program::factory()->count(10)->create();
    }
}