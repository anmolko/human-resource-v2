	<!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
			    <ul>
                    <li class="{{(\Request::is('dashboard')) ? 'active' : ''  }}">
                        <a href="{{url('/dashboard')}}"><i class="la la-home"></i> <span>Back to Home</span></a>
                    </li>
				    <li class="{{(\Request::is('account')) ? 'active' : ''  }}"><a href="{{route('account')}}"><i class="la la-dashboard"></i> <span>Account Dashboard</span></a></li>


                    @if(count($account_group) > 0)
                    <li class="submenu" >
                            <a href="#"><i class="la la-files-o"></i> <span> Account Groups </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                        @foreach($account_group  as $account)

                                <li class="{{(\Request::is($account.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($account.'*')) ? 'active' : ''  }}" href="{{url('/'.$account)}}"> @if($account=="secondary-groups") Secondary Groups
                                @elseif($account=="primary-groups") Primary Groups @else Attribute @endif </a></li>

                        @endforeach
                            </ul>
                        </li>
                    @endif

                    @if(count($voucher_group) > 0)
                    <li class="submenu">
                            <a href="#"><i class="la la-edit"></i> <span> Voucher Groups </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                        @foreach($voucher_group  as $voucher)

                                <li class="{{(\Request::is($voucher.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($voucher.'*')) ? 'active' : ''  }}" href="{{url('/'.$voucher)}}"> @if($voucher=="receipt-voucher") Receipt Voucher
                                @elseif($voucher=="payment-voucher") Payment Voucher @elseif($voucher=="contra-voucher") Contra Voucher @else Journal Entry @endif </a></li>

                        @endforeach
                            </ul>
                        </li>
                    @endif

                    @if(count($single_group) > 0)
                        @foreach($single_group  as $single)
                            @php @$module_single=\App\Models\Module::where('url',$single)->first(); @endphp
                            @if($single=='ledger')
                                <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="la la-columns"></i><span>{{ucwords($module_single->name)}}</span></a></li>
                            @elseif($single=='trial-balance')
                            <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="lab la-readme"></i><span>{{ucwords($module_single->name)}}</span></a></li>
                                @elseif($single=='profit-loss-account')
                            <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="la la-chart-bar"></i><span>{{ucwords($module_single->name)}}</span></a></li>
                            @elseif($single=='balance-sheet')
                            <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-balance-scale"></i><span>{{ucwords($module_single->name)}}</span></a></li>
                            @endif
                        @endforeach
                    @endif

                </ul>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
