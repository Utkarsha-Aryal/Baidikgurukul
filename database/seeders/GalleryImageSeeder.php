<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GalleryImageSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('gallery_images')->insert([
                'gallery_id' => [3, 6][array_rand([3, 6])],
                'image' => 'image_' . $i . '.jpg',
                'image_link' => 'https://example.com/images/image_' . $i . '.jpg',
                'status' => (rand(0, 1) ? 'Y' : 'N'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
