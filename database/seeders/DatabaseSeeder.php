<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE {$posts} RESTART IDENTITY CASCADE");
        $this->call(CatagorySeeder::class);
        $this->call(SubcategorieSeeder::class);

        
      

    }
}
