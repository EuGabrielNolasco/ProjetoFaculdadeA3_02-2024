<?php

namespace App\Http\Controllers;

use App\Models\Model_departments;
use App\Models\Model_Employees;
use App\Models\Model_positions;
use App\Models\Model_schedules;
use App\Models\Model_shifits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EscalasController extends Controller
{
    /**
     * Exibe as escalas de todos os funcionários.
     */
    public function index(): View
    {
        $departamentos = Model_departments::count();
        $turnos = Model_shifits::count();
        $funcionarios = Model_Employees::count();
        $cargos = Model_positions::count();
        $schedules = Model_schedules::with(['employee', 'shift'])->get();
        return view('menus.escalas.index', compact('schedules','turnos','funcionarios','cargos','departamentos'));
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

            $query = Model_schedules::obterEscalas($search);



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
    public function generate(Request $request)
    {
        $request->validate([
            'period_type' => 'required|in:weekly,biweekly,monthly,quarterly',
        ]);

        $periodType = $request->period_type;
        $days = match ($periodType) {
            'weekly' => 7,
            'biweekly' => 14,
            'monthly' => 30,
            'quarterly' => 90,
            default => throw new \InvalidArgumentException("Tipo de período inválido."),
        };

        $startDate = Carbon::now();
        $holidays = $this->getHolidays(); // Suposição de função para obter feriados

        // Obter todos os funcionários
        $employees = Model_Employees::all();

        foreach ($employees as $employee) {
            // Tenta buscar uma escala existente para o funcionário
            $existingSchedule = Model_schedules::where('employee_id', $employee->id)
                ->orderBy('end_date', 'desc')
                ->first();

            if ($existingSchedule) {
                // Inicia a partir do dia seguinte ao último dia da escala existente
                $currentDate = Carbon::parse($existingSchedule->end_date)->addDay();
                $scheduledDays = json_decode($existingSchedule->days, true);
            } else {
                // Se não existir uma escala anterior, inicia a partir da data atual
                $currentDate = $startDate->copy();
                $scheduledDays = [];
            }

            $daysScheduled = 0;

            while ($daysScheduled < $days) {
                // Verifica se é fim de semana ou feriado
                if (!$this->isWeekendOrHoliday($currentDate, $holidays)) {
                    // Adiciona o dia à escala do funcionário com 8 horas de trabalho
                    $scheduledDays[] = [
                        'date' => $currentDate->toDateString(),
                        'hours' => 8,
                    ];
                    $daysScheduled++;
                }

                // Avança para o próximo dia
                $currentDate->addDay();
            }

            // Atualiza ou cria a escala para o funcionário
            if ($existingSchedule) {
                // Atualiza o campo `days` e a `end_date` na escala existente
                $existingSchedule->update([
                    'days' => json_encode($scheduledDays),
                    'end_date' => $currentDate->subDay()->toDateString(), // Ajusta para o último dia da escala
                ]);
            } else {
                // Cria uma nova escala para o funcionário
                Model_schedules::create([
                    'employee_id' => $employee->id,
                    'shift_id' => $this->getDefaultShiftId(), // Ajuste para seu turno padrão
                    'period_type' => $periodType,
                    'start_date' => $startDate->toDateString(),
                    'end_date' => $currentDate->subDay()->toDateString(),
                    'days' => json_encode($scheduledDays),
                ]);
            }
        }

        return response()->json(['message' => 'Escalas geradas com sucesso!'], 201);
    }

    // Função para verificar se é fim de semana ou feriado
    private function isWeekendOrHoliday(Carbon $date, array $holidays): bool
    {
        return $date->isWeekend() || in_array($date->toDateString(), $holidays);
    }

    // Função para obter feriados (substitua com sua lógica de feriados)
    private function getHolidays(): array
    {
        return [
            '2024-01-01', // Exemplo de feriados
            '2024-12-25',
            // Adicione outros feriados aqui
        ];
    }

    // Função para obter um turno padrão (ajuste conforme sua lógica)
    private function getDefaultShiftId()
    {
        // Exemplo: Retorna o ID de um turno padrão, ajuste conforme necessário
        return Model_shifits::first()->id ?? 1;
    }
}
