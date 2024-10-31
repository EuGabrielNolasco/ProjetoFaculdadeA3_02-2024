<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shifts')->insert([
            ['name' => 'Turno Matutino', 'start_time' => '08:00:00', 'end_time' => '12:00:00'],
            ['name' => 'Turno Vespertino', 'start_time' => '13:00:00', 'end_time' => '17:00:00'],
            ['name' => 'Turno Noturno', 'start_time' => '18:00:00', 'end_time' => '22:00:00'],
            ['name' => 'Turno Integral', 'start_time' => '08:00:00', 'end_time' => '18:00:00'],
        ]);
    }
}
