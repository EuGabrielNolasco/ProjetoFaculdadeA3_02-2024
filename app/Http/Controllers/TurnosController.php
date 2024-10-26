<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class TurnosController extends Controller
{
    public function index(): View
    {
        return view('menus.turnos.index');
    }
}
