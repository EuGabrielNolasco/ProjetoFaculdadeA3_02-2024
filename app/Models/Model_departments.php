<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Model_departments extends Model
{
    protected $table = 'departments';
    protected $fillable = [];
    
    public static function obterDepartments(?string $search = ''):Builder
    {
        return DB::table('departments')->select([
            '*'
        ])->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        });
    }}
