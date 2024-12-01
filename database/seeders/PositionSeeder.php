<?php

namespace Database\Seeders;

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
            ['name' => 'Assistente Administrativo', 'responsibilities' => 'Dar suporte administrativo e organizacional.'],
            ['name' => 'Coordenador de Projetos', 'responsibilities' => 'Gerenciar e coordenar projetos da empresa.'],
            ['name' => 'Técnico de Suporte', 'responsibilities' => 'Fornecer suporte técnico e resolver problemas de TI.'],
            ['name' => 'Designer Gráfico', 'responsibilities' => 'Criar materiais visuais e gráficos para a empresa.'],
            ['name' => 'Engenheiro de Produção', 'responsibilities' => 'Supervisionar e melhorar os processos de produção.'],
            ['name' => 'Analista de Dados', 'responsibilities' => 'Interpretar e analisar dados para suporte à decisão.'],
            ['name' => 'Consultor de Vendas', 'responsibilities' => 'Apoiar clientes e fechar vendas.'],
            ['name' => 'Arquiteto de Software', 'responsibilities' => 'Projetar soluções e arquiteturas de sistemas.'],
            ['name' => 'Gerente de Operações', 'responsibilities' => 'Supervisionar operações e otimizar processos.'],
            ['name' => 'Especialista em Logística', 'responsibilities' => 'Planejar e gerenciar transporte e estoque.'],
            ['name' => 'Analista de Comunicação', 'responsibilities' => 'Gerenciar estratégias de comunicação interna e externa.'],
            ['name' => 'Técnico de Segurança do Trabalho', 'responsibilities' => 'Garantir conformidade com normas de segurança.'],
            ['name' => 'Advogado', 'responsibilities' => 'Prestar suporte jurídico e elaborar contratos.'],
            ['name' => 'Gerente de Produto', 'responsibilities' => 'Desenvolver e gerenciar o ciclo de vida do produto.'],
            ['name' => 'Especialista em UX/UI', 'responsibilities' => 'Criar interfaces intuitivas e experiências de usuário.'],
        ]);
    }
}
