<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Catagory;

class CatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Catagory::create([
            'name' => 'Design',
            'id' => '1'
        ]);
        Catagory::create([
            'name' => 'Development',
            'id' => '2'
        ]);
        Catagory::create([
            'name' => 'Marketing',
            'id' => '3'
        ]);
        Catagory::create([
            'name' => 'IT and Software',
            'id' => '4'
        ]);
        Catagory::create([
            'name' => 'Personal Development',
            'id' => '5'
        ]);
        Catagory::create([
            'name' => 'Business',
            'id' => '6'
        ]);
        Catagory::create([
            'name' => 'Photography',
            'id' => '7'
        ]);
        Catagory::create([
            'name' => 'Music',
            'id' => '8'
        ]);


    }
}
