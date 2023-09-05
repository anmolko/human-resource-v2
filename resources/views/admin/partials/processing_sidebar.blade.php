<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{url('/dashboard')}}"><i class="la la-home"></i> <span>Back to Home</span></a>
                    <a href="{{url('/candidate')}}"><i class="la la-user-tag"></i> <span>Back to Candidate</span></a>
                </li>
                <li><a href="{{route('processing')}}"><i class="la la-dashboard"></i> <span>Processing Dashboard</span></a></li>

                @if(count($processing_group) > 0)
                    <li class="submenu">
                        <a href="#"><i class="la la-users"></i> <span> Process Groups </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @foreach($processing_group  as $process)

                                <li><a class="{{(\Request::is($process.'*')) ? 'active' : ''  }}" href="{{url('/'.$process)}}">
                                        @if($process=="applied-candidate") Applied Candidate
                                        @elseif($process=="selected-candidate") Selected Candidate
                                        @elseif($process=="under-process-candidate") Under Process Candidate
                                        @endif </a></li>

                            @endforeach
                        </ul>
                    </li>
                @endif

{{--                @if(count($single_group) > 0)--}}
{{--                    @foreach($single_group  as $single)--}}
{{--                        @php @$module_single=\App\Models\Module::where('url',$single)->first(); @endphp--}}
{{--                        @if($single=='insurance-agent')--}}
{{--                            <li><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-umbrella"></i><span>{{ucwords($module_single->name)}}</span></a></li>--}}
{{--                        @elseif($single=='health-clinic')--}}
{{--                            <li><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-notes-medical"></i><span>{{ucwords($module_single->name)}}</span></a></li>--}}
{{--                        @elseif($single=='advertising-agent')--}}
{{--                            <li><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-ad"></i><span>{{ucwords($module_single->name)}}</span></a></li>--}}
{{--                        @elseif($single=='ticketing-agent')--}}
{{--                            <li><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-ticket-alt"></i><span>{{ucwords($module_single->name)}}</span></a></li>--}}
{{--                        @elseif($single=='visitor')--}}
{{--                            <li><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-handshake"></i><span>{{ucwords($module_single->name)}}</span></a></li>--}}
{{--                        @elseif($single=='counsellor')--}}
{{--                            <li><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-volume-up"></i><span>{{ucwords($module_single->name)}}</span></a></li>--}}
{{--                        @elseif($single=='airline-details')--}}
{{--                            <li><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-plane-departure"></i><span>{{ucwords($module_single->name)}}</span></a></li>--}}
{{--                        @elseif($single=='complain-manager')--}}
{{--                            <li><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="las la-user-clock"></i><span>{{ucwords($module_single->name)}}</span></a></li>--}}
{{--                        @endif--}}

{{--                    @endforeach--}}
{{--                @endif--}}
            </ul>
        </div>
    </div>
</div>
<!-- Sidebar -->
