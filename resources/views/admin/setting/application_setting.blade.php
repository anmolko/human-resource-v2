@extends('layouts.setting_master')
@section('title') Candidate Application Setting @endsection
@section('css')
    <style>
        .select2-container {
            width: 440px;
        }


        .group {
            display: inline-block;
            margin-right: 1rem;
        }

        .notation {
            display: inline-block;
            position: relative;
            cursor: pointer;
            width: 395px;
            height: 45em;
            filter: grayscale(100%) opacity(70%);
            transition: all .5s ease;
        }

        .notation:hover {
            filter: grayscale(50%) opacity(85%);
            box-shadow: 0 0 15px #777;
        }


        .input-radios {
            position: absolute;
            z-index: 10;
            display: none;
            outline: none;
        }

        .input-radios:active + .notation, .input-radios:checked + .notation {
            filter: none;
            box-shadow: 0 2px 20px #777;
        }

        .spanned {
            position: absolute;
            top: 101%;
            left: 0;
        }

    </style>
@endsection
@section('content')

    @if(session('success'))

        <div class="notification-popup success">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{session('success')}}</span>
            </p>
        </div>
    @endif

    @if(session('error'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{session('error')}}</span>
            </p>
        </div>
    @endif

    @if($errors->has('website_name'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('website_name')}}</span>
            </p>
        </div>
    @endif


    @if($errors->has('logo'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('logo')}}</span>
            </p>
        </div>
    @endif

    @if($errors->has('favicon'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('favicon')}}</span>
            </p>
        </div>
    @endif


    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Candidate Application Settings</h3>
                </div>
            </div>
        </div>
        {!! Form::open(['route' => 'app-setting.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

        <div class="row" style="margin: auto; width: 75%">
            <div class="col-md-12 col-md-offset-4 content">
                <section>
                    <input value="{{@$company_settings->id}}" type="hidden" name="company_id">

                    <div class="group-one group">
                        <input name="radio" class="input-radios" type="radio" id="one" value="app" {{ ($company_settings->application_selected == "app") ? "checked":"" }}>
                        <label for="one" class="one notation" style="background: url({{asset('images/app1.png')}}) no-repeat 0px 0px;"><span class="spanned">Application sample 1 {{ ($company_settings->application_selected == "app") ? " - (Currently in use)":"" }}</span></label>
                    </div>
                    <div class="group-two group">
                        <input name="radio" class="input-radios" type="radio" id="two" value="app2" {{ ($company_settings->application_selected == "app2") ? "checked":"" }}>
                        <label for="two" class="two notation" style=" background: url({{asset('images/app2.png')}}) no-repeat 0px 0px;"><span class="spanned">Application sample 2  {{ ($company_settings->application_selected == "app2") ? " - (Currently in use)":"" }}</span></label>
                    </div>
                </section>
            </div><!--content-->
            <div class="col-md-12 mt-4 col-md-offset-4 content">
                <section>
                    <div class="group-one group">
                        <input name="radio" class="input-radios" type="radio" id="index3" value="app3" {{ ($company_settings->application_selected == "app3") ? "checked":"" }}>
                        <label for="index3" class="one notation" style="background: url({{asset('images/app3.png')}}) no-repeat 0px 0px;"><span class="spanned">Dynamic Application sample 3 {{ ($company_settings->application_selected == "app3") ? " - (Currently in use)":"" }}</span></label>
                    </div>
                    <div class="group-two group">
                        <input name="radio" class="input-radios" type="radio" value="app4" id="four" {{ ($company_settings->application_selected == "app4") ? "checked":"" }}>
                        <label for="four" class="two notation" style=" background: url({{asset('images/app4.png')}}) no-repeat 0px 0px;"><span class="spanned">Application sample 4 {{ ($company_settings->application_selected == "app4") ? " - (Currently in use)":"" }}</span></label>
                    </div>
                </section>
            </div><!--content-->
        </div><!--row-->

        <div class="submit-section">
            <button class="btn btn-primary submit-btn" id="submit-module">Save</button>
        </div>

        {!! Form::close() !!}
    </div>
    <!-- /Page Content -->


@endsection
@section('js')
    <script type="text/javascript">


        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
        });

    </script>
@endsection
