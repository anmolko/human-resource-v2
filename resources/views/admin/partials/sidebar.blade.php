<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="menu-title">
					<span>Main</span>
				</li>
                @foreach($parent_modules as $parent_module)
                    <li class="{{ $parent_module->childModules->count() ? 'submenu':'' }} {{ (\Request::is($parent_module->url.'*')) ? 'active' : '' }} ">
                        <a href="/{{  $parent_module->url ?? 'javascript:void(0);' }}">
                            <i class="la {{ $parent_module->icon ?? 'la-puzzle-piece' }}"></i> <span>{{ $parent_module->name ?? '' }}</span>
                            @if($parent_module->childModules->count())
                                <span class="menu-arrow"></span>
                            @endif
                        </a>
                        @if($parent_module->childModules->count())
                            <ul style="display: none;">
                                @foreach($parent_module->childModules as $child_modules)
                                    <li class="{{ $child_modules->childModules->count() ? 'submenu':'' }}">
                                        <a href="/{{  $child_modules->url ?? 'javascript:void(0);' }}" class="{{ (\Request::is($child_modules->url.'*')) ? 'active' : '' }}"> <span>{{ $child_modules->name ?? '' }}</span>
                                            @if($child_modules->childModules->count())
                                                <span class="menu-arrow"></span>
                                            @endif
                                        </a>
                                        @if($child_modules->childModules->count())
                                            <ul style="display: none;">
                                                @foreach($child_modules->childModules as $sub_child_modules)
                                                    <li><a href="/{{ $sub_child_modules->url }}" class="{{ (\Request::is($sub_child_modules->url.'*')) ? 'active' : '' }}"><span>{{ $sub_child_modules->name }}</span></a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

				<!-- @if(count($single_group) > 0)
					@foreach($single_group  as $single)
						@php @$module_single=\App\Models\Module::where('url',$single)->first(); @endphp
						@if($single=='user')
							<li><a class="{{(\Request::is($single.'*')) ? 'active' : ''  }}" href="{{url('/'.$single)}}"><i class="la la-users-cog"></i><span>{{ucwords($module_single->name)}}</span></a></li>
						@endif
					@endforeach
				@endif -->



                @if($role == 'admin' || $role == 'super-admin')

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



				@if(count($setting_group) > 0)
				<li class="menu-title">
					<span>Administration</span>
				</li>
				@foreach($setting_group  as $index=>$setting)
					<li><a class="{{(\Request::is($setting->url.'*')) ? 'active' : ''  }}" href="{{url('/'.$setting->url)}}"><i class="{{ $setting->icon }}"></i><span>{{ ucfirst($setting->name) }}</span></a></li>
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
