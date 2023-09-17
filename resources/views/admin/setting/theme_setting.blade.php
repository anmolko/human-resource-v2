@extends('layouts.setting_master')
@section('title') Theme Setting @endsection
@section('css')
<style>
    .custom-radio-button div {
  display: inline-block;
}
.custom-radio-button input[type="radio"] {
  display: none;
}
.custom-radio-button input[type="radio"] + label {
  color: #333;
  font-family: Arial, sans-serif;
  font-size: 14px;
}
.custom-radio-button input[type="radio"] + label span {
  display: inline-block;
  width: 50px;
  height: 50px;
  margin: -1px 4px 0 0;
  vertical-align: middle;
  cursor: pointer;
  border-radius: 50%;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
  background-repeat: no-repeat;
  background-position: center;
  text-align: center;
  line-height: 44px;
}
.custom-radio-button input[type="radio"] + label span img {
  opacity: 0;
  transition: all 0.3s ease;
}

.custom-radio-button input[type="radio"] + label span i {
  opacity: 0;
  transition: all 0.3s ease;
}
.custom-radio-button input[type="radio"]#color-red + label span {
    background: #F87171;
	background: -moz-linear-gradient(left, #F87171 0%, #DC2626 100%);
	background: -webkit-linear-gradient(left, #F87171 0%, #DC2626 100%);
	background: -ms-linear-gradient(left, #F87171 0%, #DC2626 100%);
	background: linear-gradient(to right, #F87171 0%, #DC2626 100%);

}
.custom-radio-button input[type="radio"]#color-blue + label span {
    background: #00c5fb;
	background: -moz-linear-gradient(left, #00c5fb 0%, #0253cc 100%);
	background: -webkit-linear-gradient(left, #00c5fb 0%, #0253cc 100%);
	background: -ms-linear-gradient(left, #00c5fb 0%, #0253cc 100%);
	background: linear-gradient(to right, #00c5fb 0%, #0253cc 100%);
}
.custom-radio-button input[type="radio"]#color-orange + label span {
    background: #ff9b44;
	background: -moz-linear-gradient(left, #ff9b44 0%, #fc6075 100%);
	background: -webkit-linear-gradient(left, #ff9b44 0%, #fc6075 100%);
	background: -ms-linear-gradient(left, #ff9b44 0%, #fc6075 100%);
	background: linear-gradient(to right, #ff9b44 0%, #fc6075 100%);
}
.custom-radio-button input[type="radio"]#color-pink + label span {
    background: #F472B6;
	background: -moz-linear-gradient(left, #F472B6 0%, #DB2777 100%);
	background: -webkit-linear-gradient(left, #F472B6 0%, #DB2777 100%);
	background: -ms-linear-gradient(left, #F472B6 0%, #DB2777 100%);
	background: linear-gradient(to right, #F472B6 0%, #DB2777 100%);
}

.custom-radio-button input[type="radio"]#color-green + label span {
	background: #34D399;
	background: -moz-linear-gradient(left, #34D399 0%, #059669 100%);
	background: -webkit-linear-gradient(left, #34D399 0%, #059669 100%);
	background: -ms-linear-gradient(left, #34D399 0%, #059669 100%);
	background: linear-gradient(to right, #34D399 0%, #059669 100%);
}

.custom-radio-button input[type="radio"]#color-green-beach + label span {
	background: #00cdac ;
	background: -moz-linear-gradient(left, #00cdac  0%, #02aab0   100%);
	background: -webkit-linear-gradient(left, #00cdac  0%, #02aab0   100%);
	background: -ms-linear-gradient(left, #00cdac  0%, #02aab0   100%);
	background: linear-gradient(to right, #00cdac  0%, #02aab0   100%);
}

.custom-radio-button input[type="radio"]#color-lush + label span {
	background: #a8e063;
	background: -moz-linear-gradient(left, #a8e063 0%, #56ab2f  100%);
	background: -webkit-linear-gradient(left, #a8e063 0%, #56ab2f  100%);
	background: -ms-linear-gradient(left, #a8e063 0%, #56ab2f  100%);
	background: linear-gradient(to right, #a8e063 0%, #56ab2f  100%);
}


.custom-radio-button input[type="radio"]#color-almost + label span {
    background: #ddd6f3 ;
	background: -moz-linear-gradient(left, #ddd6f3  0%, #faaca8   100%);
	background: -webkit-linear-gradient(left, #ddd6f3  0%, #faaca8   100%);
	background: -ms-linear-gradient(left, #ddd6f3  0%, #faaca8   100%);
	background: linear-gradient(to right, #ddd6f3  0%, #faaca8   100%);
}

.custom-radio-button input[type="radio"]#color-grey + label span {
    background: #9CA3AF;
	background: -moz-linear-gradient(left, #9CA3AF 0%, #4B5563 100%);
	background: -webkit-linear-gradient(left, #9CA3AF 0%, #4B5563 100%);
	background: -ms-linear-gradient(left, #9CA3AF 0%, #4B5563 100%);
	background: linear-gradient(to right, #9CA3AF 0%, #4B5563 100%);
}

.custom-radio-button input[type="radio"]#color-light-grey + label span {
    background: #BDD4E7;
	background: -moz-linear-gradient(left, #BDD4E7 0%, #8693AB 100%);
	background: -webkit-linear-gradient(left, #BDD4E7 0%, #8693AB 100%);
	background: -ms-linear-gradient(left, #BDD4E7 0%, #8693AB 100%);
	background: linear-gradient(to right, #BDD4E7 0%, #8693AB 100%);
}

.custom-radio-button input[type="radio"]#color-plade-wood + label span {
    background: #eacda3 ;
	background: -moz-linear-gradient(left, #eacda3  0%, #d6ae7b  100%);
	background: -webkit-linear-gradient(left, #eacda3  0%, #d6ae7b  100%);
	background: -ms-linear-gradient(left, #eacda3  0%, #d6ae7b  100%);
	background: linear-gradient(to right, #eacda3  0%, #d6ae7b  100%);
}

.custom-radio-button input[type="radio"]#color-purple + label span {
	background: #A78BFA;
	background: -moz-linear-gradient(left, #A78BFA 0%, #7C3AED 100%);
	background: -webkit-linear-gradient(left, #A78BFA 0%, #7C3AED 100%);
	background: -ms-linear-gradient(left, #A78BFA 0%, #7C3AED 100%);
	background: linear-gradient(to right, #A78BFA 0%, #7C3AED 100%);
}




/* .custom-radio-button input[type="radio"]:checked + label span {
  opacity: 1;
  background: url("images/tick-icon.png")
    center center no-repeat;
  width: 60px;
  height: 60px;
  display: inline-block;
} */

.custom-radio-button input[type="radio"]:checked + label span i {
    opacity: 1;
    display: inline-block;
    color: white;
    font-size: x-large;
    margin-top: 12px;
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


<!-- Page Content -->
<div class="content container-fluid" style="padding-top: 100px;">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Theme Settings</h3>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="invoice-info">
                                    <h5 class="text-primary">Important Note *</h5>
                                    <p class="text-muted">Once the date format is selected, it cannot be changed. Choose your preferences wisely !!.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /Page Header -->

            @if(!empty($theme_settings))
                {!! Form::open(['url'=>route('theme-setting.update', @$theme_settings->id),'method'=>'PUT','enctype'=>'multipart/form-data','class'=>'needs-validation','novalidate'=>'']) !!}
            @else

            <form action="{{ route('theme-setting.store') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
            @endif
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Website Name</label>
                    <div class="col-lg-9">
                        <input name="website_name" class="form-control" value="{{@$theme_settings->website_name}}" type="text" required>
                        <div class="invalid-feedback">
                                    Please enter a website name.
                        </div>
                        @if($errors->has('website_name'))
                        <div class="invalid-feedback">
                            {{$errors->first('website_name')}}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Currency</label>
                    <div class="col-lg-9">
                        <select class="custom-select form-control" name="currency" >
                            <option value="npr." <?php if(@$theme_settings->currency == 'npr.') echo "selected"; ?>>Nepal - NPR </option>
                            <option value="inr." <?php if(@$theme_settings->currency == 'inr.') echo "selected"; ?>>India - INR </option>
                            <option value="$" <?php if(@$theme_settings->currency == '$') echo "selected"; ?>>USA - Dollar </option>
                            <option value="£" <?php if(@$theme_settings->currency == '£') echo "selected"; ?>>UK - Pound </option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Date Format</label>
                    <div class="col-lg-9">
                        <select class="custom-select form-control" name="default_date_format" >
                        <?php if(!empty(@$theme_settings)){?>
                            <?php if(@$theme_settings->default_date_format == 'english') {?>
                                <option value="english" <?php if(@$theme_settings->default_date_format == 'english') echo "selected"; ?>>English Format</option>
                            <?php }
                            if(@$theme_settings->default_date_format == 'nepali'){ ?>
                                <option value="nepali" <?php if(@$theme_settings->default_date_format == 'nepali') echo "selected"; ?>>Nepali Format</option>
                            <?php }?>
                        <?php }else{?>
                                <option value="english">English Format</option>
                                <option value="nepali">Nepali Format</option>
                            <?php }?>

                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Light Logo</label>
                    <div class="col-lg-7">
                        <input type="file" class="form-control" name="logo"   <?php if(!empty(@$theme_settings)){ }else{ echo 'required';}?> >
                        <span class="form-text text-muted">Recommended image size is 100px x 100px</span>
                        <div class="invalid-feedback">
                                    Please choose a logo.
                        </div>
                        @if($errors->has('logo'))
                        <div class="invalid-feedback">
                            {{$errors->first('logo')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-2">
                        <div class="img-thumbnail float-right"><img src="<?php if(@$theme_settings->logo){?>{{asset('/images/theme/'.@$theme_settings->logo)}}<?php }else{?>{{asset('/backend/assets/img/logo.png')}}<?php }?>" alt="" width="40" height="40"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Favicon</label>
                    <div class="col-lg-7">
                        <input type="file" class="form-control" name="favicon" <?php if(!empty(@$theme_settings)){ }else{ echo 'required';}?>>
                        <span class="form-text text-muted">Recommended image size is 32px x 32px</span>
                        <div class="invalid-feedback">
                                    Please choose a favicon.
                        </div>
                        @if($errors->has('favicon'))
                        <div class="invalid-feedback">
                            {{$errors->first('favicon')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-2">
                        <div class="settings-image img-thumbnail float-right"><img src="<?php if(@$theme_settings->favicon){?>{{asset('/images/theme/'.@$theme_settings->favicon)}}<?php }else{?>{{asset('/backend/assets/img/favicon.png')}}<?php }?>" class="img-fluid" width="16" height="16" alt=""></div>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Color</label>
                    <div class="custom-radio-button col-lg-7">
                        <div>
                            <input type="radio" id="color-red" name="color" value="red" <?php if(@$theme_settings->color=="red"){?> checked <?php }?> >
                            <label for="color-red">
                            <span>
                            <i class="fa fa-check" aria-hidden="true"></i>
                            </span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="color-blue" name="color" value="blue" <?php if(@$theme_settings->color=="blue"){?> checked <?php }?>>
                            <label for="color-blue">
                            <span>
                            <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="color-orange" name="color" value="orange" <?php if(@$theme_settings->color=="orange"){?> checked <?php }?>>
                            <label for="color-orange">
                            <span>
                            <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="color-pink" name="color" value="pink" <?php if(@$theme_settings->color=="pink"){?> checked <?php }?>>
                            <label for="color-pink">
                            <span>
                             <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="color-green" name="color" value="green" <?php if(@$theme_settings->color=="green"){?> checked <?php }?>>
                            <label for="color-green">
                            <span>
                             <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="color-green-beach" name="color" value="green_beach" <?php if(@$theme_settings->color=="green_beach"){?> checked <?php }?>>
                            <label for="color-green-beach">
                            <span>
                             <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="color-lush" name="color" value="lush" <?php if(@$theme_settings->color=="lush"){?> checked <?php }?>>
                            <label for="color-lush">
                            <span>
                             <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>


                        <div>
                            <input type="radio" id="color-almost" name="color" value="almost" <?php if(@$theme_settings->color=="almost"){?> checked <?php }?>>
                            <label for="color-almost">
                            <span>
                             <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="color-grey" name="color" value="grey" <?php if(@$theme_settings->color=="grey"){?> checked <?php }?>>
                            <label for="color-grey">
                            <span>
                             <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>


                        <div>
                            <input type="radio" id="color-light-grey" name="color" value="light_grey" <?php if(@$theme_settings->color=="light_grey"){?> checked <?php }?> <?php if(@$theme_settings->color){ }else{?> checked <?php }?>>
                            <label for="color-light-grey">
                            <span>
                             <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="color-plade-wood" name="color" value="plade_wood" <?php if(@$theme_settings->color=="plade_wood"){?> checked <?php }?>>
                            <label for="color-plade-wood">
                            <span>
                             <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="color-purple" name="color" value="purple" <?php if(@$theme_settings->color=="purple"){?> checked <?php }?>>
                            <label for="color-purple">
                            <span>
                             <i class="fa fa-check" aria-hidden="true"></i>

                            </span>
                            </label>
                        </div>


                    </div>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Page Content -->
@endsection
