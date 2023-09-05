@include('admin.partials.header')
    <!-- Sidebar -->
    @include('admin.partials.processing_sidebar')
    <!-- /Sidebar -->


    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="custom-navbar" style="margin-top: 45px;">
            @php
                @$role=\App\Models\Role::find(session()->get('role_id'));
            @endphp
            <div class="custom-subnav">
                <button class="custom-subnavbtn">User Dashboard Items <i class="fa fa-caret-down"></i></button>
                <div class="custom-subnav-content">
                    @if(count($single_group) > 0)
                        @foreach($single_group  as $single)
                            @php @$module_single=\App\Models\Module::where('url',$single)->first(); @endphp
                            @if($single=='user')
                                <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>
                            @endif
                        @endforeach
                    @endif
                    @if(count($employee_group) > 0)
                        <span class="custom-subnav-child">
                      <button class="custom-subnavbtn-child">Employee Groups <i class="fa fa-caret-down"></i></button>
                      <div class="custom-subnav-content-child">
                          @foreach($employee_group  as $employe)
                              <a href="{{url('/'.$employe)}}">@if($employe=="employee") All Employee @endif</a>
                          @endforeach
                      </div>
                    </span>
                    @endif
                    @if(count($payroll_group) > 0)
                        <span class="custom-subnav-child">
                      <button class="custom-subnavbtn-child"> Payroll Groups <i class="fa fa-caret-down"></i></button>
                      <div class="custom-subnav-content-child">
                          @foreach($payroll_group  as $payroll)
                              <a href="{{url('/'.$payroll)}}"> @if($payroll=="employee-payroll")Payroll @elseif($payroll=="employee-payment") Employee Payment @endif </a>
                          @endforeach
                      </div>
                    </span>
                    @endif
                    @if(count($configuration_group) > 0)
                        <span class="custom-subnav-child">
                      <button class="custom-subnavbtn-child"> Configurations <i class="fa fa-caret-down"></i></button>
                      <div class="custom-subnav-content-child">
						 @foreach($configuration_group  as $configuration)
                              <a href="{{url('/'.$configuration)}}"> @if($configuration=="department") Department @elseif($configuration=="designation") Designation @endif
                            </a>
                          @endforeach
                      </div>
                    </span>
                    @endif
                    @if(@$role->name == 'admin')
                        <span class="custom-subnav-child">
                      <button class="custom-subnavbtn-child"> Access Control List <i class="fa fa-caret-down"></i></button>
                      <div class="custom-subnav-content-child">
                            <a href="{{route('module.index')}}">Modules</a>
                            <a href="{{route('role.index')}}">Roles</a>
                            <a href="{{route('permission.index')}}">Permissions</a>
                      </div>
                    </span>
                    @endif
                </div>
            </div>
{{--            <div class="custom-subnav">--}}
{{--                <button class="custom-subnavbtn">Account Dashboard Items <i class="fa fa-caret-down"></i></button>--}}
{{--                <div class="custom-subnav-content">--}}
{{--                    @if(count($single_group) > 0)--}}
{{--                        @foreach($single_group  as $single)--}}
{{--                            @php @$module_single=\App\Models\Module::where('url',$single)->first(); @endphp--}}
{{--                            @if($single=='ledger')--}}
{{--                                <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>--}}
{{--                            @elseif($single=='trial-balance')--}}
{{--                                <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>--}}

{{--                            @elseif($single=='profit-loss-account')--}}
{{--                                <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>--}}

{{--                            @elseif($single=='balance-sheet')--}}
{{--                                <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>--}}
{{--                            @endif--}}


{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                    @if(count($account_group) > 0)--}}
{{--                        <span class="custom-subnav-child">--}}
{{--                          <button class="custom-subnavbtn-child"> Account Groups <i class="fa fa-caret-down"></i></button>--}}
{{--                          <div class="custom-subnav-content-child">--}}
{{--                               @foreach($account_group  as $account)--}}
{{--                                  <a href="{{url('/'.$account)}}"> @if($account=="secondary-groups") Secondary Groups @elseif($account=="primary-groups") Primary Groups @else Attribute @endif--}}
{{--                                </a>--}}
{{--                              @endforeach--}}
{{--                          </div>--}}
{{--                    </span>--}}
{{--                    @endif--}}
{{--                    @if(count($voucher_group) > 0)--}}
{{--                        <span class="custom-subnav-child">--}}
{{--                          <button class="custom-subnavbtn-child"> Voucher Groups <i class="fa fa-caret-down"></i></button>--}}
{{--                          <div class="custom-subnav-content-child">--}}
{{--                              @foreach($voucher_group  as $voucher)--}}
{{--                                  <a href="{{url('/'.$voucher)}}"> @if($voucher=="receipt-voucher") Receipt Voucher @elseif($voucher=="payment-voucher") Payment Voucher @elseif($voucher=="contra-voucher") Contra Voucher @else Journal Entry @endif--}}
{{--                                  </a>--}}
{{--                              @endforeach--}}
{{--                          </div>--}}
{{--                    </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="custom-subnav">
                <button class="custom-subnavbtn">Candidate Dashboard Items <i class="fa fa-caret-down"></i></button>
                <div class="custom-subnav-content">

                <span class="custom-subnav-child">
                    <button class="custom-subnavbtn-child">Entry Dashboard Items<i class="fa fa-caret-down"></i></button>
                    <div class="custom-subnav-content-child">
                         @if(count($candidate_group) > 0)
                            <span class="custom-subnav-innerchild">
                             <button class="custom-subnavbtn-innerchild"> Candidate Groups <i class="fa fa-caret-down"></i></button>
                                <div class="custom-subnav-content-innerchild">
                                  @foreach($candidate_group  as $candidate)
                                        <a href="{{url('/'.$candidate)}}">
                                          @if($candidate=="branch-office") Branch Office
                                            @elseif($candidate=="sub-status") Sub Status
                                            @elseif($candidate=="reference-info") Reference Information
                                            @elseif($candidate=="candidate-personal-info") Candidate Personal Information
                                            @endif
                                    </a>
                                    @endforeach
                              </div>
                            </span>
                        @endif
                         <span class="custom-subnav-innerchild">
                             <button class="custom-subnavbtn-innerchild"> CV Groups <i class="fa fa-caret-down"></i></button>
                             <div class="custom-subnav-content-innerchild">
                                    <a href="{{route('candidate-cv-info.index')}}">Entry Details</a>
                                    <a href="{{route('generate-personal-info.cv')}}">Generate CV</a>
                              </div>
                         </span>
                        @if(count($client_group) > 0)
                            <span class="custom-subnav-innerchild">
                                  <button class="custom-subnavbtn-innerchild">Client Groups <i class="fa fa-caret-down"></i></button>
                                  <div class="custom-subnav-content-innerchild">
                                    @foreach($client_group  as $client)
                                          <a href="{{url('/'.$client)}}">
                                            @if($client=="job-category") Job Category
                                              @elseif($client=="job-to-demand") Job to Demand
                                              @elseif($client=="demand-info") Demand Information
                                              @elseif($client=="overseas-agent") Overseas Agent
                                              @elseif($client=="reference-info") Reference Information @endif
                                        </a>
                                      @endforeach
                                  </div>
                             </span>
                        @endif
                        @if(count($single_group) > 0)
                            @foreach($single_group  as $single)
                                @php @$module_single=\App\Models\Module::where('url',$single)->first(); @endphp
                                @if($single=='insurance-agent')
                                    <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>
                                @elseif($single=='health-clinic')
                                    <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>
                                @elseif($single=='advertising-agent')
                                    <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>
                                @elseif($single=='ticketing-agent')
                                    <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>
                                @elseif($single=='visitor')
                                    <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>
                                @elseif($single=='counsellor')
                                    <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>
                                @elseif($single=='airline-details')
                                    <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>
                                @elseif($single=='complain-manager')
                                    <a href="{{url('/'.$single)}}">{{ucwords($module_single->name)}}</a>
                                @endif

                            @endforeach
                        @endif
                  </div>
                </span>
                    <span class="custom-subnav-child">
                          <button class="custom-subnavbtn-child">Processing Dashboard Items <i class="fa fa-caret-down"></i></button>
                          <div class="custom-subnav-content-child">
                            <a href="{{route('applied-candidate.index')}}">Applied</a>
                            <a href="{{route('selected-candidate.index')}}">Selected</a>
                            <a href="{{route('under-processing-candidate.index')}}">Under Process</a>
                            <a href="{{route('visa.index')}}">Visa Recieved</a>
                            <a href="{{route('ticket-received-candidate.index')}}">Ticket Received</a>
                            <a href="{{route('deployed-candidate.index')}}">Deployed</a>
                            <a href="{{route('rejected-candidate.index')}}">Rejected</a>
                            <a href="{{route('cancelled-candidate.index')}}">Cancelled</a>
                          </div>
                        </span>
                    <a href="{{route('folder.index')}}">File Management</a>
                </div>
            </div>
        </div>
        <!-- Page Content -->
        @yield('content')

        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->


@include('admin.partials.footer')

