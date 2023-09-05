	<!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
			    <ul>
                    <li>
                        <a href="{{url('/dashboard')}}"><i class="la la-home"></i> <span>Back to Home</span></a>
                    </li>
				    <li class="{{(\Request::is('candidate')) ? 'active' : ''  }}"><a href="{{route('candidate')}}"><i class="la la-dashboard"></i> <span>Candidate Dashboard</span></a></li>
				    <li class="{{(\Request::is('entry')) ? 'active' : ''  }}"><a href="{{route('entry')}}"><i class="las la-sign-in-alt"></i> <span>Entry Dashboard</span></a></li>
                    <li class="{{(\Request::is('proceesing')) ? 'active' : ''  }}"><a href="{{route('processing')}}"><i class="las la-sync-alt"></i> <span>Processing Dashboard</span></a></li>
                    <li class="{{(\Request::is('folders')) ? 'active' : ''  }}"><a href="{{route('folder.index')}}"><i class="las la-file-upload"></i> <span>File Management</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
