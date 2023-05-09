<?php

namespace Database\Seeders;

use App\Models\Types;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ["Чорби","Салати","Веганска","Бургер","Оброк","Чорби","Домашни Производи"];

        foreach($types as $type){
            $addType = new Types();
            $addType->type_name = $type;
            $addType->save();
        }
    }
}
