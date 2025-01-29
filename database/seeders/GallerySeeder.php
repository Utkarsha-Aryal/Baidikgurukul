<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('galleries')->insert([
                'name' => 'Gallery ' . ($i + 1),
                'image' => 'gallery_' . ($i + 1) . '.jpg',
                'slug' => Str::slug('Gallery ' . ($i + 1)),
                'status' => (rand(0, 1) ? 'Y' : 'N'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}