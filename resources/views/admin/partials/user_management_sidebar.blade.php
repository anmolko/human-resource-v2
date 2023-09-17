	<!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
			    <ul>
                    <li>
                        <a href="{{url('/dashboard')}}"><i class="la la-home"></i> <span>Back to Home</span></a>
                    </li>
				    <li class="{{(\Request::is('user-dashboard')) ? 'active' : ''  }}"><a href="{{route('user')}}"><i class="la la-dashboard"></i> <span>User Dashboard</span></a></li>

                    @if(count($single_group) > 0)
					@foreach($single_group  as $single)
						@php @$module_single=\App\Models\Module::where('url',$single)->first(); @endphp
						@if($single=='user')
							<li class="{{(\Request::is($single)) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="la la-users-cog"></i><span>{{ucwords($module_single->name)}}</span></a></li>
						@endif

					@endforeach
					@endif

                    @if(count($employee_group) > 0)
					<li class="submenu">
							<a href="#"><i class="las la-address-book"></i> <span> Employee Groups </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
						@foreach($employee_group  as $employe)

								<li class="{{(\Request::is($employe.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($employe.'*')) ? 'active' : ''  }}" href="{{url('/'.$employe)}}">
										@if($employe=="employee") All Employee
										@endif </a></li>

						@endforeach
							</ul>
						</li>
					@endif


                    @if(count($payroll_group) > 0)
					<li class="submenu">
							<a href="#"><i class="la la-money"></i> <span> Payroll Groups</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
						@foreach($payroll_group  as $payroll)

								<li class="{{(\Request::is($payroll.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($payroll.'*')) ? 'active' : ''  }}" href="{{url('/'.$payroll)}}">
										@if($payroll=="employee-payroll")
                                            Payroll
                                        @elseif($payroll=="employee-payment")
                                            Employee Payment
										@endif </a></li>

						@endforeach
							</ul>
						</li>
					@endif




                    @if(count($configuration_group) > 0)
					<li class="submenu">
							<a href="#"><i class="las la-cogs"></i> <span> Configurations </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
						@foreach($configuration_group  as $configuration)

								<li class="{{(\Request::is($configuration.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($configuration.'*')) ? 'active' : ''  }}" href="{{url('/'.$configuration)}}">
										@if($configuration=="department") Department
										@elseif($configuration=="designation") Designation
										@endif </a></li>

						@endforeach
							</ul>
						</li>
					@endif


                    @php
                    @$role=\App\Models\Role::find(session()->get('role_id'));
                        @endphp
                    @if($role == 'admin')

                    <li class="menu-title">
                        <span>Access Control List</span>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-user-secret"></i> <span> ACL Groups </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="{{(\Request::is('module*')) ? 'active' : ''  }}"><a class="{{(\Request::is('module*')) ? 'active' : ''  }}" href="{{route('module.index')}}">Modules</a></li>
                            <li class="{{(\Request::is('role*')) ? 'active' : ''  }}"><a class="{{(\Request::is('role*')) ? 'active' : ''  }}" href="{{route('role.index')}}">Roles </a></li>
                            <li class="{{(\Request::is('permission*')) ? 'active' : ''  }}"><a class="{{(\Request::is('permission*')) ? 'active' : ''  }}" href="{{route('permission.index')}}">Permissions</a></li>
                        </ul>
                    </li>
                    @endif



                </ul>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
