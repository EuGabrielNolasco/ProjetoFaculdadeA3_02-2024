<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'Recursos Humanos', 'description' => 'Responsável pela gestão de pessoal e recursos humanos.'],
            ['name' => 'TI', 'description' => 'Responsável pela infraestrutura de TI e suporte técnico.'],
            ['name' => 'Financeiro', 'description' => 'Gerencia contas, pagamentos, e outras atividades financeiras.'],
            ['name' => 'Operações', 'description' => 'Coordena as operações diárias da empresa.'],
            ['name' => 'Marketing', 'description' => 'Gerencia campanhas e estratégias de marketing.'],
        ]);
    }
}
