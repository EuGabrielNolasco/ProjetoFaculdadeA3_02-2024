<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class EscalasController extends Controller
{
    public function index(): View
    {
        return view('menus.escalas.index');
    }
}
