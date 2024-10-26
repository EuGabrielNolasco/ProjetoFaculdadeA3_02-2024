<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartamentosController extends Controller
{
    public function index(): View
    {
        return view('menus.departamentos.index');
    }
}
