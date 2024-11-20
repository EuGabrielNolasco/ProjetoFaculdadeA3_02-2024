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
    public function obterEscalas(): Builder
    {
        return DB::table('schedules as a')->select([
            'a.*',
            'b.name as nome_turno',
            'b.start_time as hora_inicio',
            'b.end_time as hora_termino',
            'c.name as funcionario'

        ])->leftJoin('shifits as b','b.id','=','shift_id')
        ->leftJoin('employees as c','c.id','=','a.employee_id')
        ->leftJoin('');
    }
    public function shift()
    {
        return $this->belongsTo(Model_shifits::class, 'shift_id');
    }
}
