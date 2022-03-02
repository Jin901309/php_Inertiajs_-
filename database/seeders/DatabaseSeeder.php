<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 관계형 데이터베이스면 가능
        \App\Models\User::factory(50)->hasProfile()->hasPosts(5)->create();
        // \App\Models\Comment::factory(2)->create();
    }
}
