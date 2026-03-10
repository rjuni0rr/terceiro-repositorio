<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {

        Task::create([
            'user_id' => 1,
            'category_id' => 1,
            'name' => 'Finalizar relatório',
            'description' => 'Enviar relatório para o gerente',
            'urgency' => 'high'
        ]);

        Task::create([
            'user_id' => 1,
            'category_id' => 2,
            'name' => 'Estudar Laravel',
            'description' => 'Revisar migrations e controllers',
            'urgency' => 'medium'
        ]);

        Task::create([
            'user_id' => 2,
            'category_id' => 4,
            'name' => 'Comprar mantimentos',
            'description' => 'Ir ao supermercado',
            'urgency' => 'low'
        ]);

    }
}
