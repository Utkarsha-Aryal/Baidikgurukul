<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'address' => 'Kathmandu, Nepal',
                'image' => '',
                'password' => Hash::make('password'),
                'user_role' => 'super'
            ],
            // [
            //     'name' => 'Normal Admin',
            //     'email' => 'user@admin.com',
            //     'address' => 'Kathmandu, Nepal',
            //     'image' => '',
            //     'password' => Hash::make('password'),
            //     'user_role' => 'normal'
            // ]
        ]);
    }
}
