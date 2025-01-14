<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_settings')->insert([
            'name' => 'Smart School',
            'email' => 'abc@gmail.com',
            'phone_number' => '9800000000',
            'address' => 'kathmandu',
            'link_facebook' => null,
            'link_instagram' => null,
            'link_twitter' => null,
            'link_map' => null,
            'img_logo' => null,
            'img_favicon' => null,
            'homepage_title' => null,
            'hmaepage_description' => null,
            'img_banner_homepage' => null
        ]);
    }
}
