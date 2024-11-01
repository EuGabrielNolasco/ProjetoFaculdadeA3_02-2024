<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class model_Employees extends Model
{
    protected $table = 'employees';
    protected $fillable = [];

    public static function obterFuncionarios(?string $search = ''): Builder
    {
        return DB::table('employees as a')->select([
            'a.name as nome',
            'a.contact as contato',
            'b.name as departamento',
            'b.description as descricao'
        ])->leftJoin('departments as b', 'b.id', '=', 'a.department_id')->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('a.name', 'like', "%{$search}%")
                    ->orWhere('a.contact', 'like', "%{$search}%")
                    ->orWhere('b.description', 'like', "%{$search}%")
                    ->orWhere('b.name', 'like', "%{$search}%");
            });
        });
    }
}
