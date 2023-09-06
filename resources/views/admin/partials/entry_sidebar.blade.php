	<!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
			    <ul>
                    <li>
                        <a href="{{url('/dashboard')}}"><i class="la la-home"></i> <span>Back to Home</span></a>
                        <a href="{{url('/candidate')}}"><i class="la la-user-tag"></i> <span>Back to Candidate</span></a>
                    </li>
				    <li class="{{(\Request::is('entry')) ? 'active' : ''  }}" ><a href="{{route('entry')}}"><i class="la la-dashboard"></i> <span>Entry Dashboard</span></a></li>
                    @if(count($client_group) > 0)
					<li class="submenu">
							<a href="#"><i class="la la-users"></i> <span> Client Groups </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
						@foreach($client_group  as $client)

								<li class="{{(\Request::is($client.'*')) ? 'active' : ''  }}">
                                    <a class="{{(\Request::is($client.'*')) ? 'active' : ''  }}" href="{{url('/'.$client)}}">
										@if($client=="job-category") Job Category
										@elseif($client=="job-to-demand") Job to Demand
										@elseif($client=="demand-info") Demand Information
										@elseif($client=="overseas-agent") Overseas Agent
										@elseif($client=="reference-info") Reference Information @endif </a>
                                </li>

						@endforeach
							</ul>
						</li>
					@endif

					@if(count($candidate_group) > 0)
					<li class="submenu">
							<a href="#" class="{{(\Request::is('candidate-all'.'*')) ? 'active' : ''  }}"><i class="la la-user-tag"></i> <span> Candidate Groups </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
						@foreach($candidate_group  as $candidate)

								<li class="{{(\Request::is($candidate.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($candidate.'*')) ? 'active' : ''  }}" href="{{url('/'.$candidate)}}">
										@if($candidate=="branch-office") Branch Office
										@elseif($candidate=="sub-status") Sub Status
										@elseif($candidate=="reference-info") Reference Information
										@elseif($candidate=="candidate-personal-info") Candidate Personal Information
										@endif </a></li>

						@endforeach
							</ul>
						</li>
					@endif



					<li class="submenu">
							<a href="#"><i class="las la-id-card"></i> <span> CV Groups </span> <span class="menu-arrow"></span></a>

							<ul style="display: none;">
								<li class="{{(\Request::is('candidate-cv-info')) ? 'active' : ''  }}" ><a class="{{(\Request::is('generate-candidate-cv')) ? 'active' : ''  }}"
									href="{{route('candidate-cv-info.index')}}"> Entry CV</a></li>
								<li class="{{(\Request::is('generate-candidate-cv')) ? 'active' : ''  }}" ><a class="{{(\Request::is('generate-candidate-cv')) ? 'active' : ''  }}"
										href="{{route('generate-personal-info.cv')}}"> Generate CV</a></li>
							</ul>
						</li>


					@if(count($single_group) > 0)
					@foreach($single_group  as $single)
						@php @$module_single=\App\Models\Module::where('url',$single)->first(); @endphp
						@if($single=='insurance-agent')
							<li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-umbrella"></i><span>{{ucwords($module_single->name)}}</span></a></li>
						@elseif($single=='health-clinic')
                                <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-notes-medical"></i><span>{{ucwords($module_single->name)}}</span></a></li>
                        @elseif($single=='advertising-agent')
                            <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-ad"></i><span>{{ucwords($module_single->name)}}</span></a></li>
                        @elseif($single=='ticketing-agent')
                            <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-ticket-alt"></i><span>{{ucwords($module_single->name)}}</span></a></li>
						@elseif($single=='visitor')
                            <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-handshake"></i><span>{{ucwords($module_single->name)}}</span></a></li>
						@elseif($single=='counsellor')
                            <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-volume-up"></i><span>{{ucwords($module_single->name)}}</span></a></li>
						@elseif($single=='airline-details')
                            <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-plane-departure"></i><span>{{ucwords($module_single->name)}}</span></a></li>
                        @elseif($single=='complain-manager')
                            <li class="{{(\Request::is($single.'*')) ? 'active' : ''  }}"><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-user-clock"></i><span>{{ucwords($module_single->name)}}</span></a></li>
                        @endif

					@endforeach
					@endif
                </ul>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
