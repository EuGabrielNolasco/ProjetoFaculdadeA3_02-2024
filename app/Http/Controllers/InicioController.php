<?php

namespace App\Http\Controllers;

use App\Models\Model_departments;
use App\Models\Model_Employees;
use App\Models\Model_positions;
use App\Models\Model_schedules;
use App\Models\Model_shifits;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InicioController extends Controller
{
    public static function index():View
    {
        $departamentos = Model_departments::count();
        $turnos = Model_shifits::count();
        $funcionarios = Model_Employees::count();
        $cargos = Model_positions::count();
        $schedules = Model_schedules::with(['employee', 'shift'])->get();
        return view('welcome', compact('schedules', 'turnos', 'funcionarios', 'cargos', 'departamentos'));
    }
}
