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
    public static function obterEscalas(): Builder
    {
        return DB::table('schedules as a')->select([
            'a.start_date as primeiro_dia',
            'a.end_date as ultimo_dia',
            'a.days as dias',
            'b.name as funcionario',
            'b.contact as contato',
            'c.name as turno',
            'd.name as departamento',
            'e.name as cargo'


        ])->leftJoin('employees as b','b.id','=','a.employee_id')
        ->leftJoin('shifts as c','c.id','=','a.shift_id')
        ->leftJoin('departments as d', 'd.id', '=', 'b.department_id')
        ->leftJoin('positions as e', 'e.id', '=', 'b.position_id');
    }
    public function shift()
    {
        return $this->belongsTo(Model_shifits::class, 'shift_id');
    }
}
