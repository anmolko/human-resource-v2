	<!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div class="sidebar-menu">
                <ul class="settings-sidebar">
                    <li>
                        <a href="{{url('/dashboard')}}"><i class="la la-home"></i> <span>Back to Home</span></a>
                    </li>
                    <li class="menu-title">Settings</li>
                    <li class="{{(\Request::is('settings')) ? 'active' : ''  }}">
                        <a href="{{route('company-setting.index')}}"><i class="la la-building"></i> <span>Company Settings</span></a>
                    </li>
                    <li class="{{(\Request::is('theme-settings')) ? 'active' : ''  }}">
                        <a href="{{route('theme-setting.index')}}"><i class="la la-photo"></i> <span>Theme Settings</span></a>
                    </li>
                    <li class="{{(\Request::is('country-settings*')) ? 'active' : ''  }}">
                        <a href="{{route('country-setting.index')}}"><i class="la la-globe"></i> <span>Country Settings</span></a>
                    </li>
                    <li class="{{(\Request::is('application-settings*')) ? 'active' : ''  }}">
                        <a href="{{route('app-setting.index')}}"><i class="la la-file"></i> <span>Application Settings</span></a>
                    </li>



                </ul>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
