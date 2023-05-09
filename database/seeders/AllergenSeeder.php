<?php

namespace Database\Seeders;

use App\Models\Allergens;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allergens = ["Jатки","Риба","Лактоза","Глутен","Соја","Чоколадо","Пченица", "Мед", "Морско"];

        foreach($allergens as $allergen){
            $addAllergen = new Allergens();
            $addAllergen->allergen_name = $allergen;
            $addAllergen->save();
        }
    }
}
