<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Model_schedules extends Model
{
    protected $table = 'schedules';
    protected $fillable = [
        'employee_id',
        'shift_id',
        'period_type',
        'start_date',
        'end_date',
        'days'
    ];

    public function employee()
    {
        return $this->belongsTo(Model_Employees::class, 'employee_id');
    }
    public static function obterEscalas(?string $search = ''): Builder
    {
        return DB::table('employees as b')->select([
            'a.start_date as primeiro_dia',
            'a.end_date as ultimo_dia',
            'a.days as dias',
            'b.name as funcionario',
            'b.contact as contato',
            'c.name as turno',
            'd.name as departamento',
            'e.name as cargo',
            'b.id as id_funcionario'
        ])
            ->leftJoin('schedules as a', 'b.id', '=', 'a.employee_id')
            ->leftJoin('shifts as c', 'c.id', '=', 'a.shift_id')
            ->leftJoin('departments as d', 'd.id', '=', 'b.department_id')
            ->leftJoin('positions as e', 'e.id', '=', 'b.position_id')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('a.start_date', 'like', "%{$search}%")
                        ->orWhere('a.end_date', 'like', "%{$search}%")
                        ->orWhere('a.days', 'like', "%{$search}%")
                        ->orWhere('b.name', 'like', "%{$search}%")
                        ->orWhere('b.contact', 'like', "%{$search}%")
                        ->orWhere('c.name', 'like', "%{$search}%")
                        ->orWhere('d.name', 'like', "%{$search}%")
                        ->orWhere('e.name', 'like', "%{$search}%");
                });
            });
    }

    public function shift()
    {
        return $this->belongsTo(Model_shifits::class, 'shift_id');
    }
}
