<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Trabalho',
            'Estudos',
            'Pessoal',
            'Saúde',
            'Finanças'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'is_system' => true
            ]);
        }
    }
}
