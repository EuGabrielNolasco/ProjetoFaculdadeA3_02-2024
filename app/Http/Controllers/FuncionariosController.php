<?php

namespace App\Http\Controllers;

use App\Models\model_Employees;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class FuncionariosController extends Controller
{
    public function index(): View
    {
        return view('menus.funcionarios.index');
    }

    public function getData(Request $request): Object
    {
        $totalData = 0;
        $totalFiltered = 0;
        $data = [];

        DB::beginTransaction();
        try {
            $search = $request->input('search.value');

            // Inicializa uma query vazia para o modelo `Model_bxemp`
            $query = model_Employees::query();

            // Verifica se o valor de pesquisa é uma data válida

            $query = model_Employees::obterFuncionarios($search);



            // Contagem total de registros
            $totalData = $query->count();
            // Parâmetros de paginação
            $start = $request->input('start', 0);
            $length = $request->input('length', 10);

            // Aplica paginação
            $query = $query->skip($start)->take($length);
            $totalFiltered = $totalData;

            // Define as colunas disponíveis para ordenação
            $columns = [
                'nome',
                'departamento',
                'contato',
                'descricao'

            ];

            // Ordenação dos dados
            $orderColumnIndex = $request->input('order.0.column') == 0 ? 0 : $request->input('order.0.column');
            $orderColumn = $columns[$orderColumnIndex];
            $orderDir = $request->input('order.0.dir', 'asc') === 'desc' ? 'asc' : 'desc';

            // Aplica ordenação à query
            $query = $query->orderBy($orderColumn, $orderDir);

            // Executa a consulta para obter dados paginados
            $data = $query->get()->map(function ($dado) {
                return [
                    'nome' => $dado->nome,
                    'departamento' => $dado->departamento,
                    'contato' => $dado->contato,
                    'descricao' => $dado->descricao
                ];
            });

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('DataTables error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error.']);
        } finally {
            DB::disconnect();
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data->toArray(),
        ]);
    }
}
