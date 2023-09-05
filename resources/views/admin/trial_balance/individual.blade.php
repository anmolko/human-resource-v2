<div class="row align-items-center report-groups">
    <div class="col">
    </div>
    <div class="col-auto float-right ml-auto">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white" id="generate-pdf">PDF</button>
            <button class="btn btn-white" onclick="printerDiv('trial-balance-single-data')"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div>
</div>

<div class="row" id="trial-balance-single-data">
    <div class="col-md-12">
            <div class="card" id="trial-balance-single-data-card">
                <div class="card-body">

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
                                <h4 class="text-uppercase accountname">Trial Balance</h4>
                                <ul class="list-unstyled">
                                <input type="hidden" id="balance_from" value="{{@$from}}"/>
                                <input type="hidden" id="balance_to" value="{{@$to}}"/>

                                    <li>From: <span>{{@$from}}</span></li>
                                    <li>To: <span>{{@$to}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 left-trial-balance-all">
                            <div>
                                <table class="table table-bordered">
                                    <tbody  >
                                    <tr>
                                        <th> <h4 class="m-b-10"><strong>Particulars</strong></h4></th>
                                        <th> <h4 class="m-b-10"><strong>Debit</strong></h4></th>
                                        <th> <h4 class="m-b-10"><strong>Credit</strong></h4></th>
                                    </tr>
                                    
                                   


                                        @if(!empty($journal_capital_account['primary']))

                                            @foreach(@$journal_capital_account['primary'] as $key_journal_capital_account => $value_journal_capital_account)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_capital_account)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_capital_account))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_capital_account as $key_secondary_journal_capital_account => $secondary_value_journal_capital_account)
                                                                    @if($secondary_value_journal_capital_account[1] !=0 && $secondary_value_journal_capital_account[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_capital_account)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_capital_account[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_capital_account[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_capital_account as $key_secondary_journal_capital_account => $secondary_value_journal_capital_account)
                                                                
                                                                    @if($secondary_value_journal_capital_account[1] !=0 && $secondary_value_journal_capital_account[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_capital_account)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_capital_account[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_capital_account[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif
                                                
                                        @if(!empty($journal_non_current_liabilities['primary']))

                                            @foreach(@$journal_non_current_liabilities['primary'] as $key_journal_non_current_liabilities => $value_journal_non_current_liabilities)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_non_current_liabilities)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_non_current_liabilities))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_non_current_liabilities as $key_secondary_journal_non_current_liabilities => $secondary_value_journal_non_current_liabilities)
                                                                    @if($secondary_value_journal_non_current_liabilities[1] !=0 && $secondary_value_journal_non_current_liabilities[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_non_current_liabilities)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_non_current_liabilities[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_non_current_liabilities[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_non_current_liabilities as $key_secondary_journal_non_current_liabilities => $secondary_value_journal_non_current_liabilities)
                                                                
                                                                    @if($secondary_value_journal_non_current_liabilities[1] !=0 && $secondary_value_journal_non_current_liabilities[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_non_current_liabilities)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_non_current_liabilities[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_non_current_liabilities[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif

                                    
                                        @if(!empty($journal_current_liabilities['primary']))

                                            @foreach(@$journal_current_liabilities['primary'] as $key_journal_current_liabilities => $value_journal_current_liabilities)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_current_liabilities)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_current_liabilities))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_current_liabilities as $key_secondary_journal_current_liabilities => $secondary_value_journal_current_liabilities)
                                                                    @if($secondary_value_journal_current_liabilities[1] !=0 && $secondary_value_journal_current_liabilities[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_current_liabilities)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_current_liabilities[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_current_liabilities[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_current_liabilities as $key_secondary_journal_current_liabilities => $secondary_value_journal_current_liabilities)
                                                                
                                                                    @if($secondary_value_journal_current_liabilities[1] !=0 && $secondary_value_journal_current_liabilities[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_current_liabilities)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_current_liabilities[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_current_liabilities[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif
                                        
                                  
                                        @if(!empty($journal_non_current_assets['primary']))
                                            @foreach(@$journal_non_current_assets['primary'] as $key_journal_non_current_assets => $value_journal_non_current_assets)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_non_current_assets)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_non_current_assets))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_non_current_assets as $key_secondary_journal_non_current_assets => $secondary_value_journal_non_current_assets)
                                                                    @if($secondary_value_journal_non_current_assets[1] !=0 && $secondary_value_journal_non_current_assets[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_non_current_assets)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_non_current_assets[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_non_current_assets[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_non_current_assets as $key_secondary_journal_non_current_assets => $secondary_value_journal_non__current_assets)
                                                                
                                                                    @if($secondary_value_journal_non__current_assets[1] !=0 && $secondary_value_journal_non__current_assets[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_non_current_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_non__current_assets[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_non__current_assets[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif

                                      
                                        @if(!empty($journal_current_assets['primary']))
                                            @foreach(@$journal_current_assets['primary'] as $key_journal_current_assets => $value_journal_current_assets)
                                                <tr>
                                                    <td>
                                                        <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_current_assets)}}</strong> 
                                                        </section>
                                                
                                                        <table class="table">
                                                            <tbody>
                                                                @if(!empty($value_journal_current_assets))
                                                                    @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                    @foreach(@$value_journal_current_assets as $key_secondary_journal_current_assets => $secondary_value_journal_current_assets)
                                                                        @if($secondary_value_journal_current_assets[1] !=0 && $secondary_value_journal_current_assets[0]=="debit")
                                                                            <tr>
                                                                                <td><span>Dr.  {{ucwords(@$key_secondary_journal_current_assets)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_current_assets[1])}}</span></td>
                                                                            </tr>
                                                                            @php 
                                                                            $individual_debit = $individual_debit + $secondary_value_journal_current_assets[1];
                                                                            @endphp
                                                                        @endif

                                                                    @endforeach

                                                                    @foreach(@$value_journal_current_assets as $key_secondary_journal_current_assets => $secondary_value_journal_current_assets)
                                                                    
                                                                        @if($secondary_value_journal_current_assets[1] !=0 && $secondary_value_journal_current_assets[0]=="credit")
                                                                            <tr>
                                                                                <td><span>Cr.  {{ucwords(@$key_secondary_journal_current_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_current_assets[1])}}</span></td>
                                                                            </tr>
                                                                            @php 
                                                                            $individual_credit = $individual_credit + $secondary_value_journal_current_assets[1];
                                                                            @endphp
                                                                        @endif

                                                                    @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </td>    
                                                        
                                                    <td>
                                                    <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                    </td>
                                                    <td>
                                                    <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    
                                        @if(!empty($journal_fixed_assets['primary']))
                                            @foreach(@$journal_fixed_assets['primary'] as $key_journal_fixed_assets => $value_journal_fixed_assets)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_fixed_assets)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_fixed_assets))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_fixed_assets as $key_secondary_journal_fixed_assets => $secondary_value_journal_fixed_assets)
                                                                    @if($secondary_value_journal_fixed_assets[1] !=0 && $secondary_value_journal_fixed_assets[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_fixed_assets)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_fixed_assets[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_fixed_assets[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_fixed_assets as $key_secondary_journal_fixed_assets => $secondary_value_journal_fixed_assets)
                                                                
                                                                    @if($secondary_value_journal_fixed_assets[1] !=0 && $secondary_value_journal_fixed_assets[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_fixed_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_fixed_assets[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_fixed_assets[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif
                            
                                        @if(!empty($journal_investment['primary']))
                                            @foreach(@$journal_investment['primary'] as $key_journal_investment => $value_journal_investment)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_investment)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_investment))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_investment as $key_secondary_journal_investment => $secondary_value_journal_investment)
                                                                    @if($secondary_value_journal_investment[1] !=0 && $secondary_value_journal_investment[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_investment)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_investment[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_investment[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_investment as $key_secondary_journal_investment => $secondary_value_journal_investment)
                                                                
                                                                    @if($secondary_value_journal_investment[1] !=0 && $secondary_value_journal_investment[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_investment)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_investment[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_investment[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif

                                                 
                                        @if(!empty($journal_purchases['primary']))

                                            @foreach(@$journal_purchases['primary'] as $key_journal_purchases => $value_journal_purchases)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_purchases)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_purchases))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_purchases as $key_secondary_journal_purchases => $secondary_value_journal_purchases)
                                                                    @if($secondary_value_journal_purchases[1] !=0 && $secondary_value_journal_purchases[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_purchases)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_purchases[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_purchases[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_purchases as $key_secondary_journal_purchases => $secondary_value_journal_purchases)
                                                                
                                                                    @if($secondary_value_journal_purchases[1] !=0 && $secondary_value_journal_purchases[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_purchases)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_purchases[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_purchases[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif

                                               
                                        @if(!empty($journal_direct_expenses['primary']))
                                            @foreach(@$journal_direct_expenses['primary'] as $key_journal_direct_expenses => $value_journal_direct_expenses)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_direct_expenses)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_direct_expenses))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_direct_expenses as $key_secondary_journal_direct_expenses => $secondary_value_journal_direct_expenses)
                                                                    @if($secondary_value_journal_direct_expenses[1] !=0 && $secondary_value_journal_direct_expenses[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_direct_expenses)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_direct_expenses[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_direct_expenses[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_direct_expenses as $key_secondary_journal_direct_expenses => $secondary_value_journal_direct_expenses)
                                                                
                                                                    @if($secondary_value_journal_direct_expenses[1] !=0 && $secondary_value_journal_direct_expenses[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_direct_expenses)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_direct_expenses[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_direct_expenses[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif


                                        @if(!empty($journal_sales['primary']))
                                            @foreach(@$journal_sales['primary'] as $key_journal_sales => $value_journal_sales)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_sales)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_sales))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_sales as $key_secondary_journal_sales => $secondary_value_journal_sales)
                                                                    @if($secondary_value_journal_sales[1] !=0 && $secondary_value_journal_sales[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_sales)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_sales[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_sales[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_sales as $key_secondary_journal_sales => $secondary_value_journal_sales)
                                                                
                                                                    @if($secondary_value_journal_sales[1] !=0 && $secondary_value_journal_sales[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_sales)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_sales[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_sales[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif


                                        @if(!empty($journal_direct_income['primary']))
                                            @foreach(@$journal_direct_income['primary'] as $key_journal_direct_income => $value_journal_direct_income)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_direct_income)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_direct_income))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_direct_income as $key_secondary_journal_direct_income => $secondary_value_journal_direct_income)
                                                                    @if($secondary_value_journal_direct_income[1] !=0 && $secondary_value_journal_direct_income[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_direct_income)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_direct_income[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_direct_income[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_direct_income as $key_secondary_journal_direct_income => $secondary_value_journal_direct_income)
                                                                
                                                                    @if($secondary_value_journal_direct_income[1] !=0 && $secondary_value_journal_direct_income[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_direct_income)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_direct_income[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_direct_income[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif
                                                  
                                            
                                        @if(!empty($journal_indirect_expenses['primary']))
                                            @foreach(@$journal_indirect_expenses['primary'] as $key_journal_indirect_expenses => $value_journal_indirect_expenses)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_indirect_expenses)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_indirect_expenses))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_indirect_expenses as $key_secondary_journal_indirect_expenses => $secondary_value_journal_indirect_expenses)
                                                                    @if($secondary_value_journal_indirect_expenses[1] !=0 && $secondary_value_journal_indirect_expenses[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_indirect_expenses)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_indirect_expenses[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_indirect_expenses[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_indirect_expenses as $key_secondary_journal_indirect_expenses => $secondary_value_journal_indirect_expenses)
                                                                
                                                                    @if($secondary_value_journal_indirect_expenses[1] !=0 && $secondary_value_journal_indirect_expenses[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_indirect_expenses)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_indirect_expenses[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_indirect_expenses[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif


                                        @if(!empty($journal_indirect_income['primary']))

                                            @foreach(@$journal_indirect_income['primary'] as $key_journal_indirect_income => $value_journal_indirect_income)
                                            <tr>
                                                <td>
                                                    <section class="heading-profit-loss"><strong >{{ucwords(@$key_journal_indirect_income)}}</strong> 
                                                    </section>
                                            
                                                    <table class="table">
                                                        <tbody>
                                                            @if(!empty($value_journal_indirect_income))
                                                                @php $individual_debit = 0; $individual_credit = 0; @endphp 
                                                                @foreach(@$value_journal_indirect_income as $key_secondary_journal_indirect_income => $secondary_value_journal_indirect_income)
                                                                    @if($secondary_value_journal_indirect_income[1] !=0 && $secondary_value_journal_indirect_income[0]=="debit")
                                                                        <tr>
                                                                            <td><span>Dr.  {{ucwords(@$key_secondary_journal_indirect_income)}}</span><span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_indirect_income[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_debit = $individual_debit + $secondary_value_journal_indirect_income[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach

                                                                @foreach(@$value_journal_indirect_income as $key_secondary_journal_indirect_income => $secondary_value_journal_indirect_income)
                                                                
                                                                    @if($secondary_value_journal_indirect_income[1] !=0 && $secondary_value_journal_indirect_income[0]=="credit")
                                                                        <tr>
                                                                            <td><span>Cr.  {{ucwords(@$key_secondary_journal_indirect_income)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary_value_journal_indirect_income[1])}}</span></td>
                                                                        </tr>
                                                                        @php 
                                                                        $individual_credit = $individual_credit + $secondary_value_journal_indirect_income[1];
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>    
                                                
                                                <td>
                                                <strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_debit)}}</strong>
                                                </td>
                                                <td>
                                                <strong> <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$individual_credit)}}</strong>

                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        @endif
                                       
                                        @php
                                               $grand_total_debit = @$journal_non_current_liabilities['grand_amount_debit'] + 
                                                                    @$journal_capital_account['grand_amount_debit'] + @$journal_current_liabilities['grand_amount_debit'] +
                                                                    @$journal_current_assets['grand_amount_debit'] + @$journal_fixed_assets['grand_amount_debit'] + 
                                                                    @$journal_investment['grand_amount_debit'] + @$journal_non_current_assets['grand_amount_debit'] +
                                                                    @$journal_purchases['grand_amount_debit'] + @$journal_direct_expenses['grand_amount_debit'] + 
                                                                    @$journal_sales['grand_amount_debit'] + @$journal_direct_income['grand_amount_debit'] + 
                                                                    @$journal_indirect_expenses['grand_amount_debit'] + @$journal_indirect_income['grand_amount_debit'];
                                        @endphp 
                                        @php
                                               $grand_total_credit = @$journal_non_current_liabilities['grand_amount_credit'] + 
                                                                    @$journal_capital_account['grand_amount_credit'] + @$journal_current_liabilities['grand_amount_credit'] +
                                                                    @$journal_current_assets['grand_amount_credit'] + @$journal_fixed_assets['grand_amount_credit'] + 
                                                                    @$journal_investment['grand_amount_credit'] + @$journal_non_current_assets['grand_amount_credit'] +
                                                                    @$journal_purchases['grand_amount_credit'] + @$journal_direct_expenses['grand_amount_credit'] + 
                                                                    @$journal_sales['grand_amount_credit'] + @$journal_direct_income['grand_amount_credit'] + 
                                                                    @$journal_indirect_expenses['grand_amount_credit'] + @$journal_indirect_income['grand_amount_credit'];
                                            @endphp 
                                        <tr class="grand-total-trial-balance">
                                                <td><strong>Grand Total</strong> </td>
                                                <td><span class="float-left"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR. "; }?> {{number_format(@$grand_total_debit)}} </strong></span></td>
                                                <td> <span class="float-left"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR. "; }?> {{number_format(@$grand_total_credit)}} </strong></span></td>
                                       
                                        </tr>

                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                    </div>
                   

                    <!-- <div class="row">
                        <div class="col-sm-6 left-trial-balance">
                            <div>
                                <h4 class="m-b-10"><strong>Dr.</strong></h4>
                                <table class="table table-bordered">
                                    <tbody  >
                                    @php $left_count = 0; @endphp 
                                        @if(!empty($journal_capital_account['journal_pl_data']))

                                            @foreach(@$journal_capital_account['journal_pl_data'] as $key_journal_capital_account => $value_journal_capital_account)
                                                @if($value_journal_capital_account[1] !=0 && $value_journal_capital_account[0]=="debit")
                                                    <tr>
                                                            <td><span>{{ucwords(@$key_journal_capital_account)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_capital_account[1])}}</span></td>
                                                        </tr>
                                                    @php $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                                
                                        @if(!empty($journal_non_current_liabilities['journal_pl_data']))

                                            @foreach(@$journal_non_current_liabilities['journal_pl_data'] as $key_journal_non_current_liabilities => $value_journal_non_current_liabilities)
                                                @if($value_journal_non_current_liabilities[1] !=0 && $value_journal_non_current_liabilities[0]=="debit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_non_current_liabilities)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_non_current_liabilities[1])}}</span></td>
                                                    
                                                    </tr>
                                                    @php $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif

                                    
                                        @if(!empty($journal_current_liabilities['journal_pl_data']))

                                            @foreach(@$journal_current_liabilities['journal_pl_data'] as $key_journal_current_liabilities => $value_journal_current_liabilities)
                                                @if($value_journal_current_liabilities[1] !=0 && $value_journal_current_liabilities[0]=="debit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_current_liabilities)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_current_liabilities[1])}}</span></td>
                                                    </tr>
                                                    @php $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                        
                                  
                                        @if(!empty($journal_non_current_assets['journal_pl_data']))

                                            @foreach(@$journal_non_current_assets['journal_pl_data'] as $key_journal_non_current_assets => $value_journal_non_current_assets)
                                                @if($value_journal_non_current_assets[1] !=0 && $value_journal_non_current_assets[0]=="debit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_non_current_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_non_current_assets[1])}}</span></td>
                                                    </tr>
                                                    @php  $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif

                                      
                                        @if(!empty($journal_current_assets['journal_pl_data']))

                                            @foreach(@$journal_current_assets['journal_pl_data'] as $key_journal_current_assets => $value_journal_current_assets)
                                                @if($value_journal_current_assets[1] !=0 && $value_journal_current_assets[0]=="debit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_current_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_current_assets[1])}}</span></td>
                                                    
                                                    </tr>
                                                    @php  $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                    
                                        @if(!empty($journal_fixed_assets['journal_pl_data']))
                                            @foreach(@$journal_fixed_assets['journal_pl_data'] as $key_journal_fixed_assets => $value_journal_fixed_assets)
                                                @if($value_journal_fixed_assets[1] !=0 && $value_journal_fixed_assets[0]=="debit")
                                                <tr>
                                                    <td><span>{{ucwords(@$key_journal_fixed_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_fixed_assets[1])}}</span></td>
                                                </tr>
                                                @php  $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                            
                                        @if(!empty($journal_investment['journal_pl_data']))
                                            @foreach(@$journal_investment['journal_pl_data'] as $key_journal_investment => $value_journal_investment)
                                                @if($value_journal_investment[1] !=0 && $value_journal_investment[0]=="debit")
                                                <tr>
                                                    <td><span>{{ucwords(@$key_journal_investment)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_investment[1])}}</span></td>
                                                </tr>
                                                @php  $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif


                                                 
                                        @if(!empty($journal_purchases['journal_pl_data']))

                                            @foreach(@$journal_purchases['journal_pl_data'] as $key_journal_purchases => $value_journal_purchases)
                                                @if($value_journal_purchases[1] !=0 && $value_journal_purchases[0]=="debit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_purchases)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_purchases[1])}}</span></td>
                                                    </tr>
                                                    @php $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif

                                               
                                        @if(!empty($journal_direct_expenses['journal_pl_data']))

                                            @foreach(@$journal_direct_expenses['journal_pl_data'] as $key_journal_direct_expenses => $value_journal_direct_expenses)
                                                @if($value_journal_direct_expenses[1] !=0 && $value_journal_direct_expenses[0]=="debit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_direct_expenses)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_direct_expenses[1])}}</span></td>
                                                    </tr>
                                                    @php $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif



                                        @if(!empty($journal_sales['journal_pl_data']))

                                            @foreach(@$journal_sales['journal_pl_data'] as $key_journal_sales => $value_journal_sales)
                                                @if($value_journal_sales[1] !=0 && $value_journal_sales[0]=="debit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_sales)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_sales[1])}}</span></td>
                                                    </tr>
                                                    @php  $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif

                                                

                                        @if(!empty($journal_direct_income['journal_pl_data']))
                                            @foreach(@$journal_direct_income['journal_pl_data'] as $key_journal_direct_income => $value_journal_direct_income)
                                                @if($value_journal_direct_income[1] !=0 && $value_journal_direct_income[0]=="debit")
                                                <tr>
                                                    <td><span>{{ucwords(@$key_journal_direct_income)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_direct_income[1])}}</span></td>
                                                </tr>
                                                @php  $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                                  
                                            
                                        @if(!empty($journal_indirect_expenses['journal_pl_data']))
                                            @foreach(@$journal_indirect_expenses['journal_pl_data'] as $key_journal_indirect_expenses => $value_journal_indirect_expenses)
                                                @if($value_journal_indirect_expenses[1] !=0 && $value_journal_indirect_expenses[0]=="debit")
                                                <tr>
                                                    <td><span>{{ucwords(@$key_journal_indirect_expenses)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_indirect_expenses[1])}}</span></td>
                                                </tr>
                                                @php $left_count = $left_count + 1; @endphp
                                                @endif

                                            @endforeach
                                        @endif


                                        @if(!empty($journal_indirect_income['journal_pl_data']))

                                            @foreach(@$journal_indirect_income['journal_pl_data'] as $key_journal_indirect_income => $value_journal_indirect_income)
                                                @if($value_journal_indirect_income[1] !=0 && $value_journal_indirect_income[0]=="debit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_indirect_income)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_indirect_income[1])}}</span></td>
                                                    </tr>
                                                    @php $left_count = $left_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                       
                                        @if(@$right_count > @$left_count)
                                       <?php $count = $right_count - $left_count;
                                        for($i =0 ; $i < $count; $i++){?>
                                             <tr class="trial-balance-hidden"><td><span>---------</span> <span class="float-right">---</span></td></tr>
                                           
                                       <?php }
                                        ?>
                                        @endif

                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <input id="left_value" type="hidden" value="{{@$left_count}}"/>

                        <div class="col-sm-6 right-trial-balance">
                            <div>
                                <h4 class="m-b-10"><strong>Cr.</strong></h4>
                                <table class="table table-bordered">
                                    <tbody >
                                    @php $right_count = 0; @endphp 
                                        @if(!empty($journal_capital_account['journal_pl_data']))

                                            @foreach(@$journal_capital_account['journal_pl_data'] as $key_journal_capital_account => $value_journal_capital_account)
                                                @if($value_journal_capital_account[1] !=0 && $value_journal_capital_account[0]=="credit")
                                                    <tr>
                                                            <td><span>{{ucwords(@$key_journal_capital_account)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_capital_account[1])}}</span></td>
                                                    </tr>
                                                    @php $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                                
                                        @if(!empty($journal_non_current_liabilities['journal_pl_data']))

                                            @foreach(@$journal_non_current_liabilities['journal_pl_data'] as $key_journal_non_current_liabilities => $value_journal_non_current_liabilities)
                                                @if($value_journal_non_current_liabilities[1] !=0 && $value_journal_non_current_liabilities[0]=="credit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_non_current_liabilities)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_non_current_liabilities[1])}}</span></td>
                                                    </tr>
                                                    @php $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif

                                    
                                        @if(!empty($journal_current_liabilities['journal_pl_data']))

                                            @foreach(@$journal_current_liabilities['journal_pl_data'] as $key_journal_current_liabilities => $value_journal_current_liabilities)
                                                @if($value_journal_current_liabilities[1] !=0 && $value_journal_current_liabilities[0]=="credit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_current_liabilities)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_current_liabilities[1])}}</span></td>
                                                    </tr>
                                                    @php $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                  
                                        @if(!empty($journal_non_current_assets['journal_pl_data']))

                                            @foreach(@$journal_non_current_assets['journal_pl_data'] as $key_journal_non_current_assets => $value_journal_non_current_assets)
                                                @if($value_journal_non_current_assets[1] !=0 && $value_journal_non_current_assets[0]=="credit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_non_current_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_non_current_assets[1])}}</span></td>
                                                    </tr>
                                                    @php  $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif

                                      
                                        @if(!empty($journal_current_assets['journal_pl_data']))

                                            @foreach(@$journal_current_assets['journal_pl_data'] as $key_journal_current_assets => $value_journal_current_assets)
                                                @if($value_journal_current_assets[1] !=0 && $value_journal_current_assets[0]=="credit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_current_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_current_assets[1])}}</span></td>
                                                    </tr>
                                                    @php  $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                            
                                        @if(!empty($journal_fixed_assets['journal_pl_data']))
                                            @foreach(@$journal_fixed_assets['journal_pl_data'] as $key_journal_fixed_assets => $value_journal_fixed_assets)
                                                @if($value_journal_fixed_assets[1] !=0 && $value_journal_fixed_assets[0]=="credit")
                                                <tr>
                                                    <td><span>{{ucwords(@$key_journal_fixed_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_fixed_assets[1])}}</span></td>
                                                </tr>
                                                @php  $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                
                                        @if(!empty($journal_investment['journal_pl_data']))
                                            @foreach(@$journal_investment['journal_pl_data'] as $key_journal_investment => $value_journal_investment)
                                                @if($value_journal_investment[1] !=0 && $value_journal_investment[0]=="credit")
                                                <tr>
                                                    <td><span>{{ucwords(@$key_journal_investment)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_investment[1])}}</span></td>
                                                </tr>
                                                @php  $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                                   

                                        @if(!empty($journal_purchases['journal_pl_data']))

                                            @foreach(@$journal_purchases['journal_pl_data'] as $key_journal_purchases => $value_journal_purchases)
                                                @if($value_journal_purchases[1] !=0 && $value_journal_purchases[0]=="credit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_purchases)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_purchases[1])}}</span></td>
                                                    </tr>
                                                    @php $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif

                                            
                                        @if(!empty($journal_direct_expenses['journal_pl_data']))

                                            @foreach(@$journal_direct_expenses['journal_pl_data'] as $key_journal_direct_expenses => $value_journal_direct_expenses)
                                                @if($value_journal_direct_expenses[1] !=0 && $value_journal_direct_expenses[0]=="credit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_direct_expenses)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_direct_expenses[1])}}</span></td>
                                                    </tr>
                                                    @php $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif



                                        @if(!empty($journal_sales['journal_pl_data']))

                                            @foreach(@$journal_sales['journal_pl_data'] as $key_journal_sales => $value_journal_sales)
                                                @if($value_journal_sales[1] !=0 && $value_journal_sales[0]=="credit")
                                                    <tr>
                                                        <td><span>{{ucwords(@$key_journal_sales)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_sales[1])}}</span></td>
                                                    </tr>
                                                    @php  $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif

                                                

                                        @if(!empty($journal_direct_income['journal_pl_data']))
                                            @foreach(@$journal_direct_income['journal_pl_data'] as $key_journal_direct_income => $value_journal_direct_income)
                                                @if($value_journal_direct_income[1] !=0 && $value_journal_direct_income[0]=="credit")
                                                <tr>
                                                    <td><span>{{ucwords(@$key_journal_direct_income)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_direct_income[1])}}</span></td>
                                                </tr>
                                                @php  $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                                

                                        @if(!empty($journal_indirect_expenses['journal_pl_data']))
                                            @foreach(@$journal_indirect_expenses['journal_pl_data'] as $key_journal_indirect_expenses => $value_journal_indirect_expenses)
                                                @if($value_journal_indirect_expenses[1] !=0 && $value_journal_indirect_expenses[0]=="credit")
                                                <tr>
                                                    <td><span>{{ucwords(@$key_journal_indirect_expenses)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_indirect_expenses[1])}}</span></td>
                                                </tr>
                                                @php $right_count = $right_count + 1; @endphp
                                                @endif

                                            @endforeach
                                        @endif

                                       
                                        @if(!empty($journal_indirect_income['journal_pl_data']))

                                            @foreach(@$journal_indirect_income['journal_pl_data'] as $key_journal_indirect_income => $value_journal_indirect_income)
                                                @if($value_journal_indirect_income[1] !=0 && $value_journal_indirect_income[0]=="credit")
                                                    
                                                    <tr >
                                                        <td><span>{{ucwords(@$key_journal_indirect_income)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_indirect_income[1])}}</span></td>
                                                    </tr>
                                                    @php $right_count = $right_count + 1; @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                       
                                        @if(@$left_count > @$right_count)
                                       <?php $count = $left_count - $right_count;
                                        for($i =0 ; $i < $count; $i++){?>
                                             <tr class="trial-balance-hidden"><td><span>---------</span> <span class="float-right">---</span></td></tr>
                                           
                                       <?php }
                                        ?>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <input id="right_value" type="hidden" value="{{@$right_count}}"/>
                    
                    </div> -->
                    <!-- <div class="row">
                            <div class="col-sm-6 left-trial-balance">
                                <div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            @php
                                               $grand_total_debit = @$journal_non_current_liabilities['grand_amount_debit'] + 
                                                                    @$journal_capital_account['grand_amount_debit'] + @$journal_current_liabilities['grand_amount_debit'] +
                                                                    @$journal_current_assets['grand_amount_debit'] + @$journal_fixed_assets['grand_amount_debit'] + 
                                                                    @$journal_investment['grand_amount_debit'] + @$journal_non_current_assets['grand_amount_debit'] +
                                                                    @$journal_purchases['grand_amount_debit'] + @$journal_direct_expenses['grand_amount_debit'] + 
                                                                    @$journal_sales['grand_amount_debit'] + @$journal_direct_income['grand_amount_debit'] + 
                                                                    @$journal_indirect_expenses['grand_amount_debit'] + @$journal_indirect_income['grand_amount_debit'];
                                            @endphp 
                                           
                                            <tr>
                                                <td><strong>Grand Total</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR. "; }?> {{number_format(@$grand_total_debit)}} </strong></span></td>
                                            </tr>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="col-sm-6 right-trial-balance">
                                <div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            @php
                                               $grand_total_credit = @$journal_non_current_liabilities['grand_amount_credit'] + 
                                                                    @$journal_capital_account['grand_amount_credit'] + @$journal_current_liabilities['grand_amount_credit'] +
                                                                    @$journal_current_assets['grand_amount_credit'] + @$journal_fixed_assets['grand_amount_credit'] + 
                                                                    @$journal_investment['grand_amount_credit'] + @$journal_non_current_assets['grand_amount_credit'] +
                                                                    @$journal_purchases['grand_amount_credit'] + @$journal_direct_expenses['grand_amount_credit'] + 
                                                                    @$journal_sales['grand_amount_credit'] + @$journal_direct_income['grand_amount_credit'] + 
                                                                    @$journal_indirect_expenses['grand_amount_credit'] + @$journal_indirect_income['grand_amount_credit'];
                                            @endphp 
                                            <tr>
                                                <td><strong>Grand Total</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR. "; }?> {{number_format(@$grand_total_credit)}} </strong></span></td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                    </div> -->
                  
                </div>
            </div>
    </div>

</div>