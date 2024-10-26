<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class RelatoriosController extends Controller
{
    public function index(): View
    {
        return view('menus.relatorios.index');
    }
}
