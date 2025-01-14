<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_us')->insert(['introduction' => "About us.",
            'aboutus_title' => 'About us',
            'introduction' => 'Introduction',
            'img_introduction' => '',
            'img_introduction' => '',
            'mission' => "Mission.",
            'vision' => "vision.",
            'goals' => "goals.",
        ]);
    }
}
