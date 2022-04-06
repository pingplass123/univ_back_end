<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategories;

class SubcategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategories::truncate();

        $csvFile = fopen(public_path("../public/Seeders/sub_categories.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Subcategories::create([
                    "catagoriesID" => $data['1'],
                    "sub_name" => $data['2'],
                    "description" => $data['3'],
                    "urlPhoto" => $data['4'],
                   
                    
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
