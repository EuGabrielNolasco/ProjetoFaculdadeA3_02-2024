<?php

namespace App\Http\Controllers;

use App\Models\Model_shifits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class TurnosController extends Controller
{
    public function index(): View
    {
        return view('menus.turnos.index');
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
            $query = Model_shifits::query();

            // Verifica se o valor de pesquisa é uma data válida

            $query = Model_shifits::obterShifts($search);

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
                'id',
                'name',
                'start_time',
                'end_time'
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
                    'id' => $dado->id,
                    'name' => $dado->name,
                    'start_time' => Carbon::parse($dado->start_time)->translatedFormat('H \h\o\r\a\s \e i \m\i\n\u\t\o\s'),
                    'end_time' => Carbon::parse($dado->end_time)->translatedFormat('H \h\o\r\a\s \e i \m\i\n\u\t\o\s'),
                    'acoes' => '
                        <a href="' . route('turnos.edit', $dado->id) . '" class="text-blue-500 hover:text-blue-700" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="' . route('turnos.destroy', $dado->id) . '" method="POST" style="display: inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm(\'Tem certeza que deseja excluir?\')" title="Excluir">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    ',

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
    public function create()
    {
        return view('menus.turnos.create');
    }
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            Log::error('Erro de validação: ', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        DB::beginTransaction();
        try {
            // Cria o novo turno
            Model_shifits::create([
                'name' => $request->input('name'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time')

            ]);

            Log::info('turno inserido com sucesso!');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            log::error('Erro ao criar turno: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Erro ao criar o turno: ' . $e->getMessage());
        }
        return view('menus.turnos.index');
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Encontra o Turno pelo ID e o exclui
            $turnos = Model_shifits::findOrFail($id);
            $turnos->delete();

            DB::commit();

            // Retorna uma resposta de sucesso
            return redirect()->route('turnos')->with('success', 'Turno excluído com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao excluir Turno: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Erro ao excluir o Turno.');
        }
    }
    public function edit($id)
    {
        // Busca o Turno pelo ID
        $turnos = Model_shifits::findOrFail($id);

        return view('menus.turnos.edit', compact('turnos'));
    }
    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Busca o Turno pelo ID e atualiza os dados
            $turnos = Model_shifits::findOrFail($id);
            $turnos->update([
                'name' => $request->input('name'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time')
            ]);

            DB::commit();

            // Redireciona com uma mensagem de sucesso
            return redirect()->route('turnos')->with('success', 'Turno atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar Turno: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Erro ao atualizar o Turno.');
        }
    }
}
