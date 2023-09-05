
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
        <meta name="robots" content="">
		<title>@yield('title') -
                    @if(!empty(@$theme_data->website_name))
                     {{ucwords(@$theme_data->website_name)}}
                    @else
                    CanoSoft's Technologies
                    @endif
                    HRMS</title>

			<!-- Favicon -->
            <link rel="shortcut icon" type="image/x-icon" href="<?php if(@$theme_data->favicon){?>{{asset('/images/theme/'.@$theme_data->favicon)}}<?php }else{?>{{asset('/backend/assets/img/favicon.png')}}<?php }?>">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('backend/assets/css/font-awesome.min.css')}}">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{asset('backend/assets/css/line-awesome2.min.css')}}">

        <!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('backend/assets/css/select2.min.css')}}">


		<!-- Chart CSS -->
        <link rel="stylesheet" href="{{asset('backend/assets/plugins/morris/morris.css')}}">

        <!-- Datatable CSS -->
		<link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap4.min.css')}}">

        <!-- Datetimepicker CSS -->
        <?php if(@$theme_data->default_date_format == 'english'){?>
		<link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-datetimepicker.min.css')}}">
        <?php } else if(@$theme_data->default_date_format == 'nepali'){?>
		<link rel="stylesheet" href="{{asset('backend/assets/css/nepali.datepicker.v3.5.min.css')}}">
        <?php } else{?>
		<link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-datetimepicker.min.css')}}">
        <?php }?>


        <!-- Main CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/style.css')}}">

        <link rel="stylesheet" type="text/css" href="/backend/assets/css/<?php if(@$theme_data->color){?>{{@$theme_data->color}}<?php }else{ echo "light_grey"; }?>.css">

        <link href="{{asset('backend/assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">

        @yield('css')

    </head>

    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">



			<!-- Header -->

            <div class="header">
                <!-- Logo -->
                <div class="header-left">
                    <a href="/dashboard" class="logo">
                        <img src="<?php if(@$theme_data->logo){?>{{asset('/images/theme/'.@$theme_data->logo)}}<?php }else{?>{{asset('/backend/assets/img/logo.png')}}<?php }?>" width="40" height="40" alt="">
                    </a>
                </div>
                <!-- /Logo -->

                <a id="toggle_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>

                <!-- Header Title -->
                <div class="page-title-box">
                    <h3>

                    @if(!empty(@$theme_data->website_name))
                     {{ucwords(@$theme_data->website_name)}}
                    @else
                    CanoSoft's Technologies

                    @endif
                      </h3>
                </div>
                <!-- /Header Title -->

                <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

                <!-- Header Menu -->
                <ul class="nav user-menu">

                    <!-- Search -->
                    <li class="nav-item">
                        <div class="top-nav-search">
                            <a href="javascript:void(0);" class="responsive-search">
                                <i class="fa fa-search"></i>
                            </a>
                            <form action="">
                                <input class="form-control" type="text" placeholder="Search here">
                                <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </li>
                    <!-- /Search -->



                    <!-- Notifications -->
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">--}}
{{--                            <i class="fa fa-bell-o"></i> <span class="badge badge-pill">3</span>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu notifications">--}}
{{--                            <div class="topnav-dropdown-header">--}}
{{--                                <span class="notification-title">Notifications</span>--}}
{{--                                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>--}}
{{--                            </div>--}}
{{--                            <div class="noti-content">--}}
{{--                                <ul class="notification-list">--}}
{{--                                    <li class="notification-message">--}}
{{--                                        <a href="#">--}}
{{--                                            <div class="media">--}}
{{--                                                <span class="avatar">--}}
{{--                                                    <img alt="" src="/images/profiles/avatar-02.jpg">--}}
{{--                                                </span>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>--}}
{{--                                                    <p class="noti-time"><span class="notification-time">4 mins ago</span></p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}


{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="topnav-dropdown-footer">--}}
{{--                                <a href="#">View all Notifications</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <!-- /Notifications -->

                    <!-- Message Notifications -->
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">--}}
{{--                            <i class="fa fa-comment-o"></i> <span class="badge badge-pill">8</span>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu notifications">--}}
{{--                            <div class="topnav-dropdown-header">--}}
{{--                                <span class="notification-title">Messages</span>--}}
{{--                                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>--}}
{{--                            </div>--}}
{{--                            <div class="noti-content">--}}
{{--                                <ul class="notification-list">--}}
{{--                                    <li class="notification-message">--}}
{{--                                        <a href="#">--}}
{{--                                            <div class="list-item">--}}
{{--                                                <div class="list-left">--}}
{{--                                                    <span class="avatar">--}}
{{--                                                        <img alt="" src="/images/profiles/avatar-09.jpg">--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                                <div class="list-body">--}}
{{--                                                    <span class="message-author">Richard Miles </span>--}}
{{--                                                    <span class="message-time">12:28 AM</span>--}}
{{--                                                    <div class="clearfix"></div>--}}
{{--                                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}

{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="topnav-dropdown-footer">--}}
{{--                                <a href="#">View all Messages</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <!-- /Message Notifications -->

                    <li class="nav-item dropdown main-drop">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                        <i class="las la-plus-circle"></i>
						</a>
                        <div class="dropdown-menu">
                            @if (\Route::current()->getName() == 'dashboard')
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Main Dashboard</a>
                            <a class="dropdown-item" href="{{ route('user') }}">User Dashboard</a>
                            <a class="dropdown-item" href="{{route('account')}}">Account Dashboard</a>
                            <a class="dropdown-item" href="{{route('candidate')}}">Candidate Dashboard</a>

                            @elseif (\Route::current()->getName() == 'account')
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Main Dashboard</a>
                            <a class="dropdown-item" href="{{ route('user') }}">User Dashboard</a>
                            <a class="dropdown-item" href="{{route('candidate')}}">Candidate Dashboard</a>

                            @elseif (\Route::current()->getName() == 'user')
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Main Dashboard</a>
                            <a class="dropdown-item" href="{{route('account')}}">Account Dashboard</a>
                            <a class="dropdown-item" href="{{route('candidate')}}">Candidate Dashboard</a>

                            @elseif (\Route::current()->getName() == 'processing')
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Main Dashboard</a>
                                <a class="dropdown-item" href="{{ route('user') }}">User Dashboard</a>
                                <a class="dropdown-item" href="{{route('account')}}">Account Dashboard</a>
                                <a class="dropdown-item" href="{{route('candidate')}}">Candidate Dashboard</a>

                            @elseif (\Route::current()->getName() == 'candidate')
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Main Dashboard</a>
                            <a class="dropdown-item" href="{{ route('user') }}">User Dashboard</a>
                            <a class="dropdown-item" href="{{route('account')}}">Account Dashboard</a>
                            @else
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Main Dashboard</a>
                            <a class="dropdown-item" href="{{ route('user') }}">User Dashboard</a>
                            <a class="dropdown-item" href="{{route('account')}}">Account Dashboard</a>
                            <a class="dropdown-item" href="{{route('candidate')}}">Candidate Dashboard</a>
                            <a class="dropdown-item" href="{{route('processing')}}">Processing Dashboard</a>

                            @endif

                        </div>
                    </li>


                    <li class="nav-item dropdown has-arrow main-drop">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img"><img src="<?php if(!empty(Auth::user()->image)){ echo '/images/user/'.Auth::user()->image; } else { if(Auth::user()->gender=="male") {echo '/images/profiles/male.png'; } elseif(Auth::user()->gender=="female") {echo '/images/profiles/female.png'; } elseif(Auth::user()->gender=="others") {echo '/images/profiles/others.png'; } } ?>" alt="{{ Auth::user()->name}}">
                            <span class="status online"></span></span>
                            <span>{{ ucfirst(Auth::user()->name)}}</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
                            <a class="dropdown-item" href="{{route('company-setting.index')}}">Settings</a>

                            <a class="dropdown-item" href="{{ route('logout') }} "
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form-header').submit();">
                                    Logout
                                </a>

                                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                        </div>
                    </li>
                </ul>
                <!-- /Header Menu -->

                <!-- Mobile Menu -->
                <div class="dropdown mobile-user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
                        <a class="dropdown-item" href="{{route('company-setting.index')}}">Settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }} "
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form-header-mobile').submit();">
                                    Logout
                        </a>

                            <form id="logout-form-header-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                    </div>
                </div>
                <!-- /Mobile Menu -->

            </div>

			<!-- /Header -->
