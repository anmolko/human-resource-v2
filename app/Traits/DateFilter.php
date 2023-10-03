<?php

namespace App\Traits;


use App\Models\ReferenceInformation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


trait DateFilter {

    public function FilterTableData($query, $table, $column = 'created_at'){
        $filter_period  = request('filter_period') ?? session('filter_period');
        $from_date      = request('from_date') ?? session('from_date');
        $to_date        = request('to_date') ?? session('to_date');

        if ($filter_period){
            request()->session()->put('filter_period', $filter_period);

            if ($filter_period == 'today'){
                $query->whereDate($table.'.'.$column, Carbon::today());
            }elseif($filter_period == 'yesterday'){
                $query->whereDate($table.'.'.$column, Carbon::yesterday());
            }elseif($filter_period == 'week'){
                $query->whereDate($table.'.'.$column, '>=' ,Carbon::now()->subDays(7));
            }elseif($filter_period == 'two_weeks'){
                $query->whereDate($table.'.'.$column, '>=',  Carbon::now()->subDays(14));
            }elseif($filter_period == 'month'){
                $query->whereDate($table.'.'.$column, '>=',  Carbon::now()->subDays(30));
            }
        }

        if ($from_date && $to_date){
            request()->session()->put('from_date', $from_date);
            request()->session()->put('to_date', $to_date);

            $query->whereDate($table.'.'.$column,'>=', $from_date)->whereDate($table.'.'.$column,'<=', $to_date);
        }

        return $query;
    }
}
