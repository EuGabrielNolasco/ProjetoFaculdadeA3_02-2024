<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::factory()->create([
            'name' => 'Gabriel Nolasco',
            'email' => 'teste@teste.com',
            'password' => Hash::make('testeteste'), 
        ]);


        $this->call([
            DepartmentSeeder::class,
            PositionSeeder::class,
            ShiftSeeder::class,
            EmployeesSeeder::class,
        ]);
    }
}
