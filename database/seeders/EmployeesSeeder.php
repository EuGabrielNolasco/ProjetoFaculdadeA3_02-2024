<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve department IDs from the database
        $positions = DB::table('positions')->pluck('id');
        $departments = DB::table('departments')->pluck('id');

        // Define an array of real names
        $names = [
            'Ana Silva', 'João Pereira', 'Maria Oliveira', 'Carlos Souza', 'Fernanda Lima',
            'Lucas Rocha', 'Aline Mendes', 'Gustavo Alves', 'Cláudia Ramos', 'Paulo Moreira',
            'Camila Santos', 'Rafael Costa', 'Juliana Fernandes', 'Rodrigo Almeida', 'Mariana Farias',
            'Felipe Barbosa', 'Bianca Nunes', 'André Gonçalves', 'Larissa Martins', 'Ricardo Carvalho',
            'Vanessa Monteiro', 'Bruno Teixeira', 'Isabela Freitas', 'Thiago Lopes', 'Natália Araújo',
            'Marcelo Ribeiro', 'Renata Vieira', 'Fábio Duarte', 'Patrícia Campos', 'Diego Batista',
            'Tatiane Moraes', 'Igor Cruz', 'Cristina Souza', 'Leandro Torres', 'Letícia Antunes',
            'Vinícius Castro', 'Gabriela Borges', 'Hugo Mendes', 'Priscila Barreto', 'Caio Santana',
            'Carolina Almeida', 'Victor Ferreira', 'Elisa Monteiro', 'Murilo Machado', 'Érica Santana',
            'Henrique Silva', 'Tatiana Costa', 'Eduardo Rocha', 'Jéssica Melo', 'Pedro Fonseca'
        ];

        // Generate random phone numbers
        $employees = [];
        foreach ($names as $name) {
            $employees[] = [
                'name' => $name,
                'position_id' => $positions->random(),
                'department_id' => $departments->random(),
                'contact' => '84' . rand(900000000, 999999999),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert into the database
        DB::table('employees')->insert($employees);
    }
}
