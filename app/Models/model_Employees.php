<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class model_Employees extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'id',
        'name',
        'contact',
        'department_id',
        'position_id'
    ];
    public static function obterFuncionarios(?string $search = ''): Builder
    {
        return DB::table('employees as a')->select([
            'a.id as id',
            'a.name as nome',
            'a.contact as contato',
            'b.name as departamento',
            'b.description as descricao',
            'c.name as cargo',
            'c.responsibilities as responsabilidade'
        ])->leftJoin('departments as b', 'b.id', '=', 'a.department_id')
        ->leftJoin('positions as c', 'c.id', '=', 'a.position_id')->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('a.name', 'like', "%{$search}%")
                    ->orWhere('a.contact', 'like', "%{$search}%")
                    ->orWhere('b.description', 'like', "%{$search}%")
                    ->orWhere('b.name', 'like', "%{$search}%");
            });
        });
    }
}
