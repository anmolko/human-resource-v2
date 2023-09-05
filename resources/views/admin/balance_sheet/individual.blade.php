<div class="row align-items-center report-groups">
    <div class="col">
    </div>
    <div class="col-auto float-right ml-auto">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white" id="generate-pdf">PDF</button>
            <button class="btn btn-white" onclick="printerDiv('balance-sheet-single-data')"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div>
</div>

<div class="row" id="balance-sheet-single-data">
    <div class="col-md-12">
            <div class="card" id="balance-sheet-single-data-card">
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
                                <h4 class="text-uppercase accountname">Balance Sheet</h4>
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
                        <div class="col-sm-6 left-balance-sheet">
                            <div>
                                <h4 class="m-b-10"><strong>Liabilities</strong></h4>
                                <table class="table table-bordered">
                                    <tbody >
                                        <tr>
                                            <td >
                                                <section class="heading-profit-loss"><h4><strong>Capital Account 
                                                <span class="float-right">
                                                @if(@$journal_capital_account['grand_amount'] !=0)
                                                <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>{{number_format(@$journal_capital_account['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                </span></strong></h4></section>
                                                <table class="table">
                                                <tbody>
                                                @if(!empty($journal_capital_account['primary']))
                                                @php $total_primary = 0 @endphp

                                                    @foreach(@$journal_capital_account['primary'] as $primary_key_data => $secondary_value_journal_capital_account)
                                                    <tr>
                                                        <td> 
                                                            <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} 
                                                                </strong>
                                                            </section>
                                                            <table class="table inner-secondary">
                                                                <tbody>
                                                                    @foreach(@$secondary_value_journal_capital_account as $secondary_key_data => $secondary_value)
                                                                        @foreach(@$secondary_value as $key_data => $secondary)
                                                                        @if($secondary[1] !=0)
                                                                            <tr>
                                                                                <td class="<?php if($secondary[0]=="debit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_data)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary[1])}}</span></td>
                                                                            </tr>
                                                                            @if($secondary[0] =="debit")
                                                                                    @php  $total_primary = $total_primary - @$secondary[1]; @endphp
                                                                                @else
                                                                                @php  $total_primary = $total_primary + @$secondary[1]; @endphp

                                                                                @endif
                                                                        @endif
                                                                    
                                                                        @endforeach
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} Total
                                                                <span class="float-right ">

                                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>  {{number_format($total_primary)}} 

                                                                </span>
                                                                </strong>
                                                            </section>
                                                            @php $total_primary = 0; $total_debit = 0; $total_credit = 0; @endphp

                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif

                                                </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            
                                            <td >
                                                <section class="heading-profit-loss"><h4><strong>Non Current Liabilities
                                                <span class="float-right">
                                                @if(@$journal_non_current_liabilities['grand_amount'] !=0)
                                                <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_non_current_liabilities['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                </span></strong></h4></section>
                                                <table class="table">
                                                <tbody >

                                                @if(!empty($journal_non_current_liabilities['primary']))
                                                @php $total_primary = 0 @endphp

                                                    @foreach(@$journal_non_current_liabilities['primary'] as $primary_key_data => $secondary_value_journal_non_current_liabilities)
                                                    <tr>
                                                        <td> 
                                                            <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} 
                                                                </strong>
                                                            </section>
                                                            <table class="table inner-secondary">
                                                                <tbody>
                                                                    @foreach(@$secondary_value_journal_non_current_liabilities as $secondary_key_data => $secondary_value)
                                                                        @foreach(@$secondary_value as $key_data => $secondary)
                                                                        @if($secondary[1] !=0)
                                                                            <tr>
                                                                                <td class="<?php if($secondary[0]=="debit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_data)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary[1])}}</span></td>
                                                                            </tr>
                                                                            @if($secondary[0] =="debit")
                                                                                    @php  $total_primary = $total_primary - @$secondary[1]; @endphp
                                                                                @else
                                                                                @php  $total_primary = $total_primary + @$secondary[1]; @endphp

                                                                                @endif
                                                                        @endif
                                                                    
                                                                        @endforeach
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} Total
                                                                    <span class="float-right ">

                                                                        <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>  {{number_format($total_primary)}} 

                                                                    </span>
                                                                    </strong>
                                                                </section>
                                                                @php $total_primary = 0; $total_debit = 0; $total_credit = 0; @endphp

                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif

                                                </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td >
                                                <section class="heading-profit-loss"><h4><strong>Current Liabilities
                                                <span class="float-right">
                                                @if(@$journal_current_liabilities['grand_amount'] !=0)
                                                <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_current_liabilities['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                </span>
                                                </strong></h4></section>
                                                <table class="table">
                                                <tbody id="left-section-current-liabilities">

                                                    @if(!empty($journal_current_liabilities['primary']))
                                                        @php $total_primary = 0; $total_debit = 0; $total_credit = 0; @endphp

                                                        @foreach(@$journal_current_liabilities['primary'] as $primary_key_data => $secondary_value_journal_current_liabilities)
                                                        <tr>
                                                            <td> 
                                                                <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} 
                                                                    </strong>
                                                                </section>
                                                                <table class="table inner-secondary">
                                                                    <tbody>
                                                                        @foreach(@$secondary_value_journal_current_liabilities as $secondary_key_data => $secondary_value)
                                                                            @foreach(@$secondary_value as $key_data => $secondary)
                                                                            @if($secondary[1] !=0)
                                                                                <tr>
                                                                                    <td class="<?php if($secondary[0]=="debit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_data)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary[1])}}</span></td>
                                                                                </tr>
                                                                                @if($secondary[0] =="debit")
                                                                                    @php  $total_primary = $total_primary - @$secondary[1]; @endphp
                                                                                @else
                                                                                @php  $total_primary = $total_primary + @$secondary[1]; @endphp

                                                                                @endif
                                                                            @endif
                                                                        
                                                                            @endforeach
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                               
                                                                <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} Total
                                                                    <span class="float-right ">

                                                                        <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>  {{number_format($total_primary)}} 

                                                                    </span>
                                                                    </strong>
                                                                </section>
                                                                 @php $total_primary = 0; $total_debit = 0; $total_credit = 0; @endphp

                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif

                                                </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                
                                        <tr>
                                            <td >
                                            <section class="heading-profit-loss"><strong >Profit & Loss A/C</strong> 
                                            <strong class="float-right">
                                            @foreach($profitloss as $key => $p)
                                                @if($key=="nett_loss" && $p !=0 )
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> -{{number_format(@$p)}}
                                                @elseif($key=="nett_profit" && $p !=0 )
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$p)}}
                                                @endif
                                            @endforeach
                                            </strong></section>
                                                <table class="table">
                                                    <tbody >
                                                        @foreach($profitloss as $key => $p)
                                                            <tr>
                                                                @if($key=="nett_loss" && $p !=0 )
                                                                <td class="text-danger"><span>Net Loss</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$p)}}</span></td>
                                                                @elseif($key=="nett_profit" && $p !=0 )
                                                                <td ><span>Net Profit</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$p)}}</span></td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-6 right-balance-sheet">
                            <div>
                                <h4 class="m-b-10"><strong>Assets</strong></h4>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td >
                                                <section class="heading-profit-loss"><h4><strong >Non Current Assets 
                                                <span class="float-right">
                                                    @if(@$journal_non_current_assets['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>{{number_format(@$journal_non_current_assets['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                </span></strong></h4></section>
                                            <table class="table">
                                            <tbody>

                                                @if(!empty($journal_non_current_assets['primary']))
                                                @php $total_primary = 0 @endphp

                                                    @foreach(@$journal_non_current_assets['primary'] as $primary_key_data => $secondary_value_journal_non_current_assets)
                                                    <tr>
                                                        <td> 
                                                            <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} 
                                                              
                                                                </strong>
                                                            </section>
                                                            <table class="table inner-secondary">
                                                                <tbody>
                                                                    @foreach(@$secondary_value_journal_non_current_assets as $secondary_key_data => $secondary_value)
                                                                        @foreach(@$secondary_value as $key_data => $secondary)
                                                                        @if($secondary[1] !=0)
                                                                            <tr>
                                                                                <td class="<?php if($secondary[0]=="credit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_data)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary[1])}}</span></td>
                                                                            </tr>
                                                                            @if($secondary[0] =="credit")
                                                                                    @php  $total_primary = $total_primary - @$secondary[1]; @endphp
                                                                                @else
                                                                                @php  $total_primary = $total_primary + @$secondary[1]; @endphp

                                                                                @endif

                                                                        @endif
                                                                    
                                                                        @endforeach
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} Total
                                                                    <span class="float-right ">

                                                                        <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>  {{number_format($total_primary)}} 

                                                                    </span>
                                                                    </strong>
                                                                </section>
                                                                @php $total_primary = 0; $total_debit = 0; $total_credit = 0; @endphp

                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif

                                            </tbody>
                                            </table>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td >
                                            <section class="heading-profit-loss"><h4><strong >Current Assets 
                                                <span class="float-right">
                                                    @if(@$journal_current_assets['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_current_assets['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                </span></strong></h4></section>
                                                <table class="table">
                                                <tbody  >
                                                    @if(!empty($journal_current_assets['primary']))
                                                         @php $total_primary = 0 @endphp
                                                        @foreach(@$journal_current_assets['primary'] as $primary_key_data => $secondary_value_journal_current_assets)
                                                        <tr>
                                                            <td> 
                                                                <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} 
                                                                    
                                                                    </strong>
                                                                </section>
                                                                <table class="table inner-secondary">
                                                                    <tbody>
                                                                        @foreach(@$secondary_value_journal_current_assets as $secondary_key_data => $secondary_value)
                                                                            @foreach(@$secondary_value as $key_data => $secondary)
                                                                            @if($secondary[1] !=0)
                                                                                <tr>
                                                                                    <td class="<?php if($secondary[0]=="credit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_data)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary[1])}}</span></td>
                                                                                </tr>
                                                                                @if($secondary[0] =="credit")
                                                                                    @php  $total_primary = $total_primary - @$secondary[1]; @endphp
                                                                                @else
                                                                                @php  $total_primary = $total_primary + @$secondary[1]; @endphp

                                                                                @endif
                                                                            @endif
                                                                        
                                                                            @endforeach
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} Total
                                                                    <span class="float-right ">

                                                                        <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>  {{number_format($total_primary)}} 

                                                                    </span>
                                                                    </strong>
                                                                </section>
                                                                @php $total_primary = 0; $total_debit = 0; $total_credit = 0; @endphp

                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif

                                                </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td >
                                            <section class="heading-profit-loss"><h4><strong >Fixed Assets 
                                                <span class="float-right">
                                                    @if(@$journal_fixed_assets['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_fixed_assets['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                </span></strong></h4></section>
                                                <table class="table">
                                                <tbody >

                                                    @if(!empty($journal_fixed_assets['primary']))
                                                    @php $total_primary = 0 @endphp

                                                        @foreach(@$journal_fixed_assets['primary'] as $primary_key_data => $secondary_value_journal_fixed_assets)
                                                        <tr>
                                                            <td> 
                                                                <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} 
                                                                   
                                                                    </strong>
                                                                </section>
                                                                <table class="table inner-secondary">
                                                                    <tbody>
                                                                        @foreach(@$secondary_value_journal_fixed_assets as $secondary_key_data => $secondary_value)
                                                                            @foreach(@$secondary_value as $key_data => $secondary)
                                                                            @if($secondary[1] !=0)
                                                                                <tr>
                                                                                    <td class="<?php if($secondary[0]=="credit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_data)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary[1])}}</span></td>
                                                                                </tr>
                                                                                @if($secondary[0] =="credit")
                                                                                    @php  $total_primary = $total_primary - @$secondary[1]; @endphp
                                                                                @else
                                                                                @php  $total_primary = $total_primary + @$secondary[1]; @endphp

                                                                                @endif
                                                                            @endif
                                                                        
                                                                            @endforeach
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} Total
                                                                    <span class="float-right ">

                                                                        <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>  {{number_format($total_primary)}} 

                                                                    </span>
                                                                    </strong>
                                                                </section>
                                                                @php $total_primary = 0; $total_debit = 0; $total_credit = 0; @endphp

                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td >
                                            <section class="heading-profit-loss"><h4><strong >Investment
                                                <span class="float-right">
                                                    @if(@$journal_investment['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_investment['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                </span></strong></h4> </section>
                                                <table class="table">
                                                    <tbody id="right-section-investment" >

                                                    @if(!empty($journal_investment['primary']))
                                                    @php $total_primary = 0 @endphp

                                                        @foreach(@$journal_investment['primary'] as $primary_key_data => $secondary_value_journal_investment)
                                                        <tr>
                                                            <td> 
                                                                <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} 
                                                                   
                                                                    </strong>
                                                                </section>
                                                                <table class="table inner-secondary">
                                                                    <tbody>
                                                                        @foreach(@$secondary_value_journal_investment as $secondary_key_data => $secondary_value)
                                                                            @foreach(@$secondary_value as $key_data => $secondary)
                                                                            @if($secondary[1] !=0)
                                                                                <tr>
                                                                                    <td class="<?php if($secondary[0]=="credit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_data)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$secondary[1])}}</span></td>
                                                                                </tr>
                                                                                @if($secondary[0] =="credit")
                                                                                    @php  $total_primary = $total_primary - @$secondary[1]; @endphp
                                                                                @else
                                                                                @php  $total_primary = $total_primary + @$secondary[1]; @endphp

                                                                                @endif
                                                                            @endif
                                                                        
                                                                            @endforeach
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <section class="heading-profit-loss"><strong >{{ucwords($primary_key_data)}} Total
                                                                    <span class="float-right ">

                                                                        <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>  {{number_format($total_primary)}} 

                                                                    </span>
                                                                    </strong>
                                                                </section>
                                                                @php $total_primary = 0; $total_debit = 0; $total_credit = 0; @endphp

                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    
                    </div>
                
                   
                    @if(@$journal_capital_account['grand_amount'] < 0 && @$journal_capital_account['grand_amount'] !=0)
                        @php $left_section =   @$journal_non_current_liabilities['grand_amount'] - abs(@$journal_capital_account['grand_amount']) + @$journal_current_liabilities['grand_amount']; @endphp
                    @elseif(@$journal_capital_account['grand_amount'] > 0 && @$journal_capital_account['grand_amount'] !=0)
                        @php $left_section =   @$journal_non_current_liabilities['grand_amount'] + @$journal_capital_account['grand_amount'] + @$journal_current_liabilities['grand_amount']; @endphp
                    @elseif(@$journal_non_current_liabilities['grand_amount'] < 0 && @$journal_non_current_liabilities['grand_amount'] !=0)
                        @php $left_section = @$journal_capital_account['grand_amount'] - abs(@$journal_non_current_liabilities['grand_amount']) + @$journal_current_liabilities['grand_amount']; @endphp
                    @elseif(@$journal_non_current_liabilities['grand_amount'] > 0 && @$journal_non_current_liabilities['grand_amount'] !=0)
                        @php $left_section = @$journal_capital_account['grand_amount'] + @$journal_non_current_liabilities['grand_amount'] + @$journal_current_liabilities['grand_amount']; @endphp
                    @elseif(@$journal_current_liabilities['grand_amount'] < 0 && @$journal_current_liabilities['grand_amount'] !=0)
                        @php $left_section = @$journal_capital_account['grand_amount']  + @$journal_non_current_liabilities['grand_amount'] - abs(@$journal_current_liabilities['grand_amount']); @endphp
                    @elseif(@$journal_current_liabilities['grand_amount'] > 0 && @$journal_current_liabilities['grand_amount'] !=0)
                        @php $left_section = @$journal_capital_account['grand_amount']  + @$journal_non_current_liabilities['grand_amount'] + @$journal_current_liabilities['grand_amount']; @endphp
                    @endif


                    @if(@$journal_non_current_assets['grand_amount'] < 0 && @$journal_non_current_assets['grand_amount'] !=0)
                        @php $right_section =  @$journal_current_assets['grand_amount'] + @$journal_fixed_assets['grand_amount'] + @$journal_investment['grand_amount'] - abs(@$journal_non_current_assets['grand_amount']); @endphp
                    @elseif(@$journal_non_current_assets['grand_amount'] > 0 && @$journal_non_current_assets['grand_amount'] !=0)
                        @php $right_section =  @$journal_current_assets['grand_amount'] + @$journal_fixed_assets['grand_amount'] + @$journal_investment['grand_amount'] + @$journal_non_current_assets['grand_amount']; @endphp
                    @elseif(@$journal_current_assets['grand_amount'] < 0 && @$journal_current_assets['grand_amount'] !=0)
                        @php $right_section =  @$journal_non_current_assets['grand_amount'] + @$journal_fixed_assets['grand_amount'] + @$journal_investment['grand_amount'] - abs(@$journal_current_assets['grand_amount']); @endphp
                    @elseif(@$journal_current_assets['grand_amount'] > 0 && @$journal_current_assets['grand_amount'] !=0)
                        @php $right_section =  @$journal_non_current_assets['grand_amount'] + @$journal_fixed_assets['grand_amount'] + @$journal_investment['grand_amount'] + @$journal_current_assets['grand_amount']; @endphp
                    @elseif(@$journal_fixed_assets['grand_amount'] < 0 && @$journal_fixed_assets['grand_amount'] !=0)
                        @php $right_section =  @$journal_current_assets['grand_amount'] + @$journal_non_current_assets['grand_amount'] + @$journal_investment['grand_amount'] - abs(@$journal_fixed_assets['grand_amount']); @endphp
                    @elseif(@$journal_fixed_assets['grand_amount'] > 0 && @$journal_fixed_assets['grand_amount'] !=0)
                        @php $right_section =  @$journal_current_assets['grand_amount'] + @$journal_non_current_assets['grand_amount'] + @$journal_investment['grand_amount'] + @$journal_fixed_assets['grand_amount']; @endphp
                    @elseif(@$journal_investment['grand_amount'] < 0 && @$journal_investment['grand_amount'] !=0)
                        @php $right_section =  @$journal_current_assets['grand_amount'] + @$journal_fixed_assets['grand_amount'] + @$journal_non_current_assets['grand_amount'] - abs(@$journal_investment['grand_amount']); @endphp
                    @elseif(@$journal_investment['grand_amount'] > 0 && @$journal_investment['grand_amount'] !=0)
                        @php $right_section =  @$journal_current_assets['grand_amount'] + @$journal_fixed_assets['grand_amount'] + @$journal_non_current_assets['grand_amount'] + @$journal_investment['grand_amount']; @endphp
                    @endif

                   
                    @foreach($profitloss as $key => $p)
                        @if($key=="nett_loss" && $p !=0 )
                            @php $left_grand_total = @$left_section - @$p; @endphp
                        @endif
                        
                        @if($key=="nett_profit" && $p !=0 )
                            @php $left_grand_total = $left_section + @$p; @endphp
                        @endif
                    @endforeach

                    <div class="row">
                            <div class="col-sm-6 left-balance-sheet">
                                <div>
                                    <table class="table table-bordered">
                                        <tbody>
                                     
                                            <tr>
                                                <td><strong>Grand Total</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR. "; }?> {{number_format(@$left_grand_total)}} </strong></span></td>
                                            </tr>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="col-sm-6 right-balance-sheet">
                                <div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            
                                            <tr>
                                                <td><strong>Grand Total</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR. "; }?> {{number_format(@$right_section)}} </strong></span></td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                    </div>

                    
                </div>
            </div>
    </div>

</div>