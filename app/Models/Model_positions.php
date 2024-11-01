<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Model_positions extends Model
{
    protected $table = 'positions';
    protected $fillable = [];
    
    public static function obterPositions(?string $search = ''):Builder
    {
        return DB::table('positions')->select([
            '*'
        ])->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('responsibilities', 'like', "%{$search}%");
            });
        });
    }
}

