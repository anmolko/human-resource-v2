<?php if( count(@$receipt_data) == 0 &&  count(@$contra_data) == 0 &&  count(@$contra_opening_data) == 0 && count(@$journal_opening_data) == 0 && count(@$payment_opening_data) == 0 && count(@$receipt_opening_data) == 0 && count(@$data) == 0 && count(@$payment_data) == 0 ){ }else {?>
<div class="row align-items-center report-groups">
    <div class="col">
    </div>
    <div class="col-auto float-right ml-auto">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white" id="generate-pdf">PDF</button>
            <button class="btn btn-white" onclick="printerDiv('ledger-single-data')"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div>
</div>
<?php }?>

<div class="row" id="ledger-single-data">
    <div class="col-md-12">
            <div class="card" id="ledger-single-data-card">
                <div class="card-body">
                <?php if( count(@$receipt_data) == 0 &&  count(@$contra_data) == 0 &&  count(@$contra_opening_data) == 0 && count(@$journal_opening_data) == 0 && count(@$payment_opening_data) == 0 && count(@$receipt_opening_data) == 0 && count(@$data) == 0 && count(@$payment_data) == 0 ){?>
                    <div class="text-center">
                     <img src="{{asset('/images/no-data.png')}}" class="inv-logo" alt="">

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-center">No Data Available</p>
                        </div>
                    </div>

                    <?php }else {?>
                    <div class="text-center">
                        <img src="<?php if(@$company_data->company_logo){?>{{asset('/images/company/'.@$company_data->company_logo)}}<?php }else{?>{{asset('/backend/assets/img/logo2.png')}}<?php }?>" class="inv-logo" alt="">
                    </div>
                    <div class="row">
                        <div class="col-sm-6 m-b-20">
                            <ul class="list-unstyled">
                                <li>{{ (@$company_data->company_name) ? ucwords(@$company_data->company_name) : 'CanoSoft Technologies'}}</li>
                                <li>{{(@$company_data->company_address) ? ucwords(@$company_data->company_address) : 'Putalisadak, Kathmandu'}}</li>
                                <li>{{(@$company_data->email) ? @$company_data->email : 'info@canosoft.com.np'}}</li>
                                <li>{{(@$company_data->phone) ? @$company_data->phone.' , ' : '9860809978 ,'}} {{(@$company_data->mobile) ? @$company_data->mobile : '9860809978'}}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6 m-b-20">
                            <div class="invoice-details">
                                <h3 class="text-uppercase accountname">{{@$account->name}}</h3>
                                <input type="hidden" name="account_name" id="account_name" value="{{@$account->name}}"/>
                                <ul class="list-unstyled">
                                    <li>From: <span>{{@$from}}</span></li>
                                    <li>To: <span>{{@$to}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                        <div class="table-responsive">
                            <table id="all-ledger" class="ledger-table table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Particulars</th>
                                        <th>Voucher Type</th>
                                        <th>Voucher No.</th>
                                        <th class="text-left">Debit</th>
                                        <th class="text-right">Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $debit_amount =0 ; $credit_amount =0 ; @endphp
                                    @if(!empty(@$data))
                                        @foreach(@$data as $journal_entries)
                                            @foreach($journal_entries->journalParticulars as $journal_particular)
                                                @if($journal_particular->by_debit_id == $account->id)
                                                <tr>

                                                @php $debit_amount = $debit_amount + $journal_particular->debit_amount @endphp

                                                <?php if(@$theme_data->default_date_format=='nepali'){
                                                    $pieces = explode("-", $journal_entries->date);

                                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                                <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                                    <td>{{date('j F, Y',strtotime(@$journal_entries->date))}}</td>
                                                <?php }else{?>
                                                    <td>{{date('j F, Y',strtotime(@$journal_entries->date))}}</td>
                                                <?php }?>
                                                <td> {{ ($journal_particular->initial_acc_id) ? ucwords($journal_particular->initialAccount->name) : '' }}</td>
                                                <td> {{ ($journal_entries->voucher_type) ? ucwords($journal_entries->voucher_type) : '' }}</td>
                                                <td><a href="{{route('journal-entry.single',$journal_entries->ref_no)}}" target="_blank"> {{ ($journal_entries->ref_no) ? ucwords($journal_entries->ref_no) : '' }} </a></td>
                                                <td class="text-left">{{@$journal_particular->debit_amount}}</td>
                                                <td class="text-right">-</td>
                                                </tr>
                                                @endif

                                                @if($journal_particular->to_credit_id == $account->id)
                                                @php $credit_amount = $credit_amount + $journal_particular->credit_amount @endphp
                                                <tr>
                                                <?php if(@$theme_data->default_date_format=='nepali'){
                                                    $pieces = explode("-", $journal_entries->date);

                                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                                <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                                    <td>{{date('j F, Y',strtotime(@$journal_entries->date))}}</td>
                                                <?php }else{?>
                                                    <td>{{date('j F, Y',strtotime(@$journal_entries->date))}}</td>
                                                <?php }?>
                                                <td> {{ ($journal_particular->initial_acc_id) ? ucwords($journal_particular->initialAccount->name) : '' }}</td>
                                                <td> {{ ($journal_entries->voucher_type) ? ucwords($journal_entries->voucher_type) : '' }}</td>
                                                <td><a href="{{route('journal-entry.single',$journal_entries->ref_no)}}" target="_blank"> {{ ($journal_entries->ref_no) ? ucwords($journal_entries->ref_no) : '' }} </a></td>
                                                <td class="text-left">-</td>
                                                <td class="text-right">{{@$journal_particular->credit_amount}}</td>
                                                </tr>
                                                
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif

                                    @if(!empty(@$payment_data))
                                        @foreach(@$payment_data as $payment_vouchers)
                                            @foreach($payment_vouchers->PaymentParticulars as $payment_voucher_particular)
                                                @if($payment_voucher_particular->by_debit_id == $account->id)
                                                @php $debit_amount = $debit_amount + $payment_voucher_particular->debit_amount @endphp
                                                <tr>
                                                
                                                <?php if(@$theme_data->default_date_format=='nepali'){
                                                    $pieces = explode("-", $payment_vouchers->date);
                                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                                <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                                    <td>{{date('j F, Y',strtotime(@$payment_vouchers->date))}}</td>
                                                <?php }else{?>
                                                    <td>{{date('j F, Y',strtotime(@$payment_vouchers->date))}}</td>
                                                <?php }?>
                                                <td> {{ ($payment_voucher_particular->initial_acc_id) ? ucwords($payment_voucher_particular->initialAccount->name) : '' }}</td>
                                                <td> {{ ($payment_vouchers->voucher_type) ? ucwords($payment_vouchers->voucher_type) : '' }}</td>
                                                <td><a href="{{route('payment-voucher.single',$payment_vouchers->ref_no)}}" target="_blank"> {{ ($payment_vouchers->ref_no) ? ucwords($payment_vouchers->ref_no) : '' }} </a></td>
                                                <td class="text-left">{{@$payment_voucher_particular->debit_amount}}</td>
                                                <td class="text-right">-</td>
                                                </tr>
                                                @endif

                                                @if($payment_voucher_particular->to_credit_id == $account->id)
                                                @php $credit_amount = $credit_amount + $payment_voucher_particular->credit_amount @endphp
                                                <tr>

                                                <?php if(@$theme_data->default_date_format=='nepali'){
                                                    $pieces = explode("-", $payment_vouchers->date);
                                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                                <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                                    <td>{{date('j F, Y',strtotime(@$payment_vouchers->date))}}</td>
                                                <?php }else{?>
                                                    <td>{{date('j F, Y',strtotime(@$payment_vouchers->date))}}</td>
                                                <?php }?>
                                                <td> {{ ($payment_voucher_particular->initial_acc_id) ? ucwords($payment_voucher_particular->initialAccount->name) : '' }}</td>
                                                <td> {{ ($payment_vouchers->voucher_type) ? ucwords($payment_vouchers->voucher_type) : '' }}</td>
                                                <td><a href="{{route('payment-voucher.single',$payment_vouchers->ref_no)}}" target="_blank"> {{ ($payment_vouchers->ref_no) ? ucwords($payment_vouchers->ref_no) : '' }} </a></td>
                                                <td class="text-left">-</td>
                                                <td class="text-right">{{@$payment_voucher_particular->credit_amount}}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif

                                    
                                    @if(!empty(@$receipt_data))
                                        @foreach(@$receipt_data as $receipt_vouchers)
                                            @foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular)
                                                @if($receipt_voucher_particular->by_debit_id == $account->id)
                                                @php $debit_amount = $debit_amount + $receipt_voucher_particular->debit_amount @endphp
                                                <tr>
                                                
                                                <?php if(@$theme_data->default_date_format=='nepali'){
                                                    $pieces = explode("-", $receipt_vouchers->date);
                                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                                <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                                    <td>{{date('j F, Y',strtotime(@$receipt_vouchers->date))}}</td>
                                                <?php }else{?>
                                                    <td>{{date('j F, Y',strtotime(@$receipt_vouchers->date))}}</td>
                                                <?php }?>
                                                <td> {{ ($receipt_voucher_particular->initial_acc_id) ? ucwords($receipt_voucher_particular->initialAccount->name) : '' }}</td>
                                                <td> {{ ($receipt_vouchers->voucher_type) ? ucwords($receipt_vouchers->voucher_type) : '' }}</td>
                                                <td><a href="{{route('receipt-voucher.single',$receipt_vouchers->ref_no)}}" target="_blank"> {{ ($receipt_vouchers->ref_no) ? ucwords($receipt_vouchers->ref_no) : '' }} </a></td>
                                                <td class="text-left">{{@$receipt_voucher_particular->debit_amount}}</td>
                                                <td class="text-right">-</td>
                                                </tr>
                                                @endif

                                                @if($receipt_voucher_particular->to_credit_id == $account->id)
                                                @php $credit_amount = $credit_amount + $receipt_voucher_particular->credit_amount @endphp
                                                <tr>

                                                <?php if(@$theme_data->default_date_format=='nepali'){
                                                    $pieces = explode("-", $receipt_vouchers->date);
                                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                                <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                                    <td>{{date('j F, Y',strtotime(@$receipt_vouchers->date))}}</td>
                                                <?php }else{?>
                                                    <td>{{date('j F, Y',strtotime(@$receipt_vouchers->date))}}</td>
                                                <?php }?>
                                                <td> {{ ($receipt_voucher_particular->initial_acc_id) ? ucwords($receipt_voucher_particular->initialAccount->name) : '' }}</td>
                                                <td> {{ ($receipt_vouchers->voucher_type) ? ucwords($receipt_vouchers->voucher_type) : '' }}</td>
                                                <td><a href="{{route('receipt-voucher.single',$receipt_vouchers->ref_no)}}" target="_blank"> {{ ($receipt_vouchers->ref_no) ? ucwords($receipt_vouchers->ref_no) : '' }} </a></td>
                                                <td class="text-left">-</td>
                                                <td class="text-right">{{@$receipt_voucher_particular->credit_amount}}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif

                                    @if(!empty(@$contra_data))
                                        @foreach(@$contra_data as $contra_vouchers)
                                            @foreach($contra_vouchers->contraParticulars as $contra_voucher_particular)
                                                @if($contra_voucher_particular->by_debit_id == $account->id)
                                                @php $debit_amount = $debit_amount + $contra_voucher_particular->debit_amount @endphp
                                                <tr>
                                                
                                                <?php if(@$theme_data->default_date_format=='nepali'){
                                                    $pieces = explode("-", $contra_vouchers->date);
                                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                                <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                                    <td>{{date('j F, Y',strtotime(@$contra_vouchers->date))}}</td>
                                                <?php }else{?>
                                                    <td>{{date('j F, Y',strtotime(@$contra_vouchers->date))}}</td>
                                                <?php }?>
                                                <td> {{ ($contra_voucher_particular->initial_acc_id) ? ucwords($contra_voucher_particular->initialAccount->name) : '' }}</td>
                                                <td> {{ ($contra_vouchers->voucher_type) ? ucwords($contra_vouchers->voucher_type) : '' }}</td>
                                                <td><a href="{{route('contra-voucher.single',$contra_vouchers->ref_no)}}" target="_blank"> {{ ($contra_vouchers->ref_no) ? ucwords($contra_vouchers->ref_no) : '' }} </a></td>
                                                <td class="text-left">{{@$contra_voucher_particular->debit_amount}}</td>
                                                <td class="text-right">-</td>
                                                </tr>
                                                @endif

                                                @if($contra_voucher_particular->to_credit_id == $account->id)
                                                @php $credit_amount = $credit_amount + $contra_voucher_particular->credit_amount @endphp
                                                <tr>

                                                <?php if(@$theme_data->default_date_format=='nepali'){
                                                    $pieces = explode("-", $contra_vouchers->date);
                                                echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                                <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                                    <td>{{date('j F, Y',strtotime(@$contra_vouchers->date))}}</td>
                                                <?php }else{?>
                                                    <td>{{date('j F, Y',strtotime(@$contra_vouchers->date))}}</td>
                                                <?php }?>
                                                <td> {{ ($contra_voucher_particular->initial_acc_id) ? ucwords($contra_voucher_particular->initialAccount->name) : '' }}</td>
                                                <td> {{ ($contra_vouchers->voucher_type) ? ucwords($contra_vouchers->voucher_type) : '' }}</td>
                                                <td><a href="{{route('contra-voucher.single',$contra_vouchers->ref_no)}}" target="_blank"> {{ ($contra_vouchers->ref_no) ? ucwords($contra_vouchers->ref_no) : '' }} </a></td>
                                                <td class="text-left">-</td>
                                                <td class="text-right">{{@$contra_voucher_particular->credit_amount}}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                  

                                    @php $debit_amount_opening =0 ; $credit_amount_opening =0 ; @endphp
                                    @if(!empty(@$journal_opening_data))
                                        @foreach(@$journal_opening_data as $journal_entries)
                                            @foreach($journal_entries->journalParticulars as $journal_particular)
                                                @if($journal_particular->by_debit_id == $account->id)

                                                @php $debit_amount_opening = $debit_amount_opening + $journal_particular->debit_amount @endphp

                                                
                                                @endif

                                                @if($journal_particular->to_credit_id == $account->id)
                                                @php $credit_amount_opening = $credit_amount_opening + $journal_particular->credit_amount @endphp
                                                
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif

                                    @if(!empty(@$payment_opening_data))
                                        @foreach(@$payment_opening_data as $payment_vouchers)
                                            @foreach($payment_vouchers->PaymentParticulars as $payment_voucher_particular)
                                                @if($payment_voucher_particular->by_debit_id == $account->id)
                                                @php $debit_amount_opening = $debit_amount_opening + $payment_voucher_particular->debit_amount @endphp
                                              
                                                @endif

                                                @if($payment_voucher_particular->to_credit_id == $account->id)
                                                @php $credit_amount_opening = $credit_amount_opening + $payment_voucher_particular->credit_amount @endphp
                                                
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif

                                    
                                    @if(!empty(@$receipt_opening_data))
                                        @foreach(@$receipt_opening_data as $receipt_vouchers)
                                            @foreach($receipt_vouchers->receiptParticulars as $receipt_voucher_particular)
                                                @if($receipt_voucher_particular->by_debit_id == $account->id)
                                                @php $debit_amount_opening = $debit_amount_opening + $receipt_voucher_particular->debit_amount @endphp
                                                
                                                @endif

                                                @if($receipt_voucher_particular->to_credit_id == $account->id)
                                                @php $credit_amount_opening = $credit_amount_opening + $receipt_voucher_particular->credit_amount @endphp
                                             
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif

                                    @if(!empty(@$contra_opening_data))
                                        @foreach(@$contra_opening_data as $contra_vouchers)
                                            @foreach($contra_vouchers->contraParticulars as $contra_voucher_particular)
                                                @if($contra_voucher_particular->by_debit_id == $account->id)
                                                @php $debit_amount_opening = $debit_amount_opening + $contra_voucher_particular->debit_amount @endphp
                                               
                                                @endif

                                                @if($contra_voucher_particular->to_credit_id == $account->id)
                                                @php $credit_amount_opening = $credit_amount_opening + $contra_voucher_particular->credit_amount @endphp
                                               
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif


                                    
                                </tbody>
                            </table>

                            <table class="table table-striped table-hover ">
                            <thead>
                                    <tr class="closing-balance-container">
                                        <th>Date</th>
                                        <th>Particulars</th>
                                        <th>Voucher Type</th>
                                        <th>Voucher No.</th>
                                        <th class="text-left">Debit</th>
                                        <th class="text-right">Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <th>Opening Balance:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-left text-primary">
                                            <?php if($debit_amount_opening > $credit_amount_opening){?>
                                            <h5>
                                             {{number_format($debit_amount_opening - $credit_amount_opening)}}
                                            @php $total_debit_opening = $debit_amount_opening - $credit_amount_opening; @endphp
                                            </h5>
                                            <?php } ?>
                                        </td>
                                        <td class="text-right text-primary">
                                            <?php if($credit_amount_opening > $debit_amount_opening){?>
                                            <h5>
                                            {{number_format($credit_amount_opening - $debit_amount_opening)}}
                                            @php $total_credit_opening = $credit_amount_opening - $debit_amount_opening; @endphp
                                           
                                            </h5>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Total:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        @php $grand_total_debit = @$debit_amount + @$total_debit_opening; @endphp
                                        @php $grand_total_credit = @$credit_amount + @$total_credit_opening; @endphp

                                        <td class="text-left text-primary"> {{number_format(@$debit_amount + @$total_debit_opening)}}</td>
                                        <td class="text-right text-primary">{{number_format(@$credit_amount + @$total_credit_opening)}}</td>
                                    </tr>

                                  

                                    <tr>
                                        <th>Closing Balance:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-left text-primary">
                                            <?php if(@$grand_total_debit > @$grand_total_credit){?>
                                            <h5>
                                            <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$grand_total_debit - @$grand_total_credit)}}
                                            </h5>
                                            <?php } ?>
                                        </td>
                                        <td class="text-right text-primary">
                                            <?php if(@$grand_total_credit > @$grand_total_debit){?>
                                            <h5>
                                            <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$grand_total_credit - @$grand_total_debit)}}
                                            </h5>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
    </div>

</div>




