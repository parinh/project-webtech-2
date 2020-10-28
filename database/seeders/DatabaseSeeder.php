<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() //การส้รางข้อมูลพื้นฐานเวลาใช้ครั้งแรกไรงี้
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class
        ]);
    }
}
