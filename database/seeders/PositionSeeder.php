<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            ['name' => 'Analista de Recursos Humanos', 'responsibilities' => 'Gerenciar recrutamento e seleção de pessoal.'],
            ['name' => 'Desenvolvedor', 'responsibilities' => 'Desenvolver e manter sistemas e aplicações.'],
            ['name' => 'Analista Financeiro', 'responsibilities' => 'Gerenciar contas e relatórios financeiros.'],
            ['name' => 'Operador de Máquina', 'responsibilities' => 'Operar equipamentos e máquinas de produção.'],
            ['name' => 'Gerente de Marketing', 'responsibilities' => 'Planejar e executar campanhas de marketing.'],
        ]);
    }
}
