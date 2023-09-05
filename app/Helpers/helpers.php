<?php

function flashSession(){
    if (session()->has('success')){
        $message = session()->get('success');
        echo '<div data-growl="container" class="alert alert-inverse alert-dismissable growl-animated animated fadeInRight" role="alert" data-growl-position="top-center" style="position: fixed; margin: 0px 0px 0px -316.601px; z-index: 999999; display: inline-block; top: 60px; right: 10px;color:#fff"><span data-growl="icon" class="fa fa-comments"></span><span data-growl="title">'.$message.'</span></div>';
    } elseif(session()->has('error')){
        $message = session()->get('error');
        echo '<div data-growl="container" class="alert alert-inverse alert-dismissable growl-animated animated fadeInRight" role="alert" data-growl-position="top-center" style="position: fixed; margin: 0px 0px 0px -316.601px; z-index: 999999; display: inline-block; top: 60px; right: 10px;background-color: #e74c3c;color:#fff"><span data-growl="icon" class="fa fa-comments"></span><span data-growl="title">'.$message.'</span></div>';
    }
}



if (!function_exists('getNepaliMonth')) {
    $selected_month;
    function getNepaliMonth($month){
     if($month == '1' || $month == '01'){
       $selected_month = "Baisakh";
     }else if($month == '2' || $month == '02'){
      $selected_month = "Jestha";
     }else if($month == '3' || $month == '03'){
      $selected_month = "Ashar";
     }else if($month== '4' || $month == '04'){
        $selected_month = "Shrawan";
     }else if($month== '5' || $month == '05'){
      $selected_month = "Bhadra";
     }else if($month== '6' || $month == '06'){
      $selected_month = "Ashoj";
     }else if($month== '7' || $month == '07'){
      $selected_month = "Kartik";
     }else if($month== '8' || $month == '08'){
      $selected_month = "Mangsir";
     }else if($month== '9' || $month == '09'){
      $selected_month = "Poush";
     }else if($month== '10'){
      $selected_month = "Magh";
     }else if($month== '11' ){
      $selected_month = "Falgun";
     }else if($month== '12' ){
      $selected_month = "Chaitra";
     }
     return $selected_month;
    }
}

if (!function_exists('getCompanySortedData')) {
    function getCompanySortedData($lists){
        $data = [];
        foreach ($lists as $list) {
            $company   = $list->demandInfo->company_name;
            // check if the company already exists as key
            if (!array_key_exists($company, $data)) {
                //create a new empty array for data where key is set as the company name
                $data[$company] = [];
            }
            // append the rest of the applied demand data to data array
            $data[$company][] = $list;
        }
        return $data;
    }
}


function url_get_contents ($Url) {
  if (!function_exists('curl_init')){
      die('CURL is not installed!');
  }
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $Url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);
  return $output;
}

if (!function_exists('getTrialBalanceInfo')) {
    function getTrialBalanceInfo($secondaryvalue,$journal,$receipt,$payment_data,$contra_data,$journal_opening_data,$payment_opening_data,$receipt_opening_data,$contra_opening_data){
        $data_arr=[];
        $all_data =[];
        $debit_amount =0 ; $credit_amount =0 ;  $total_debit_amount =0 ; $total_credit_amount =0 ; $total_amount =0 ; $grand_amount_credit=0;  $grand_amount_debit=0; $sales_data =[];
        $debit_amount_opening =0 ; $credit_amount_opening =0 ; $total_credit_opening=0; $total_debit_opening=0;
        $grand_total_debit = 0;
        $grand_total_credit =0;

        foreach($secondaryvalue as $value){

            foreach(@$journal as $journal_entries){
                foreach($journal_entries->journalParticulars as $journal_particular){


                        if($journal_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $journal_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $journal_entries->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$journal_entries->date));
                            }else{
                                    date('j F, Y',strtotime(@$journal_entries->date));
                                }
                        }else{
                            $debit_amount = $debit_amount + 0 ;

                        }


                        if($journal_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $journal_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $journal_entries->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$journal_entries->date));
                                }else{
                                date('j F, Y',strtotime(@$journal_entries->date));
                                }

                        }else{
                            $credit_amount = $credit_amount + 0 ;

                        }
                }
            }

            foreach(@$receipt as $receipt_vouchers){
                foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular){


                        if($receipt_voucher_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $receipt_voucher_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $receipt_vouchers->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$receipt_vouchers->date));
                            }else{
                                    date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }
                        }else{
                            $debit_amount = $debit_amount + 0 ;

                        }

                        if($receipt_voucher_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $receipt_voucher_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $receipt_vouchers->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }else{
                                date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }

                        }else{
                            $credit_amount = $credit_amount + 0 ;

                        }
                }
            }

            foreach(@$contra_data as $contra_vouchers){
                foreach($contra_vouchers->contraParticulars as $contra_voucher_particular){


                        if($contra_voucher_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $contra_voucher_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $contra_vouchers->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$contra_vouchers->date));
                            }else{
                                    date('j F, Y',strtotime(@$contra_vouchers->date));
                                }
                        }else{
                            $debit_amount = $debit_amount + 0 ;

                        }

                        if($contra_voucher_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $contra_voucher_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $contra_vouchers->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$contra_vouchers->date));
                                }else{
                                date('j F, Y',strtotime(@$contra_vouchers->date));
                                }

                        }else{
                            $credit_amount = $credit_amount + 0 ;

                        }
                }
            }

            foreach(@$payment_data as $payment_vouchers){
                foreach($payment_vouchers->PaymentParticulars as $payment_voucher_particular){


                        if($payment_voucher_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $payment_voucher_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $payment_vouchers->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$payment_vouchers->date));
                            }else{
                                    date('j F, Y',strtotime(@$payment_vouchers->date));
                                }
                        }else{
                            $debit_amount = $debit_amount + 0 ;

                        }

                        if($payment_voucher_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $payment_voucher_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $payment_vouchers->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$payment_vouchers->date));
                                }else{
                                date('j F, Y',strtotime(@$payment_vouchers->date));
                                }

                        }else{
                            $credit_amount = $credit_amount + 0 ;

                        }
                }
            }

            foreach($journal_opening_data as $journal_entries){
                foreach($journal_entries->journalParticulars as $journal_particular){

                    if($journal_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $journal_particular->debit_amount;
                    }else{
                        $debit_amount_opening = $debit_amount_opening + 0 ;

                    }


                    if($journal_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $journal_particular->credit_amount ;

                    }else{
                        $credit_amount_opening = $credit_amount_opening + 0 ;

                    }

                }
            }

            foreach($payment_opening_data as $payment_vouchers){
                foreach($payment_vouchers->PaymentParticulars as $payment_voucher_particular){

                    if($payment_voucher_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $payment_voucher_particular->debit_amount ;
                    }else{
                        $debit_amount_opening = $debit_amount_opening + 0 ;

                    }


                    if($payment_voucher_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $payment_voucher_particular->credit_amount ;

                    }else{
                        $credit_amount_opening = $credit_amount_opening + 0 ;

                    }


                }
            }

            foreach($contra_opening_data as $contra_vouchers){
                foreach($contra_vouchers->contraParticulars as $contra_voucher_particular){

                    if($contra_voucher_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $contra_voucher_particular->debit_amount ;
                    }else{
                        $debit_amount_opening = $debit_amount_opening + 0 ;

                    }

                    if($contra_voucher_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $contra_voucher_particular->credit_amount ;

                    }else{
                        $credit_amount_opening = $credit_amount_opening + 0 ;

                    }


                }
            }

            foreach($receipt_opening_data as $receipt_vouchers){
                foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular){

                    if($receipt_voucher_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $receipt_voucher_particular->debit_amount ;
                    }else{
                        $debit_amount_opening = $debit_amount_opening + 0 ;

                    }


                    if($receipt_voucher_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $receipt_voucher_particular->credit_amount ;

                    }else{
                        $credit_amount_opening = $credit_amount_opening + 0 ;

                    }


                }
            }


            if($credit_amount_opening > $debit_amount_opening){
                $total_credit_opening = $credit_amount_opening - $debit_amount_opening;
            }

            if($debit_amount_opening > $credit_amount_opening){
               $total_debit_opening = $debit_amount_opening - $credit_amount_opening;
            }

            $grand_total_debit = $debit_amount + $total_debit_opening;
            $grand_total_credit = $credit_amount + $total_credit_opening;


            if($grand_total_debit > $grand_total_credit){
                $total_debit_amount = $grand_total_debit - $grand_total_credit;
                $sales_data[$value->name] = ['debit',$total_debit_amount];
                $all_data[$value->primaryGroup->name][$value->name] = ['debit',$total_debit_amount];

            }

            if($grand_total_credit > $grand_total_debit){
                $total_credit_amount = $grand_total_credit - $grand_total_debit;
                $sales_data[$value->name] = ['credit',$total_credit_amount];
                $all_data[$value->primaryGroup->name][$value->name] = ['credit',$total_credit_amount];


            }


            $grand_amount_debit = $grand_amount_debit + $total_debit_amount;
            $grand_amount_credit = $grand_amount_credit + $total_credit_amount;
            $total_credit_opening =0;   $total_debit_opening=0;
            $debit_amount=0;
            $credit_amount=0;
            $total_debit_amount=0;
            $total_credit_amount=0;
            $debit_amount_opening = 0;
            $credit_amount_opening = 0;
            $grand_total_credit = 0;
            $grand_total_debit = 0;

            $data_arr=[
                'journal_pl_data' => $sales_data,
                'primary' => $all_data,
                'grand_amount_debit' => $grand_amount_debit,
                'grand_amount_credit' => $grand_amount_credit,

            ];


        }
        return $data_arr;
    }
}

if (!function_exists('getJournalProfitLossInfo')) {
    function getJournalProfitLossInfo($secondaryvalue,$journal,$receipt,$payment_data,$journal_opening_data,$payment_opening_data,$receipt_opening_data){
        $data_arr=[];

        $debit_amount =0 ; $credit_amount =0 ; $total_amount = 0 ; $grand_amount= 0; $sales_data =[];

        foreach($secondaryvalue as $value){

            foreach(@$journal as $journal_entries){
                foreach($journal_entries->journalParticulars as $journal_particular){

                        if($journal_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $journal_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $journal_entries->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$journal_entries->date));
                            }else{
                                    date('j F, Y',strtotime(@$journal_entries->date));
                                }
                        }


                        if($journal_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $journal_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $journal_entries->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$journal_entries->date));
                                }else{
                                date('j F, Y',strtotime(@$journal_entries->date));
                                }

                        }
                }
            }

            foreach(@$receipt as $receipt_vouchers){
                foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular){

                        if($receipt_voucher_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $receipt_voucher_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $receipt_vouchers->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$receipt_vouchers->date));
                            }else{
                                    date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }
                        }

                        if($receipt_voucher_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $receipt_voucher_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $receipt_vouchers->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }else{
                                date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }

                        }
                }
            }

            foreach(@$payment_data as $payment_vouchers){
                foreach($payment_vouchers->PaymentParticulars as $payment_voucher_particular){

                        if($payment_voucher_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $payment_voucher_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $payment_vouchers->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$payment_vouchers->date));
                            }else{
                                    date('j F, Y',strtotime(@$payment_vouchers->date));
                                }
                        }

                        if($payment_voucher_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $payment_voucher_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $payment_vouchers->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$payment_vouchers->date));
                                }else{
                                date('j F, Y',strtotime(@$payment_vouchers->date));
                                }

                        }
                }
            }

             $debit_amount_opening =0 ; $credit_amount_opening =0 ;
            foreach(@$journal_opening_data as $journal_entries){
                foreach($journal_entries->journalParticulars as $journal_particular){

                    if($journal_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $journal_particular->debit_amount;
                    }


                    if($journal_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $journal_particular->credit_amount ;

                    }

                }
            }

            foreach(@$payment_opening_data as $payment_vouchers){
                foreach($payment_vouchers->PaymentParticulars as $payment_voucher_particular){

                    if($payment_voucher_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $payment_voucher_particular->debit_amount ;
                    }

                    if($payment_voucher_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $payment_voucher_particular->credit_amount ;

                    }

                }
            }

            foreach(@$receipt_opening_data as $receipt_vouchers){
                foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular){

                    if($receipt_voucher_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $receipt_voucher_particular->debit_amount ;
                    }

                    if($receipt_voucher_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $receipt_voucher_particular->credit_amount ;

                    }


                }
            }



            if($debit_amount_opening > $credit_amount_opening){
                 $total_debit_opening = $debit_amount_opening - $credit_amount_opening;
            }

            if($credit_amount_opening > $debit_amount_opening){
                $total_credit_opening = $credit_amount_opening - $debit_amount_opening;

            }
            $grand_total_debit = @$debit_amount + @$total_debit_opening;
            $grand_total_credit = @$credit_amount + @$total_credit_opening;


            if($grand_total_debit > $grand_total_credit){
                $total_amount = $grand_total_debit - $grand_total_credit;
            }

            if($grand_total_credit > $grand_total_debit){
                $total_amount = $grand_total_credit - $grand_total_debit;

            }
            $sales_data[$value->name] = $total_amount;



            $grand_amount = $grand_amount + $total_amount;
            $credit_amount=0;
            $debit_amount=0;
            $total_amount=0;
            $debit_amount_opening = 0;
            $credit_amount_opening= 0;  $total_credit_opening= 0;  $total_debit_opening= 0;



            $data_arr=[
                'journal_pl_data' => $sales_data,
                'grand_amount' => $grand_amount
            ];


        }
        return $data_arr;
    }
}


if (!function_exists('getBalanceSheetAssetInfo')) {
    function getBalanceSheetAssetInfo($primaryvalue,$secondaryvalue,$journal,$receipt,$payment_data,$contra_data,$journal_opening_data,$payment_opening_data,$receipt_opening_data,$contra_opening_data){
        $data_arr=[];
        $debit_amount =0 ; $credit_amount =0 ;  $total_debit_amount =0 ; $total_credit_amount =0 ; $total_amount =0 ; $grand_amount=0; $sales_data =[];
        $debit_amount_opening =0 ; $credit_amount_opening =0 ; $total_credit_opening=0; $total_debit_opening=0;
        $grand_total_debit = 0;
        $grand_total_credit =0;
        $primary_data =[];

        foreach($secondaryvalue as $value){

            foreach(@$journal as $journal_entries){
                foreach($journal_entries->journalParticulars as $journal_particular){


                        if($journal_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $journal_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $journal_entries->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$journal_entries->date));
                            }else{
                                    date('j F, Y',strtotime(@$journal_entries->date));
                                }
                        }else{
                            $debit_amount = $debit_amount + 0 ;

                        }


                        if($journal_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $journal_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $journal_entries->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$journal_entries->date));
                                }else{
                                date('j F, Y',strtotime(@$journal_entries->date));
                                }

                        }else{
                            $credit_amount = $credit_amount + 0 ;

                        }
                }
            }

            foreach(@$receipt as $receipt_vouchers){
                foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular){


                        if($receipt_voucher_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $receipt_voucher_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $receipt_vouchers->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$receipt_vouchers->date));
                            }else{
                                    date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }
                        }else{
                            $debit_amount = $debit_amount + 0 ;

                        }

                        if($receipt_voucher_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $receipt_voucher_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $receipt_vouchers->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }else{
                                date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }

                        }else{
                            $credit_amount = $credit_amount + 0 ;

                        }
                }
            }

            foreach(@$contra_data as $contra_vouchers){
                foreach($contra_vouchers->contraParticulars as $contra_voucher_particular){


                        if($contra_voucher_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $contra_voucher_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $contra_vouchers->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$contra_vouchers->date));
                            }else{
                                    date('j F, Y',strtotime(@$contra_vouchers->date));
                                }
                        }else{
                            $debit_amount = $debit_amount + 0 ;

                        }

                        if($contra_voucher_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $contra_voucher_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $contra_vouchers->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$contra_vouchers->date));
                                }else{
                                date('j F, Y',strtotime(@$contra_vouchers->date));
                                }

                        }else{
                            $credit_amount = $credit_amount + 0 ;

                        }
                }
            }

            foreach(@$payment_data as $payment_vouchers){
                foreach($payment_vouchers->PaymentParticulars as $payment_voucher_particular){


                        if($payment_voucher_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $payment_voucher_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $payment_vouchers->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$payment_vouchers->date));
                            }else{
                                    date('j F, Y',strtotime(@$payment_vouchers->date));
                                }
                        }else{
                            $debit_amount = $debit_amount + 0 ;

                        }

                        if($payment_voucher_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $payment_voucher_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $payment_vouchers->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$payment_vouchers->date));
                                }else{
                                date('j F, Y',strtotime(@$payment_vouchers->date));
                                }

                        }else{
                            $credit_amount = $credit_amount + 0 ;

                        }
                }
            }

            foreach($journal_opening_data as $journal_entries){
                foreach($journal_entries->journalParticulars as $journal_particular){

                    if($journal_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $journal_particular->debit_amount;
                    }else{
                        $debit_amount_opening = $debit_amount_opening + 0 ;

                    }


                    if($journal_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $journal_particular->credit_amount ;

                    }else{
                        $credit_amount_opening = $credit_amount_opening + 0 ;

                    }

                }
            }

            foreach($payment_opening_data as $payment_vouchers){
                foreach($payment_vouchers->PaymentParticulars as $payment_voucher_particular){

                    if($payment_voucher_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $payment_voucher_particular->debit_amount ;
                    }else{
                        $debit_amount_opening = $debit_amount_opening + 0 ;

                    }


                    if($payment_voucher_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $payment_voucher_particular->credit_amount ;

                    }else{
                        $credit_amount_opening = $credit_amount_opening + 0 ;

                    }


                }
            }

            foreach($contra_opening_data as $contra_vouchers){
                foreach($contra_vouchers->contraParticulars as $contra_voucher_particular){

                    if($contra_voucher_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $contra_voucher_particular->debit_amount ;
                    }else{
                        $debit_amount_opening = $debit_amount_opening + 0 ;

                    }

                    if($contra_voucher_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $contra_voucher_particular->credit_amount ;

                    }else{
                        $credit_amount_opening = $credit_amount_opening + 0 ;

                    }


                }
            }

            foreach($receipt_opening_data as $receipt_vouchers){
                foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular){

                    if($receipt_voucher_particular->by_debit_id == $value->id){
                        $debit_amount_opening = $debit_amount_opening + $receipt_voucher_particular->debit_amount ;
                    }else{
                        $debit_amount_opening = $debit_amount_opening + 0 ;

                    }


                    if($receipt_voucher_particular->to_credit_id == $value->id){
                        $credit_amount_opening = $credit_amount_opening + $receipt_voucher_particular->credit_amount ;

                    }else{
                        $credit_amount_opening = $credit_amount_opening + 0 ;

                    }


                }
            }


            if($credit_amount_opening > $debit_amount_opening){
                $total_credit_opening = $credit_amount_opening - $debit_amount_opening;
            }

            if($debit_amount_opening > $credit_amount_opening){
               $total_debit_opening = $debit_amount_opening - $credit_amount_opening;
            }

            $grand_total_debit = $debit_amount + $total_debit_opening;
            $grand_total_credit = $credit_amount + $total_credit_opening;

            foreach($primaryvalue as $primary){
                if($primary->id == $value->primary_group_id){
                    if($grand_total_debit > $grand_total_credit){
                        $total_debit_amount = $grand_total_debit - $grand_total_credit;
                        $sales_data[$value->name] = ['debit',$total_debit_amount];
                        $primary_data[$primary->name][]=array($value->name=>array('debit',$total_debit_amount));

                    }

                    if($grand_total_credit > $grand_total_debit){
                        $total_credit_amount = $grand_total_credit - $grand_total_debit;
                        $sales_data[$value->name] = ['credit',$total_credit_amount];
                        $primary_data[$primary->name][]=array($value->name=>array('credit',$total_credit_amount));


                    }
                }
            }


            $grand_amount = $grand_amount + $total_debit_amount - $total_credit_amount;
            $total_credit_opening =0;   $total_debit_opening=0;
            $debit_amount=0;
            $credit_amount=0;
            $total_debit_amount=0;
            $total_credit_amount=0;
            $debit_amount_opening = 0;
            $credit_amount_opening = 0;
            $grand_total_credit = 0;
            $grand_total_debit = 0;

            $data_arr=[
                'journal_pl_data' => $sales_data,
                'primary' => $primary_data,
                'grand_amount' => $grand_amount
            ];


        }
        return $data_arr;
    }
}

if (!function_exists('getBalanceSheetLiabilitiyInfo')) {
    function getBalanceSheetLiabilitiyInfo($primaryvalue,$secondaryvalue,$journal,$receipt,$payment_data,$contra_data,$journal_opening_data,$payment_opening_data,$receipt_opening_data,$contra_opening_data){
        $data_arr=[];
        $debit_amount =0 ; $credit_amount =0 ;  $total_debit_amount =0 ; $total_credit_amount =0 ; $total_amount =0 ;
        $primary_grand_amount=0;
        $primary_debit_grand_amount=0; $primary_credit_grand_amount=0;
        $grand_amount=0; $sales_data =[];
        $debit_amount_opening =0 ; $credit_amount_opening =0 ; $total_credit_opening=0; $total_debit_opening=0;
        $grand_total_debit = 0;
        $grand_total_credit =0;
        $total_primary_credit_amount=0;
        $total_primary_debit_amount=0;
        $primary_data =[];
        $main_primary_data =[];
            foreach($secondaryvalue as $value){

                foreach(@$journal as $journal_entries){
                    foreach($journal_entries->journalParticulars as $journal_particular){

                            if($journal_particular->by_debit_id == $value->id){

                                $debit_amount = $debit_amount + $journal_particular->debit_amount ;

                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $journal_entries->date);
                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                    }else if(@$theme_data->default_date_format=='english'){
                                        date('j F, Y',strtotime(@$journal_entries->date));
                                }else{
                                        date('j F, Y',strtotime(@$journal_entries->date));
                                    }
                            }else{
                                $debit_amount = $debit_amount + 0 ;

                            }

                            if($journal_particular->to_credit_id == $value->id){
                                $credit_amount = $credit_amount + $journal_particular->credit_amount ;
                                    if(@$theme_data->default_date_format=='nepali'){
                                            $pieces = explode("-", $journal_entries->date);

                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                    }elseif(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$journal_entries->date));
                                    }else{
                                    date('j F, Y',strtotime(@$journal_entries->date));
                                    }

                            }else{
                                $credit_amount = $credit_amount + 0 ;

                            }
                    }
                }

                foreach(@$receipt as $receipt_vouchers){
                    foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular){


                            if($receipt_voucher_particular->by_debit_id == $value->id){

                                $debit_amount = $debit_amount + $receipt_voucher_particular->debit_amount ;

                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $receipt_vouchers->date);
                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                    }else if(@$theme_data->default_date_format=='english'){
                                        date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }else{
                                        date('j F, Y',strtotime(@$receipt_vouchers->date));
                                    }
                            }else{
                                $debit_amount = $debit_amount + 0 ;

                            }

                            if($receipt_voucher_particular->to_credit_id == $value->id){
                                $credit_amount = $credit_amount + $receipt_voucher_particular->credit_amount ;
                                    if(@$theme_data->default_date_format=='nepali'){
                                            $pieces = explode("-", $receipt_vouchers->date);

                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                    }elseif(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$receipt_vouchers->date));
                                    }else{
                                    date('j F, Y',strtotime(@$receipt_vouchers->date));
                                    }

                            }else{
                                $credit_amount = $credit_amount + 0 ;

                            }
                    }
                }

                foreach(@$contra_data as $contra_vouchers){
                    foreach($contra_vouchers->contraParticulars as $contra_voucher_particular){

                            if($contra_voucher_particular->by_debit_id == $value->id){

                                $debit_amount = $debit_amount + $contra_voucher_particular->debit_amount ;

                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $contra_vouchers->date);
                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                    }else if(@$theme_data->default_date_format=='english'){
                                        date('j F, Y',strtotime(@$contra_vouchers->date));
                                }else{
                                        date('j F, Y',strtotime(@$contra_vouchers->date));
                                    }
                            }else{
                                $debit_amount = $debit_amount + 0 ;

                            }

                            if($contra_voucher_particular->to_credit_id == $value->id){
                                $credit_amount = $credit_amount + $contra_voucher_particular->credit_amount ;
                                    if(@$theme_data->default_date_format=='nepali'){
                                            $pieces = explode("-", $contra_vouchers->date);

                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                    }elseif(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$contra_vouchers->date));
                                    }else{
                                    date('j F, Y',strtotime(@$contra_vouchers->date));
                                    }

                            }else{
                                $credit_amount = $credit_amount + 0 ;

                            }
                    }
                }

                foreach(@$payment_data as $payment_vouchers){
                    foreach($payment_vouchers->PaymentParticulars as $payment_voucher_particular){


                            if($payment_voucher_particular->by_debit_id == $value->id){

                                $debit_amount = $debit_amount + $payment_voucher_particular->debit_amount ;

                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $payment_vouchers->date);
                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                    }else if(@$theme_data->default_date_format=='english'){
                                        date('j F, Y',strtotime(@$payment_vouchers->date));
                                }else{
                                        date('j F, Y',strtotime(@$payment_vouchers->date));
                                    }
                            }else{
                                $debit_amount = $debit_amount + 0 ;

                            }

                            if($payment_voucher_particular->to_credit_id == $value->id){
                                $credit_amount = $credit_amount + $payment_voucher_particular->credit_amount ;
                                    if(@$theme_data->default_date_format=='nepali'){
                                            $pieces = explode("-", $payment_vouchers->date);

                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                    }elseif(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$payment_vouchers->date));
                                    }else{
                                    date('j F, Y',strtotime(@$payment_vouchers->date));
                                    }

                            }else{
                                $credit_amount = $credit_amount + 0 ;

                            }
                    }
                }

                foreach($journal_opening_data as $journal_entries){
                    foreach($journal_entries->journalParticulars as $journal_particular){

                        if($journal_particular->by_debit_id == $value->id){
                            $debit_amount_opening = $debit_amount_opening + $journal_particular->debit_amount;
                        }else{
                            $debit_amount_opening = $debit_amount_opening + 0 ;

                        }


                        if($journal_particular->to_credit_id == $value->id){
                            $credit_amount_opening = $credit_amount_opening + $journal_particular->credit_amount ;

                        }else{
                            $credit_amount_opening = $credit_amount_opening + 0 ;

                        }

                    }
                }

                foreach($payment_opening_data as $payment_vouchers){
                    foreach($payment_vouchers->PaymentParticulars as $payment_voucher_particular){

                        if($payment_voucher_particular->by_debit_id == $value->id){
                            $debit_amount_opening = $debit_amount_opening + $payment_voucher_particular->debit_amount ;
                        }else{
                            $debit_amount_opening = $debit_amount_opening + 0 ;

                        }


                        if($payment_voucher_particular->to_credit_id == $value->id){
                            $credit_amount_opening = $credit_amount_opening + $payment_voucher_particular->credit_amount ;

                        }else{
                            $credit_amount_opening = $credit_amount_opening + 0 ;

                        }


                    }
                }

                foreach($contra_opening_data as $contra_vouchers){
                    foreach($contra_vouchers->contraParticulars as $contra_voucher_particular){

                        if($contra_voucher_particular->by_debit_id == $value->id){
                            $debit_amount_opening = $debit_amount_opening + $contra_voucher_particular->debit_amount ;
                        }else{
                            $debit_amount_opening = $debit_amount_opening + 0 ;

                        }

                        if($contra_voucher_particular->to_credit_id == $value->id){
                            $credit_amount_opening = $credit_amount_opening + $contra_voucher_particular->credit_amount ;

                        }else{
                            $credit_amount_opening = $credit_amount_opening + 0 ;

                        }


                    }
                }

                foreach($receipt_opening_data as $receipt_vouchers){
                    foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular){

                        if($receipt_voucher_particular->by_debit_id == $value->id){
                            $debit_amount_opening = $debit_amount_opening + $receipt_voucher_particular->debit_amount ;
                        }else{
                            $debit_amount_opening = $debit_amount_opening + 0 ;

                        }


                        if($receipt_voucher_particular->to_credit_id == $value->id){
                            $credit_amount_opening = $credit_amount_opening + $receipt_voucher_particular->credit_amount ;

                        }else{
                            $credit_amount_opening = $credit_amount_opening + 0 ;

                        }


                    }
                }


                if($credit_amount_opening > $debit_amount_opening){
                    $total_credit_opening = $credit_amount_opening - $debit_amount_opening;
                }

                if($debit_amount_opening > $credit_amount_opening){
                $total_debit_opening = $debit_amount_opening - $credit_amount_opening;
                }

                $grand_total_debit = $debit_amount + $total_debit_opening;
                $grand_total_credit = $credit_amount + $total_credit_opening;



                foreach($primaryvalue as $primary){
                    if($primary->id == $value->primary_group_id){

                        if($grand_total_debit > $grand_total_credit){
                            $total_debit_amount = $grand_total_debit - $grand_total_credit;

                                $sales_data[$value->name] = ['debit',$total_debit_amount];
                                $primary_data[$primary->name][]=array($value->name=>array('debit',$total_debit_amount));

                        }

                        if($grand_total_credit > $grand_total_debit){
                                $total_credit_amount = $grand_total_credit - $grand_total_debit;

                                $sales_data[$value->name] = ['credit',$total_credit_amount];
                                // $primary_data[$primary->name][]= array($value->name=>array('credit',$total_credit_amount));
                                $primary_data[$primary->name][]=array($value->name=>array('credit',$total_credit_amount));



                        }

                    }
                }


                $grand_amount = $grand_amount + $total_credit_amount - $total_debit_amount;
                $total_credit_opening =0;   $total_debit_opening=0;
                $total_primary_credit_amount=0;
                $total_primary_debit_amount=0;
                $debit_amount=0;
                $credit_amount=0;
                $total_debit_amount=0;
                $total_credit_amount=0;

                $debit_amount_opening = 0;
                $credit_amount_opening = 0;
                $grand_total_credit = 0;
                $grand_total_debit = 0;


                $data_arr=[
                    'journal_pl_data' => $sales_data,
                    'primary' => $primary_data,
                    'grand_amount' => $grand_amount
                ];

            }


        return $data_arr;
    }
}

if (!function_exists('getReceiptProfitLossInfo')) {
    function getReceiptProfitLossInfo($secondaryvalue,$receipt){
        $data_arr=[];
        $debit_amount =0 ; $credit_amount =0 ; $total_amount =0 ; $grand_amount=0; $receipts_data =[];
        foreach($secondaryvalue as $value){

            foreach(@$receipt as $receipt_vouchers){
                foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular){


                        if($receipt_voucher_particular->by_debit_id == $value->id){

                            $debit_amount = $debit_amount + $receipt_voucher_particular->debit_amount ;

                            if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $receipt_vouchers->date);
                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }else if(@$theme_data->default_date_format=='english'){
                                    date('j F, Y',strtotime(@$receipt_vouchers->date));
                            }else{
                                    date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }
                        }else{
                            $debit_amount = $debit_amount + 0 ;

                        }

                        if($receipt_voucher_particular->to_credit_id == $value->id){
                            $credit_amount = $credit_amount + $receipt_voucher_particular->credit_amount ;
                                if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $receipt_vouchers->date);

                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';
                                }elseif(@$theme_data->default_date_format=='english'){
                                date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }else{
                                date('j F, Y',strtotime(@$receipt_vouchers->date));
                                }

                        }else{
                            $credit_amount = $credit_amount + 0 ;

                        }
                }
            }

            if($debit_amount > $credit_amount){
                number_format($debit_amount - $credit_amount);
                $total_amount = $debit_amount - $credit_amount;
            }

            if($credit_amount > $debit_amount){
                number_format($credit_amount - $debit_amount);
                $total_amount = $credit_amount - $debit_amount;
            }

            if($credit_amount ==0 && $debit_amount ==0){
                $total_amount = 0;
            }
            $receipts_data[$value->name] = $total_amount;

            $grand_amount = $grand_amount + $total_amount;
            $credit_amount=0;
            $debit_amount=0;

            $data_arr=[
                'receipt_pl_data' => $receipts_data,
                'grand_amount' => $grand_amount
            ];

        }
        return $data_arr;
    }
}

if (!function_exists('getSumAssociatveProfitLoss')) {

    function getSumAssociatveProfitLoss($arrays){
        $sum = array();
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (isset($sum[$key])) {
                    $sum[$key] += $value;
                } else {
                    $sum[$key] = $value;
                }
            }
        }
        return $sum;
    }
}

if (!function_exists('greeting_msg')) {
    function greeting_msg(){
        date_default_timezone_set('Asia/kathmandu');
        $hour      = date('H');
        if ($hour >= 20) {
            $greetings = "Good Night";
        } elseif ($hour > 17) {
            $greetings = "Good Evening";
        } elseif ($hour > 11) {
            $greetings = "Good Afternoon";
        } elseif ($hour < 12) {
            $greetings = "Good Morning";
        }
        return $greetings;
    }
}
