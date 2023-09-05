@extends('layouts.setting_master')
@section('title') Company Setting @endsection
@section('css')
<style>
.company-logo{
    margin-top:25px
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

    @if($errors->has('company_name'))
    <div class="notification-popup danger">
        <p>
            <span class="task"></span>
            <span class="notification-text">{{$errors->first('company_name')}}</span>
        </p>
    </div>
    @endif


    @if($errors->has('company_address'))
    <div class="notification-popup danger">
        <p>
            <span class="task"></span>
            <span class="notification-text">{{$errors->first('company_address')}}</span>
        </p>
    </div>
    @endif

    @if($errors->has('slug'))
    <div class="notification-popup danger">
        <p>
            <span class="task"></span>
            <span class="notification-text">{{$errors->first('slug')}}</span>
        </p>
    </div>
    @endif

    @if($errors->has('company_logo'))
    <div class="notification-popup danger">
        <p>
            <span class="task"></span>
            <span class="notification-text">{{$errors->first('company_logo')}}</span>
        </p>
    </div>
    @endif


    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Company Settings</h3>
                        </div>
                    </div>
                </div>

                <!-- /Page Header -->
                @if(!empty($company_settings))
                {!! Form::open(['url'=>route('company-setting.update', @$company_settings->id),'method'=>'PUT','enctype'=>'multipart/form-data','class'=>'needs-validation','novalidate'=>'']) !!}
                @else
                <form action="{{ route('company-setting.store') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Company Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="{{@$company_settings->company_name}}" name="company_name" id="company_name" required>
                                <input class="form-control" type="hidden" value="{{@$company_settings->slug}}" name="slug" id="slug" >
                                <div class="invalid-feedback">
                                    Please enter a company name.
                                </div>
                                @if($errors->has('company_name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('company_name')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Company Address</label>
                                <input class="form-control " value="{{@$company_settings->company_address}}" name="company_address" type="text" required>
                                <div class="invalid-feedback">
                                    Please enter a company address.
                                </div>
                                @if($errors->has('company_address'))
                                <div class="invalid-feedback">
                                    {{$errors->first('company_address')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Govt. License Number</label>
                                <input class="form-control" value="{{@$company_settings->company_license}}" name="company_license" type="text">
                                <div class="invalid-feedback">
                                    Please enter a company govt license number.
                                </div>
                                @if($errors->has('company_license'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('company_license')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" value="{{@$company_settings->email}}" type="email" name="email" required>
                                <div class="invalid-feedback">
                                    Please enter a email.
                                </div>
                                @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{$errors->first('email')}}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Pan Number</label>
                                <input class="form-control" value="{{@$company_settings->pan_number}}" type="text" name="pan_number" required>
                                <div class="invalid-feedback">
                                    Please enter a pan number.
                                </div>
                                @if($errors->has('pan_number'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('pan_number')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Opening Period Date</label>
                                <input class="form-control" value="{{@$company_settings->from}}" id="datetimepickerfrom" type="text" name="from" required>
                                <div class="invalid-feedback">
                                    Please enter opening period date.
                                </div>
                                @if($errors->has('from'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('from')}}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Closing Period Date</label>
                                <input class="form-control" value="{{@$company_settings->to}}" id="datetimepickerto" type="text"  name="to" required>
                                <div class="invalid-feedback">
                                    Please enter closing period date.
                                </div>
                                @if($errors->has('to'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('to')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label>Company Logo</label>
                                <input type="file" class="form-control" name="company_logo" <?php if(!empty(@$company_settings)){ }else{ echo 'required';}?>>
                                <div class="invalid-feedback">
                                    Please select a company logo.
                                </div>
                                @if($errors->has('to'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('company_logo')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 company-logo">
                            <div class="form-group">
                                <label></label>
                                    <div class="img-thumbnail float-right" style="background-color: transparent;border: none;"><img src="<?php if(@$company_settings->company_logo){?>{{asset('/images/company/'.@$company_settings->company_logo)}}<?php }else{?>{{asset('/backend/assets/img/logo.png')}}<?php }?>" alt="" height="40"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label>Company Application Letterhead Design (PNG image)</label>
                                <input type="file" class="form-control" name="letterhead" <?php if(!empty(@$company_settings)){ }else{ echo 'required';}?>>
                                <div class="invalid-feedback">
                                    Company Application Letterhead Design.
                                </div>
                                @if($errors->has('letterhead'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('letterhead')}}
                                    </div>
                                @endif
                                <small>Use image size of 800 x 210px for letterhead</small>
                            </div>
                        </div>
                        <div class="col-lg-2 company-logo">
                            <div class="form-group">
                                <label></label>
                                <div class="img-thumbnail float-right" style="background-color: transparent;border: none;"><img src="<?php if(@$company_settings->letterhead){?>{{asset('/images/company/'.@$company_settings->letterhead)}}<?php }?>" alt="" height="40"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label>Letterhead additional image </label>
                                <input type="file" class="form-control" name="extra_header" <?php if(!empty(@$company_settings)){ }else{ echo 'required';}?>>
                                <div class="invalid-feedback">
                                    Letter head additional image
                                </div>
                                @if($errors->has('extra_header'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('extra_header')}}
                                    </div>
                                @endif
                                <small>Use image size of 680 x 195px for additional letterhead image. (image used in candidate application template 1)</small>
                            </div>
                        </div>
                        <div class="col-lg-2 company-logo">
                            <div class="form-group">
                                <label></label>
                                <div class="img-thumbnail float-right" style="background-color: transparent;border: none;"><img src="<?php if(@$company_settings->extra_header){?>{{asset('/images/company/'.@$company_settings->extra_header)}}<?php }?>" alt="" height="40"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" value="{{@$company_settings->phone}}" type="text" name="phone" required>
                                <div class="invalid-feedback">
                                    Please enter a phone number.
                                </div>
                                @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{$errors->first('phone')}}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input class="form-control" value="{{@$company_settings->mobile}}" type="text" name="mobile" required>
                                <div class="invalid-feedback">
                                    Please enter a mobile number.
                                </div>
                                @if($errors->has('mobile'))
                                <div class="invalid-feedback">
                                    {{$errors->first('mobile')}}
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @if(session()->get('is_first_login')=="true")
        <!-- First Attempt  Modal -->
        @include('admin.modals.settings.first-attempt-show')
        @php
        $is_first_login ="false";
        session()->put('is_first_login',$is_first_login);
        @endphp

        <!-- /First Attempt  Modal -->
    @endif


@endsection
@section('js')
<script type="text/javascript">

    $("#company_name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'_');
        $("#slug").val(Text);
    });

    $('#first_attempt_show').modal('show');

    $(document).ready(function () {

        <?php if(@$theme_data->default_date_format=='nepali'){ ?>

                $('#datetimepickerfrom').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });


                $('#datetimepickerto').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english"
                });

        <?php }else if(@$theme_data->default_date_format=='english'){ ?>

                $('#datetimepickerfrom').datetimepicker({
                    format: 'YYYY-MM-DD'
                });

                $('#datetimepickerto').datetimepicker({
                    format: 'YYYY-MM-DD'
                });


        <?php }else{?>
                $('#datetimepickerfrom').datetimepicker({
                    format: 'YYYY-MM-DD'
                });

                $('#datetimepickerto').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
        <?php }?>
    });


</script>
@endsection
