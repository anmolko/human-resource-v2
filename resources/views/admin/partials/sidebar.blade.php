<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="menu-title">
					<span>Main</span>
				</li>
{{--				<li><a href="{{route('dashboard')}}"><i class="la la-dashboard"></i> <span>Dashboard</span></a></li>--}}
{{--				<li><a href="{{route('user')}}"><i class="la la-users-cog"></i> <span>User Dashboard</span></a></li>--}}
{{--				<li><a href="{{route('account')}}"><i class="la la-files-o"></i> <span>Account Dashboard</span></a></li>--}}
{{--				<li><a href="{{route('candidate')}}"><i class="la la-user-tag"></i> <span>Candidate Dashboard</span></a></li>--}}

				@php $modules=\App\Models\Role::find(session()->get('role_id'))->modules; @endphp


				<!-- @if(count($single_group) > 0)
					@foreach($single_group  as $single)
						@php @$module_single=\App\Models\Module::where('url',$single)->first(); @endphp
						@if($single=='user')
							<li><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="la la-users-cog"></i><span>{{ucwords($module_single->name)}}</span></a></li>
						@endif
					@endforeach
				@endif -->





				@if(count($setting_group) > 0)
				<li class="menu-title">
					<span>Administration</span>
				</li>
				@foreach($setting_group  as $setting)
					<li><a class="{{(\Request::is($setting.'*')) ? 'active' : ''  }}" href="{{url('/'.$setting)}}"><i class="la la-cog"></i><span>Settings</span></a></li>
				@endforeach

				@endif



				<li>
					<a href="{{ route('logout') }} "
						onclick="event.preventDefault();
										document.getElementById('logout-form-sidebar').submit();">
						<i class="la la-power-off"></i> <span>Logout</span>
					</a>

						<form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>

				</li>

			</ul>
		</div>
	</div>
</div>
