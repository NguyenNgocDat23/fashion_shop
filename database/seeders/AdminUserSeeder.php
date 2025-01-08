<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=AdminUserSeeder
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'phone' => '0989748659',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123@'),
            'avatar' => 'hinh-nen-3d-hinh-nen-iphone-dep-3d-didongviet@2x-576x1024.jpg',
            'role'=> 'admin',
        ]);
    }
}
