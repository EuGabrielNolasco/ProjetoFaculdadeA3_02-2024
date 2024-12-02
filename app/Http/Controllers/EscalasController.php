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
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class EscalasController extends Controller
{
    public function index(): View
    {
        $departamentos = Model_departments::count();
        $turnos = Model_shifits::count();
        $funcionarios = Model_Employees::count();
        $cargos = Model_positions::count();
        $schedules = Model_schedules::with(['employee', 'shift'])->get();
        return view('menus.escalas.index', compact('schedules', 'turnos', 'funcionarios', 'cargos', 'departamentos'));
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
                'funcionario',
                'turno',
                'primeiro_dia',
                'ultimo_dia',
                'contato',
                'departamento',
                'cargo',
                'id_funcionario'
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
                    'funcionario' => $dado->funcionario,
                    'turno' => $dado->turno,
                    'primeiro_dia' => Carbon::parse($dado->primeiro_dia)->format('d/m/Y'),
                    'ultimo_dia' => Carbon::parse($dado->ultimo_dia)->format('d/m/Y'),
                    'data-detalhes' => json_decode($dado->dias, true), // Certifique-se de que está convertendo corretamente
                    'contato' => $dado->contato,
                    'departamento' => $dado->departamento,
                    'cargo' => $dado->cargo,
                    'id_funcionario' => $dado->id_funcionario
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
        try {
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

            // Busca de feriados
            $holidays = $this->getHolidays();
            $holidays = is_array($holidays) ? collect($holidays) : $holidays;
            $holidays = $holidays ?? collect([]);

            \Log::info('Iniciando geração de escalas');

            // Obter todos os funcionários
            $employees = Model_Employees::all();
            if ($employees->isEmpty()) {
                \Log::warning('Nenhum funcionário encontrado');
                return response()->json(['message' => 'Nenhum funcionário encontrado'], 400);
            }

            // Busca todos os turnos disponíveis
            $availableShifts = Model_shifits::all();
            if ($availableShifts->isEmpty()) {
                \Log::error('Nenhum turno disponível');
                return response()->json(['message' => 'Nenhum turno disponível'], 400);
            }

            $generatedSchedules = [];

            foreach ($employees as $employee) {
                $currentDate = $startDate->copy();
                $lastDayOff = null;
                $scheduledDays = [];
                $daysScheduled = 0;
                $consecutiveDaysWorked = 0;
                $randomDayOff = rand(0, 6);

                // Busca escala existente
                $existingSchedule = Model_schedules::where('employee_id', $employee->id)
                    ->orderBy('end_date', 'desc')
                    ->first();

                if ($existingSchedule) {
                    $currentDate = Carbon::parse($existingSchedule->end_date)->addDay();
                    $lastDayOff = Carbon::parse($existingSchedule->end_date);
                    $scheduledDays = json_decode($existingSchedule->days, true) ?? [];
                }

                while ($daysScheduled < $days) {
                    $isDayOff = $consecutiveDaysWorked == 6;

                    $isHoliday = $holidays->contains(function ($holiday) use ($currentDate) {
                        return is_object($holiday) && property_exists($holiday, 'date')
                            ? $holiday->date == $currentDate->toDateString()
                            : false;
                    });

                    if (
                        $isDayOff ||
                        $currentDate->isWeekend() ||
                        $isHoliday ||
                        $currentDate->dayOfWeek == $randomDayOff
                    ) {
                        if ($isDayOff || $currentDate->dayOfWeek == $randomDayOff) {
                            $consecutiveDaysWorked = 0;
                            $lastDayOff = $currentDate->copy();
                        }
                        $currentDate->addDay();
                        continue;
                    }

                    // Seleciona turno aleatório
                    $selectedShift = $availableShifts->random();

                    $scheduledDays[] = [
                        'date' => $currentDate->toDateString(),
                        'shift_id' => $selectedShift->id,
                        'shift_name' => $selectedShift->name,
                        'start_time' => $selectedShift->start_time,
                        'end_time' => $selectedShift->end_time,
                    ];

                    $daysScheduled++;
                    $consecutiveDaysWorked++;
                    $currentDate->addDay();
                }

                try {
                    if ($existingSchedule) {
                        $existingSchedule->update([
                            'days' => json_encode($scheduledDays),
                            'end_date' => $currentDate->subDay()->toDateString(),
                            'last_day_off' => $lastDayOff ? $lastDayOff->toDateString() : null,
                        ]);
                    } else {
                        $newSchedule = Model_schedules::create([
                            'employee_id' => $employee->id,
                            'shift_id' => $selectedShift->id,
                            'period_type' => $periodType,
                            'start_date' => $startDate->toDateString(),
                            'end_date' => $currentDate->subDay()->toDateString(),
                            'days' => json_encode($scheduledDays),
                            'last_day_off' => $lastDayOff ? $lastDayOff->toDateString() : null,
                        ]);

                        $generatedSchedules[] = $newSchedule;
                    }
                } catch (\Exception $e) {
                    \Log::error('Erro ao salvar escala para funcionário ' . $employee->id . ': ' . $e->getMessage());
                    return response()->json([
                        'message' => 'Erro ao salvar escala',
                        'error' => $e->getMessage(),
                    ], 500);
                }
            }

            \Log::info('Escalas geradas com sucesso', [
                'total_employees' => $employees->count(),
                'total_schedules' => count($generatedSchedules),
            ]);

            return response()->json([
                'message' => 'Escalas geradas com sucesso!',
                'total_employees' => $employees->count(),
                'total_schedules' => count($generatedSchedules),
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Erro na geração de escalas: ' . $e->getMessage());
            return response()->json([
                'message' => 'Erro na geração de escalas',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // Método auxiliar para verificar se é fim de semana ou feriado
    protected function isWeekendOrHoliday(Carbon $date, array $holidays): bool
    {
        // Verifica se é fim de semana
        if ($date->isWeekend()) {
            return true;
        }

        // Verifica se está na lista de feriados
        return in_array($date->toDateString(), $holidays);
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
        // Busca todos os turnos disponíveis
        $shifts = Model_shifits::all();

        // Se não houver turnos, retorna 1 como padrão
        if ($shifts->isEmpty()) {
            return 1;
        }

        // Seleciona um turno aleatório
        return $shifts->random()->id;
    }

    public function delete()
    {
        try {
            // Delete all scales
            Model_schedules::query()->delete();

            return response()->json([
                'message' => 'Escalas apagadas com sucesso.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao apagar escalas: ' . $e->getMessage()
            ], 500);
        }
    }
    public function generateForSingleEmployee(Request $request)
    {
        try {
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'period_type' => 'required|in:weekly,biweekly,monthly,quarterly',
            ]);

            $periodType = $request->period_type;
            $employeeId = $request->employee_id;

            $days = match ($periodType) {
                'weekly' => 7,
                'biweekly' => 14,
                'monthly' => 30,
                'quarterly' => 90,
                default => throw new \InvalidArgumentException("Tipo de período inválido."),
            };

            $startDate = Carbon::now();

            // Busca de feriados
            $holidays = $this->getHolidays();
            $holidays = is_array($holidays) ? collect($holidays) : $holidays;
            $holidays = $holidays ?? collect([]);

            // Busca o funcionário específico
            $employee = Model_Employees::findOrFail($employeeId);

            // Busca todos os turnos disponíveis
            $availableShifts = Model_shifits::all();
            if ($availableShifts->isEmpty()) {
                \Log::error('Nenhum turno disponível');
                return response()->json(['message' => 'Nenhum turno disponível'], 400);
            }

            // Inicialização de variáveis para o agendamento
            $currentDate = $startDate->copy();
            $lastDayOff = null;
            $scheduledDays = [];
            $daysScheduled = 0;
            $consecutiveDaysWorked = 0;
            $randomDayOff = rand(0, 6); // Dia da semana aleatório para folga

            // Tenta buscar uma escala existente para o funcionário
            $existingSchedule = Model_schedules::where('employee_id', $employee->id)
                ->orderBy('end_date', 'desc')
                ->first();

            // Se existir escala anterior, ajusta a data de início
            if ($existingSchedule) {
                $currentDate = Carbon::parse($existingSchedule->end_date)->addDay();
                $lastDayOff = Carbon::parse($existingSchedule->end_date);
                $scheduledDays = json_decode($existingSchedule->days, true) ?? [];
            }

            // Gera escala para o período solicitado
            while ($daysScheduled < $days) {
                // Verifica se é dia de folga
                $isDayOff = false;

                // A cada 6 dias, insere um dia de folga
                if ($consecutiveDaysWorked == 6) {
                    $isDayOff = true;
                }

                // Verifica se é dia de folga, fim de semana ou feriado
                $isHoliday = $holidays->contains(function ($holiday) use ($currentDate) {
                    return is_object($holiday) && property_exists($holiday, 'date')
                        ? $holiday->date == $currentDate->toDateString()
                        : false;
                });

                if (
                    $isDayOff ||
                    $currentDate->isWeekend() ||
                    $isHoliday ||
                    $currentDate->dayOfWeek == $randomDayOff
                ) {
                    // Se for dia de folga, reseta os dias trabalhados consecutivos
                    if ($isDayOff || $currentDate->dayOfWeek == $randomDayOff) {
                        $consecutiveDaysWorked = 0;
                        $lastDayOff = $currentDate->copy();
                    }

                    // Pula para o próximo dia
                    $currentDate->addDay();
                    continue;
                }

                // Seleciona um turno aleatório
                $selectedShift = $availableShifts->random();

                // Adiciona o dia à escala do funcionário
                $scheduledDays[] = [
                    'date' => $currentDate->toDateString(),
                    'shift_id' => $selectedShift->id,
                    'shift_name' => $selectedShift->name,
                    'start_time' => $selectedShift->start_time,
                    'end_time' => $selectedShift->end_time,
                ];

                $daysScheduled++;
                $consecutiveDaysWorked++;

                // Avança para o próximo dia
                $currentDate->addDay();
            }

            // Atualiza ou cria a escala para o funcionário
            try {
                if ($existingSchedule) {
                    $existingSchedule->update([
                        'days' => json_encode($scheduledDays),
                        'end_date' => $currentDate->subDay()->toDateString(),
                        'last_day_off' => $lastDayOff ? $lastDayOff->toDateString() : null
                    ]);
                } else {
                    Model_schedules::create([
                        'employee_id' => $employee->id,
                        'shift_id' => $selectedShift->id,
                        'period_type' => $periodType,
                        'start_date' => $startDate->toDateString(),
                        'end_date' => $currentDate->subDay()->toDateString(),
                        'days' => json_encode($scheduledDays),
                        'last_day_off' => $lastDayOff ? $lastDayOff->toDateString() : null
                    ]);
                }

                // Log de sucesso
                \Log::info('Escala gerada com sucesso para o funcionário', [
                    'employee_id' => $employee->id,
                    'period_type' => $periodType
                ]);

                return response()->json([
                    'message' => 'Escala gerada com sucesso para o funcionário!',
                    'employee_id' => $employee->id,
                    'total_days_scheduled' => $daysScheduled,
                    'shifts_used' => collect($scheduledDays)->pluck('shift_name')->unique()->values()->toArray()
                ], 201);
            } catch (\Exception $e) {
                // Log de erro
                \Log::error('Erro ao salvar escala para funcionário ' . $employee->id . ': ' . $e->getMessage());
                return response()->json([
                    'message' => 'Erro ao salvar escala',
                    'error' => $e->getMessage()
                ], 500);
            }
        } catch (\Exception $e) {
            // Log de erro global
            \Log::error('Erro na geração de escala: ' . $e->getMessage());

            return response()->json([
                'message' => 'Erro na geração de escala',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
