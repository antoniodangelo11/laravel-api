<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypesTableSeeder extends Seeder
{
    public function run()
    {
        foreach(config('types') as $objType) {
            // $objType['slug'] = Type::slugger($objType['name']);
            Type::create($objType);
        }
    }
}
