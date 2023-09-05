<div class="row align-items-center report-groups">
    <div class="col">
    </div>
    <div class="col-auto float-right ml-auto">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white" id="generate-pdf">PDF</button>
            <button class="btn btn-white" onclick="printerDiv('profit-loss-single-data')"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div>
</div>

<div class="row" id="profit-loss-single-data">
    <div class="col-md-12">
            <div class="card" id="profit-loss-single-data-card">
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
                                <h4 class="text-uppercase accountname">Profit & Loss Account</h4>
                                <ul class="list-unstyled">
                                <input type="hidden" id="profit_from" value="{{@$from}}"/>
                                <input type="hidden" id="profit_to" value="{{@$to}}"/>

                                    <li>From: <span>{{@$from}}</span></li>
                                    <li>To: <span>{{@$to}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                            <div class="col-sm-6 left-profit-loss">
                                <div>
                                    <h4 class="m-b-10"><strong>Particulars</strong></h4>
                                    <table class="table table-bordered">
                                        <tbody >
                                            <tr>
                                                <td >
                                                    <section class="heading-profit-loss"><strong >Purchases</strong> 
                                                    <strong class="float-right">
                                                    @if(@$journal_purchases['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>{{number_format(@$journal_purchases['grand_amount'])}}
                                                     @else
                                                     NIL
                                                     @endif
                                                     </strong>
                                                     </section>
                                                    <table class="table">
                                                    <tbody>
                                                    @php $left_count = 0; @endphp 
                                                    @if(!empty($journal_purchases['journal_pl_data']))

                                                        @foreach(@$journal_purchases['journal_pl_data'] as $key_journal_purchases => $value_journal_purchases)
                                                            @if($value_journal_purchases !=0)
                                                                <tr>
                                                                    <td><span>{{ucwords(@$key_journal_purchases)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_purchases)}}</span></td>
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
                                                    <section class="heading-profit-loss"><strong >Direct Expenses</strong> 
                                                    <strong class="float-right">
                                                    @if(@$journal_direct_expenses['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_direct_expenses['grand_amount'])}}
                                                     @else
                                                     NIL
                                                     @endif
                                                    </strong></section>
                                                    <table class="table">
                                                    <tbody id="left-section-direct-expense">
                                                    @if(!empty($journal_direct_expenses['journal_pl_data']))

                                                        @foreach(@$journal_direct_expenses['journal_pl_data'] as $key_journal_direct_expenses => $value_journal_direct_expenses)
                                                            @if($value_journal_direct_expenses !=0)
                                                                <tr>
                                                                    <td><span>{{ucwords(@$key_journal_direct_expenses)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_direct_expenses)}}</span></td>
                                                                </tr>
                                                                @php $left_count = $left_count + 1; @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif



                                                    </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                          @php
                                             $left_section_first = @$journal_purchases['grand_amount'] + @$journal_direct_expenses['grand_amount'];
                                             $right_section_first = @$journal_sales['grand_amount'] + @$journal_direct_income['grand_amount'];
                                         @endphp

                                            @if($right_section_first > $left_section_first)

                                            @php $gross_profit = $right_section_first - $left_section_first; @endphp
                                            <tr>
                                                <td><strong>Gross Profit c/d</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$right_section_first - $left_section_first)}}</strong></span></td>
                                            </tr>
                                            @else
                                            @php $gross_profit = 0; @endphp
                                            <tr class="profit-loss-table-row"><td><strong>Gross Profit</strong> <strong class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> 0</strong></td></tr>
                                            @endif

                                            @php $first_left_total = $gross_profit + $left_section_first  ; @endphp

                                            <tr>
                                                <td><strong>Total</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$first_left_total)}}</strong></span></td>
                                            </tr>



                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <input id="left_value" type="hidden" value="{{$left_count}}"/>

                            <div class="col-sm-6 right-profit-loss">
                                <div>
                                    <h4 class="m-b-10"><strong>Particulars</strong></h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td >
                                                    <section class="heading-profit-loss"><strong >Sales</strong> 
                                                    <strong class="float-right">
                                                     @if(@$journal_sales['grand_amount'] !=0)
                                                     <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?>{{number_format(@$journal_sales['grand_amount'])}}
                                                     @else
                                                     NIL
                                                     @endif
                                                    </strong></section>
                                                <table class="table">
                                                <tbody>

                                                @php $right_count = 0 @endphp
                                                 @if(!empty($journal_sales['journal_pl_data']))

                                                    @foreach(@$journal_sales['journal_pl_data'] as $key_journal_sales => $value_journal_sales)
                                                        @if($value_journal_sales !=0)
                                                            <tr>
                                                                <td><span>{{ucwords(@$key_journal_sales)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_sales)}}</span></td>
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
                                                <section class="heading-profit-loss"><strong >Direct Incomes</strong> 
                                                <strong class="float-right">
                                                    @if(@$journal_direct_income['grand_amount'] !=0)
                                                     <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_direct_income['grand_amount'])}}
                                                     @else
                                                     NIL
                                                     @endif
                                                </strong></section>
                                                    <table class="table">
                                                    <tbody  id="right-section-direct-income">
                                                    @if(!empty($journal_direct_income['journal_pl_data']))
                                                        @foreach(@$journal_direct_income['journal_pl_data'] as $key_journal_direct_income => $value_journal_direct_income)
                                                            @if($value_journal_direct_income !=0)
                                                            <tr>
                                                                <td><span>{{ucwords(@$key_journal_direct_income)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_direct_income)}}</span></td>
                                                            </tr>
                                                            @php  $right_count = $right_count + 1; @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                          
                                            @if($left_section_first > $right_section_first)
                                            @php $gross_loss = $left_section_first - $right_section_first; @endphp

                                            <tr>
                                                <td><strong>Gross Loss b/d</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$left_section_first - $right_section_first)}}</strong></span></td>
                                            </tr>
                                            @else
                                            @php $gross_loss = 0; @endphp
                                            <tr class="profit-loss-table-row"><td><strong>Gross Loss</strong> <strong class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> 0</strong></td></tr>
                                            @endif
                                            @php $first_right_total = $gross_loss  + $right_section_first ; @endphp

                                            <tr>
                                                <td><strong>Total</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$first_right_total)}}</strong></span></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <input id="right_value" type="hidden" value="{{$right_count}}"/>
                            
                    </div>
                    <div class="row">
                            <div class="col-sm-6 left-profit-loss">
                                <div>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                                <td><strong>Loss c/d</strong> <span class="float-right"><strong>
                                                @if(@$gross_loss!=0)
                                                <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$gross_loss)}}
                                                @else
                                                NIL
                                                @endif
                                                </strong></span></td>
                                            </tr>

                                            <tr>
                                                <td >
                                                    <section class="heading-profit-loss"><strong >Indirect Expenses</strong> 
                                                    <strong class="float-right">
                                                    @if(@$journal_indirect_expenses['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_indirect_expenses['grand_amount'])}}
                                                     @else
                                                     NIL
                                                     @endif
                                                    </strong></section>
                                                    <table class="table">
                                                    <tbody id="left-section-indirect-expense">
                                                    @php $left_count_second = 0; @endphp 
                                                    @if(!empty($journal_indirect_expenses['journal_pl_data']))
                                                        @foreach(@$journal_indirect_expenses['journal_pl_data'] as $key_journal_indirect_expenses => $value_journal_indirect_expenses)
                                                            @if($value_journal_indirect_expenses !=0)
                                                            <tr>
                                                                <td><span>{{ucwords(@$key_journal_indirect_expenses)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_indirect_expenses)}}</span></td>
                                                            </tr>
                                                            @php $left_count_second = $left_count_second + 1; @endphp
                                                            @endif

                                                        @endforeach
                                                    @endif

                                                    </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            
                                            @php
                                             $left_section_second = @$gross_loss + @$journal_indirect_expenses['grand_amount'];
                                             $right_section_second = @$gross_profit + @$journal_indirect_income['grand_amount'];
                                             @endphp

                                                @if($right_section_second > $left_section_second)

                                                @php $nett_profit = $right_section_second - $left_section_second; @endphp
                                                <tr>
                                                    <td><strong>Nett Profit</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format($nett_profit)}}</strong></span></td>
                                                </tr>
                                                @else
                                                @php $nett_profit = 0; @endphp
                                                    <tr class="profit-loss-table-row"><td><strong>Nett Profit</strong> <strong class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> 0</strong></td></tr>
                                                @endif
                                               
                                            @php $second_left_total = $nett_profit  + $left_section_second ; @endphp

                                            <tr>
                                                <td><strong>Grand Total</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$second_left_total)}}</strong></span></td>
                                            </tr>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <input id="left_value_second" type="hidden" value="{{$left_count_second}}"/>


                            <div class="col-sm-6 right-profit-loss">
                                <div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>Profit b/d</strong> <span class="float-right"><strong>
                                                @if(@$gross_profit!=0)
                                                <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$gross_profit)}}
                                                @else
                                                NIL
                                                @endif
                                                </strong></span></td>
                                            </tr>

                                            <tr>
                                                <td >
                                                    <section class="heading-profit-loss"><strong >Indirect Incomes</strong> 
                                                    <strong class="float-right"> 
                                                    @if(@$journal_indirect_income['grand_amount'] !=0)
                                                    <?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$journal_indirect_income['grand_amount'])}}
                                                     @else
                                                     NIL
                                                     @endif
                                                    </strong></section>
                                                <table class="table">
                                                <tbody id="right-section-indirect-income">
                                                @php $right_count_second = 0 @endphp
                                                 @if(!empty($journal_indirect_income['journal_pl_data']))

                                                    @foreach(@$journal_indirect_income['journal_pl_data'] as $key_journal_indirect_income => $value_journal_indirect_income)
                                                        @if($value_journal_indirect_income !=0)
                                                            <tr>
                                                                <td><span>{{ucwords(@$key_journal_indirect_income)}}</span> <span class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$value_journal_indirect_income)}}</span></td>
                                                            </tr>
                                                            @php $right_count_second = $right_count_second + 1; @endphp
                                                        @endif
                                                    @endforeach
                                                   @endif

                                                </tbody>
                                                </table>
                                                </td>
                                            </tr>

                                            @if($left_section_second > $right_section_second)

                                            @php $nett_loss = $left_section_second - $right_section_second; @endphp
                                            <tr>
                                                <td><strong>Nett Loss</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format($nett_loss)}}</strong></span></td>
                                            </tr>
                                            @else
                                            @php $nett_loss = 0; @endphp
                                                <tr class="profit-loss-table-row"><td><strong>Nett Loss</strong> <strong class="float-right"><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> 0</strong></td></tr>
                                            @endif
                                            
                                            

                                            @php $second_right_total = $nett_loss  + $right_section_second ; @endphp

                                            <tr>
                                                <td><strong>Grand Total</strong> <span class="float-right"><strong><?php if(@$theme_data->currency){?>{{ strtoupper(@$theme_data->currency)}}<?php }else{ echo "NPR."; }?> {{number_format(@$second_right_total)}}</strong></span></td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <input id="right_value_second" type="hidden" value="{{$right_count_second}}"/>

                            
                    </div>

                    
                </div>
            </div>
    </div>

</div>