<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Model_shifits extends Model
{
    protected $table = 'shifts';
    protected $fillable = ['name','end_time','start_time'];
    
    public static function obterShifts(?string $search = ''):Builder
    {
        return DB::table('shifts')->select([
            '*'
        ])->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('end_time', '=', "{$search}")
                ->orWhere('start_time', '=', "{$search}");
            });
        });
    }}
