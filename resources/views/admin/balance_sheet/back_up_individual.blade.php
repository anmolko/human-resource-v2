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
                                                <section class="heading-profit-loss"><strong >Capital Account</strong> 
                                                <strong class="float-right">
                                                @if(@$journal_capital_account['grand_amount'] !=0)
                                                <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>{{number_format(@$journal_capital_account['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                    </strong>
                                                    </section>
                                                <table class="table">
                                                <tbody>
                                                @php $left_count = 0; @endphp 
                                                @if(!empty($journal_capital_account['journal_pl_data']))

                                                    @foreach(@$journal_capital_account['journal_pl_data'] as $key_journal_capital_account => $value_journal_capital_account)
                                                        @if($value_journal_capital_account[1] !=0)
                                                            <tr>
                                                                <td class="<?php if($value_journal_capital_account[0]=="debit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_journal_capital_account)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_capital_account[1])}}</span></td>
                                                            </tr>
                                                            @php $left_count = $left_count + 1; @endphp
                                                        @endif
                                                    @endforeach
                                                @endif

                                                </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            
                                            <td >
                                                <section class="heading-profit-loss"><strong >Non Current Liabilities</strong> 
                                                <strong class="float-right">
                                                @if(@$journal_non_current_liabilities['grand_amount'] !=0)
                                                <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_non_current_liabilities['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                </strong></section>
                                                <table class="table">
                                                <tbody >
                                                @if(!empty($journal_non_current_liabilities['journal_pl_data']))

                                                    @foreach(@$journal_non_current_liabilities['journal_pl_data'] as $key_journal_non_current_liabilities => $value_journal_non_current_liabilities)
                                                        @if($value_journal_non_current_liabilities[1] !=0)
                                                            <tr>
                                                                <td class="<?php if($value_journal_non_current_liabilities[0]=="debit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_journal_non_current_liabilities)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_non_current_liabilities[1])}}</span></td>
                                                            </tr>
                                                            @php $left_count = $left_count + 1; @endphp
                                                        @endif
                                                    @endforeach
                                                @endif



                                                </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td >
                                                <section class="heading-profit-loss"><strong >Current Liabilities</strong> 
                                                <strong class="float-right">
                                                @if(@$journal_current_liabilities['grand_amount'] !=0)
                                                <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_current_liabilities['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                </strong></section>
                                                <table class="table">
                                                <tbody id="left-section-current-liabilities">
                                                    @if(!empty($journal_current_liabilities['journal_pl_data']))

                                                        @foreach(@$journal_current_liabilities['journal_pl_data'] as $key_journal_current_liabilities => $value_journal_current_liabilities)
                                                            @if($value_journal_current_liabilities[1] !=0)
                                                                <tr>
                                                                    <td class="<?php if($value_journal_current_liabilities[0]=="debit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_journal_current_liabilities)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_current_liabilities[1])}}</span></td>
                                                                </tr>
                                                                @php $left_count = $left_count + 1; @endphp
                                                            @endif
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
                                                                <td class="text-danger"><span>Nett Loss</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$p)}}</span></td>
                                                                    @php  $left_count = $left_count + 1; @endphp
                                                                @elseif($key=="nett_profit" && $p !=0 )
                                                                <td ><span>Nett Profit</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$p)}}</span></td>
                                                                    @php  $left_count = $left_count + 1; @endphp
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

                        <input id="left_value" type="hidden" value="{{$left_count}}"/>

                        <div class="col-sm-6 right-balance-sheet">
                            <div>
                                <h4 class="m-b-10"><strong>Assets</strong></h4>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td >
                                                <section class="heading-profit-loss"><strong >Non Current Assets</strong> 
                                                <strong class="float-right">
                                                    @if(@$journal_non_current_assets['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>{{number_format(@$journal_non_current_assets['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                                </strong></section>
                                            <table class="table">
                                            <tbody>

                                                @php $right_count = 0 @endphp
                                                @if(!empty($journal_non_current_assets['journal_pl_data']))

                                                @foreach(@$journal_non_current_assets['journal_pl_data'] as $key_journal_non_current_assets => $value_journal_non_current_assets)
                                                    @if($value_journal_non_current_assets[1] !=0)
                                                        <tr>
                                                            <td class="<?php if($value_journal_non_current_assets[0]=="credit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_journal_non_current_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_non_current_assets[1])}}</span></td>
                                                        </tr>
                                                        @php  $right_count = $right_count + 1; @endphp
                                                    @endif
                                                @endforeach
                                                @endif

                                            </tbody>
                                            </table>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td >
                                            <section class="heading-profit-loss"><strong >Current Assets</strong> 
                                            <strong class="float-right">
                                                @if(@$journal_current_assets['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_current_assets['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                            </strong></section>
                                                <table class="table">
                                                <tbody  >
                                                    @php $right_count = 0 @endphp
                                                    @if(!empty($journal_current_assets['journal_pl_data']))

                                                        @foreach(@$journal_current_assets['journal_pl_data'] as $key_journal_current_assets => $value_journal_current_assets)
                                                            @if($value_journal_current_assets[1] !=0)
                                                                <tr>
                                                                    <td class="<?php if($value_journal_current_assets[0]=="credit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_journal_current_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_current_assets[1])}}</span></td>
                                                                </tr>
                                                                @php  $right_count = $right_count + 1; @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td >
                                            <section class="heading-profit-loss"><strong >Fixed Assets</strong> 
                                            <strong class="float-right">
                                                @if(@$journal_fixed_assets['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_fixed_assets['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                            </strong></section>
                                                <table class="table">
                                                <tbody >
                                                    @if(!empty($journal_fixed_assets['journal_pl_data']))
                                                        @foreach(@$journal_fixed_assets['journal_pl_data'] as $key_journal_fixed_assets => $value_journal_fixed_assets)
                                                            @if($value_journal_fixed_assets[1] !=0)
                                                            <tr>
                                                                <td class="<?php if($value_journal_fixed_assets[0]=="credit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_journal_fixed_assets)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_fixed_assets[1])}}</span></td>
                                                            </tr>
                                                            @php  $right_count = $right_count + 1; @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td >
                                            <section class="heading-profit-loss"><strong >Investment</strong> 
                                            <strong class="float-right">
                                                @if(@$journal_investment['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_investment['grand_amount'])}}
                                                    @else
                                                    NIL
                                                    @endif
                                            </strong></section>
                                                <table class="table">
                                                    <tbody id="right-section-investment" >
                                                    @if(!empty($journal_investment['journal_pl_data']))
                                                        @foreach(@$journal_investment['journal_pl_data'] as $key_journal_investment => $value_journal_investment)
                                                            @if($value_journal_investment[1] !=0)
                                                            <tr>
                                                                <td class="<?php if($value_journal_investment[0]=="credit"){ echo "text-danger"; } ?>"><span>{{ucwords(@$key_journal_investment)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_investment[1])}}</span></td>
                                                            </tr>
                                                            @php  $right_count = $right_count + 1; @endphp
                                                            @endif
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

                        <input id="right_value" type="hidden" value="{{$right_count}}"/>
                    
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