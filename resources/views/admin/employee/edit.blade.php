@extends('layouts.user_management_master')
@section('title') Edit Employee @endsection
@section('css')
    <style>
          .personal-profile{
            width: 50px;
            height: 50px;
        }
        .avatar > img {
            height: 100%;
        }

        #select2-gender-container{
            text-transform: capitalize;
        }

        #select2-role_id-container{
            text-transform: capitalize;
        }
        .capital{
            text-transform: capitalize;
        }

        .margin-right{
            margin-right: 5px;
        }
        .title {
            text-transform: capitalize;
        }
        span.task-label {
            text-transform: capitalize;
        }
        i.white{
            color: #fff!important;
        }
        .select-height{
            height:44px;
        }

        .download-button{
            margin-top:10px
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


    @if($errors->has('email'))
    <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('email')}}</span>
            </p>
        </div>
    @endif

    @if($errors->has('cv'))
    <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('cv')}}</span>
            </p>
        </div>
    @endif

    @if($errors->has('citizenship'))
    <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('citizenship')}}</span>
            </p>
        </div>
    @endif

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Edit Employee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user')}}">User Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('employee.index')}}">Employee</a></li>
                        <li class="breadcrumb-item active">Edit Employee </li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                        <a href="{{route('employee.create')}}" class="btn add-btn" ><i class="fa fa-plus"></i> Add Employee</a>
                    </div>
               
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['method'=>'put','route'=>['employee.update', $editemployee->id, $editemployee->user->id],'enctype'=>'multipart/form-data','class'=>'needs-validation','novalidate'=>'']) !!}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-img-wrap edit-img">
                                    @if($editemployee->user->image !="")
                                    <img class="inline-block" id="currentedit-img" src="{{asset('/images/user/'.@$editemployee->user->image)}}" alt="user-profile" >

                                    @else
                                    <img class="inline-block" id="currentedit-img" src="{{asset('/images/profiles/others.png')}}" alt="user-profile" >
                                    @endif
                                    <div class="fileupload btn">
                                        <span class="btn-text">edit</span>
                                        <input class="upload" type="file" id="image-edit" onchange="loadEdit(event)" name="image">
                                    </div>
                                    <div class="invalid-feedback">
                                        Please choose a Profile picture.
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name<span class="text-danger"> *</span></label>
                                                <input type="text" name="name" class="form-control" value="{{@$editemployee->user->name}}" required>
                                                <div class="invalid-feedback">
                                                    Please enter your name.
                                                </div>
                                                @if($errors->has('name'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('name')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email<span class="text-danger"> *</span></label>
                                                <input type="email" class="form-control" name="email" value="{{@$editemployee->user->email}}" required>
                                                <div class="invalid-feedback">
                                                    Please enter your email.
                                                </div>
                                                @if($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('email')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Birth Date<span class="text-danger"> *</span></label>
                                                <div class="cal-icon">
                                                    <input class="form-control" id="datetimepicker" name="dob" type="text" value="{{@$editemployee->user->dob}}" required>
                                                    <div class="invalid-feedback">
                                                        Please enter your Date of Birth.
                                                    </div>
                                                    @if($errors->has('dob'))
                                                        <div class="invalid-feedback">
                                                            {{$errors->first('dob')}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gender<span class="text-danger"> *</span></label>
                                                <select class="select form-control" name="gender" required>
                                                    <option {{ $editemployee->user->gender == "male" ? 'selected' :'' }} value="male"> Male</option>
                                                    <option {{ $editemployee->user->gender == "female" ? 'selected' :'' }}  value="female">Female</option>
                                                    <option {{ $editemployee->user->gender == "others" ? 'selected' :'' }}  value="others">Others</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select your gender.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Father Name<span class="text-danger"> *</span></label>
                                        <input type="text" name="father_name" value="{{@$editemployee->father_name}}" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Please enter your father name.
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mother Name<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" value="{{@$editemployee->mother_name}}" name="mother_name" required>
                                        <div class="invalid-feedback">
                                            Please enter your mother name.
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control"   value="{{@$editemployee->user->address}}"  name="address" required>
                                        <div class="invalid-feedback">
                                            Please enter a your address.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number<span class="text-danger"> *</span></label>
                                        <input type="number" class="form-control" name="contact" value="{{@$editemployee->user->contact}}"  required>
                                        <div class="invalid-feedback">
                                            Please enter a your phone number.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile Number<span class="text-danger"> *</span></label>
                                        <input type="number" class="form-control" name="contact_no" value="{{@$editemployee->contact_no}}" required>
                                        <div class="invalid-feedback">
                                            Please enter a your  mobile no.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency Contact Number</label>
                                        <input type="number" class="form-control" name="emergency_contact" value="{{@$editemployee->emergency_contact}}" required>
                                        <div class="invalid-feedback">
                                            Please enter a your emergency contact number.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Marital Status  <span class="text-danger"> *</span></label>
                                        <select class="custom-select select-height" name="marital_status"   required>
                                            <option value disabled selected> Select Marital Status</option>
                                            <option {{ $editemployee->marital_status == "single" ? 'selected' :'' }} value="single"> Single </option>
                                            <option {{ $editemployee->marital_status == "married" ? 'selected' :'' }} value="married"> Married </option>
                                            <option {{ $editemployee->marital_status == "widowed" ? 'selected' :'' }} value="widowed"> Widowed </option>
                                            <option {{ $editemployee->marital_status == "divorced" ? 'selected' :'' }} value="divorced"> Divorced </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a Marital Status.
                                        </div>
                                        @if($errors->has('marital_status'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('marital_status')}}
                                            </div>
                                        @endif
                                    </div>
                                   
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department<span class="text-danger"> *</span></label>
                                        <select class="select form-control department" name="department_id" required>
                                        <option value disabled selected> Select Department</option>
                                            @foreach($departments as $department)
                                            <option  {{ $editemployee->department_id == $department->id ? 'selected' :'' }} value="{{$department->id}}">{{ucfirst($department->name)}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select department for the employee.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Designation <span class="text-danger">*</span></label>
                                        <select class="custom-select" name="designation_id" required>
                                            <option value disabled selected> Select Designation</option>
                                            @foreach($designationsvalue as $key=> $value)
                                            <option {{ $editemployee->designation_id == $key ? 'selected' :'' }}  value="{{@$key}}">{{@$value}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a designation.
                                        </div>
                                        @if($errors->has('designation_id'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('designation_id')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Job Status  <span class="text-danger"> *</span></label>
                                        <select class="custom-select select-height" name="job_status"   required>
                                            <option value disabled selected> Select Job Status</option>
                                            <option {{ $editemployee->job_status == "permanent" ? 'selected' :'' }} value="permanent"> Permanent </option>
                                            <option {{ $editemployee->job_status == "temporary" ? 'selected' :'' }} value="temporary"> Temporary </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a Job Status.
                                        </div>
                                        @if($errors->has('job_status'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('job_status')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role<span class="text-danger"> *</span></label>
                                        <select class="select form-control" name="role_id" required>
                                            @foreach($all_roles as $role)
                                            <option {{ $userrole->id == $role->id ? 'selected' :'' }} value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select one role for the employee.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Type here when you want to change password" >
                                        <div class="invalid-feedback">
                                            Please enter a password for the employee.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CV File:</label>
                                        <input type="file" class="form-control" name="cv" >
                                        <div class="invalid-feedback">
                                            Please upload the cv.
                                        </div>
                                        @if($editemployee->cv != "")
                                            <a href="{{url('/cv/download/'.$editemployee->cv)}}" class="download-button btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Click to download"><i class="icon fa fa-cloud-download"> Download CV</i></a>
                                        @endif
                                        @if($errors->has('photograph_image'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('photograph_image')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Citizenship Image:</label>
                                        <input type="file" class="form-control" name="citizenship">
                                        <div class="invalid-feedback">
                                            Please upload the citizenship.
                                        </div>
                                        @if($editemployee->citizenship != "")
                                            <a href="{{url('/citizenship/download/'.$editemployee->citizenship)}}" class="download-button btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Click to download"><i class="icon fa fa-cloud-download"> Download Citizenship</i></a>
                                        @endif
                                        @if($errors->has('citizenship'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('citizenship')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Update Employee</button>
                            </div>
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->


@endsection
@section('js')
    <script type="text/javascript">

        var loadEdit = function(event) {
            var image = document.getElementById('image-edit');
            var replacement = document.getElementById('currentedit-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };
     
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
        
            <?php if(@$theme_data->default_date_format=='nepali'){ ?>

            $('#datetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

            $('#datetimepicker-edit').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            <?php }else if(@$theme_data->default_date_format=='english'){ ?>


            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'

            });
            $('#datetimepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'

            });

            <?php }else{?>
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            })
            $('#datetimepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'
            })

            <?php }?>

        });

        $(document).on('change','select[name="department_id"]', function (e) {
            e.preventDefault();
            var value=$(this).val();
            var action = "{{ route('employee-department.designation') }}?department=" + $(this).val();
            $.ajax({
                url: action,
                type: "GET",
                success: function(dataResult){
                    var designation;
                    designation += '<option value disabled selected> Select Designation</option>';

                        $.each(dataResult, function (index, value) {
                            designation +=  '<option value="'+index+'">'+value+'</option>';
                        });

                    $('select[name="designation_id"]').html(designation);
                },
                error: function(error){

                }
            });
        });

    </script>
@endsection
