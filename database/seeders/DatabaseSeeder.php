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
        DB::statement('ALTER posts DISABLE TRIGGER ALL;');
        $this->call(CatagorySeeder::class);
        $this->call(SubcategorieSeeder::class);
        DB::statement('ALTER posts DISABLE TRIGGER ALL;');
        
      

    }
}
