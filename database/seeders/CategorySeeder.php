<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {

        Category::create([
            'user_id' => 1,
            'name' => 'Trabalho'
        ]);

        Category::create([
            'user_id' => 1,
            'name' => 'Estudos'
        ]);

        Category::create([
            'user_id' => 1,
            'name' => 'Projetos'
        ]);

        Category::create([
            'user_id' => 2,
            'name' => 'Pessoal'
        ]);

    }
}
