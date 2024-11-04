<?php

namespace App\Http\Controllers;

use App\Models\Model_departments;
use App\Models\model_Employees;
use App\Models\Model_positions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
                'descricao',
                'cargo',
                'responsabilidade',
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
                    'descricao' => $dado->descricao,
                    'cargo' => $dado->cargo,
                    'responsabilidade' => $dado->responsabilidade,
                    'acoes' => '
                        <a href="' . route('funcionarios.edit', $dado->id) . '" class="text-blue-500 hover:text-blue-700" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="' . route('funcionarios.destroy', $dado->id) . '" method="POST" style="display: inline;">
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
        $departments = Model_departments::all();
        $positions = Model_positions::all();

        return view('menus.funcionarios.create', compact('departments', 'positions'));
    }
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        if ($validator->fails()) {
            Log::error('Erro de validação: ', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        DB::beginTransaction();
        try {
            // Cria o novo funcionário
            model_Employees::create([
                'name' => $request->input('name'),
                'contact' => $request->input('contact'),
                'department_id' => $request->input('department_id'),
                'position_id' => $request->input('position_id'),
            ]);

            Log::info('Funcionário inserido com sucesso!');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Erro ao criar funcionário: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Erro ao criar o funcionário: ' . $e->getMessage());
        }
        return view('menus.funcionarios.index');
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Encontra o funcionário pelo ID e o exclui
            $funcionario = model_Employees::findOrFail($id);
            $funcionario->delete();

            DB::commit();

            // Retorna uma resposta de sucesso
            return redirect()->route('employees.index')->with('success', 'Funcionário excluído com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao excluir funcionário: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Erro ao excluir o funcionário.');
        }
    }
    public function edit($id)
    {
        // Busca o funcionário pelo ID
        $funcionario = model_Employees::findOrFail($id);
        $departments = Model_departments::all(); // Para exibir os departamentos na view
        $positions = Model_positions::all(); // Para exibir as posições na view

        return view('menus.funcionarios.edit', compact('funcionario', 'departments', 'positions'));
    }
    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // B    usca o funcionário pelo ID e atualiza os dados
            $funcionario = model_Employees::findOrFail($id);
            $funcionario->update([
                'name' => $request->input('name'),
                'contact' => $request->input('contact'),
                'department_id' => $request->input('department_id'),
                'position_id' => $request->input('position_id'),
            ]);

            DB::commit();

            // Redireciona com uma mensagem de sucesso
            return redirect()->route('funcionarios')->with('success', 'Funcionário atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao  atualizar funcionário: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Erro ao atualizar o funcionário.');
        }
    }
}
