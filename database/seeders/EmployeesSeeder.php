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

        // Insert 50 employees with random departments and positions
        for ($i = 1; $i <= 10; $i++) {
            DB::table('employees')->insert([
                'name' => 'Funcionário ' . $i,
                'position_id' => $positions->random(),
                'department_id' => $departments->random(),
                'contact' => '123-456-7890', // Example contact
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
