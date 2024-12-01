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
            ['name' => 'Vendas', 'description' => 'Responsável pela interação com clientes e vendas de produtos/serviços.'],
            ['name' => 'Jurídico', 'description' => 'Cuida das questões legais e jurídicas da empresa.'],
            ['name' => 'Logística', 'description' => 'Gerencia transporte, armazenamento e distribuição de produtos.'],
            ['name' => 'Pesquisa e Desenvolvimento', 'description' => 'Focado na inovação e criação de novos produtos.'],
            ['name' => 'Atendimento ao Cliente', 'description' => 'Oferece suporte e atendimento para clientes.'],
            ['name' => 'Qualidade', 'description' => 'Responsável pelo controle e garantia da qualidade dos produtos/serviços.'],
            ['name' => 'Planejamento Estratégico', 'description' => 'Define e monitora os objetivos estratégicos da organização.'],
            ['name' => 'Comunicação', 'description' => 'Gerencia a comunicação interna e externa da empresa.'],
            ['name' => 'Treinamento e Desenvolvimento', 'description' => 'Focado no desenvolvimento de habilidades dos colaboradores.'],
            ['name' => 'Segurança e Saúde', 'description' => 'Cuida da segurança e bem-estar dos funcionários no ambiente de trabalho.'],
        ]);
    }
}
