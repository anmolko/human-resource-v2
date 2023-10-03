<?php

namespace App\Traits;


use App\Models\ReferenceInformation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


trait GetFilterDate {

    public function getFilterDate(){

        $filter_period  = request('filter_period') ?? session('filter_period');
        $from_date      = request('from_date') ?? session('from_date');
        $to_date        = request('to_date') ?? session('to_date');
        $full_date      = [];

        if ($filter_period){
            if ($filter_period == 'today'){
               $full_date['from_date'] = Carbon::today()->toDateString();
            }elseif($filter_period == 'yesterday'){
                $full_date['from_date'] = Carbon::yesterday()->toDateString();
            }elseif($filter_period == 'week'){
                $full_date['from_date'] = Carbon::today()->subWeeks()->toDateString();
                $full_date['to_date']   = Carbon::today()->toDateString();
            }elseif($filter_period == 'two_weeks'){
                $full_date['from_date'] = Carbon::today()->subWeeks(2)->toDateString();
                $full_date['to_date']   = Carbon::today()->toDateString();
            }elseif($filter_period == 'month'){
                $full_date['from_date'] = Carbon::today()->subMonth(2)->toDateString();
                $full_date['to_date']   = Carbon::today()->toDateString();
            }
        }else{
            $full_date['from_date'] = $from_date;
            $full_date['to_date']   = $to_date;
        }

        return $full_date;
    }
}
