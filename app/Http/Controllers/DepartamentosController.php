<?php

namespace App\Http\Controllers;

use App\Models\Model_departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class DepartamentosController extends Controller
{
    public function index(): View
    {
        return view('menus.departamentos.index');
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
            $query = Model_departments::query();

            // Verifica se o valor de pesquisa é uma data válida

            $query = Model_departments::obterDepartments($search);



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
                'description'
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
                    'description' => $dado->description,
                    'acoes' => '
                        <a href="' . route('departamentos.edit', $dado->id) . '" class="text-blue-500 hover:text-blue-700" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="' . route('departamentos.destroy', $dado->id) . '" method="POST" style="display: inline;">
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
        return view('menus.departamentos.create');
    }
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            Log::error('Erro de validação: ', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        DB::beginTransaction();
        try {
            // Cria o novo departamento
            Model_departments::create([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);

            Log::info('Departamento inserido com sucesso!');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            log::error('Erro ao criar departamento: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Erro ao criar o departamento: ' . $e->getMessage());
        }
        return view('menus.departamentos.index');
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Encontra o Departamento pelo ID e o exclui
            $departamentos = Model_departments::findOrFail($id);
            $departamentos->delete();

            DB::commit();

            // Retorna uma resposta de sucesso
            return redirect()->route('departamentos.index')->with('success', 'Departamento excluído com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao excluir Departamento: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Erro ao excluir o Departamento.');
        }
    }
    public function edit($id)
    {
        // Busca o departamento pelo ID
        $departamentos = Model_departments::findOrFail($id);

        return view('menus.departamentos.edit', compact('departamentos'));
    }
    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Busca o departamento pelo ID e atualiza os dados
            $departamentos = Model_departments::findOrFail($id);
            $departamentos->update([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);

            DB::commit();

            // Redireciona com uma mensagem de sucesso
            return redirect()->route('departamentos')->with('success', 'Departamento atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            log::error('Erro ao  atualizar Departamento: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Erro ao atualizar o Departamento.');
        }
    }
}
