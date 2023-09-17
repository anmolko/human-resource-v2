@extends('layouts.master')
@section('title') Candidate @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/nepali.datepicker.v3.5.min.css')}}">
    <style>
        .modal-lg, .modal-xl {
            max-width: 920px;
        }
    /*
    *
    * ==========================================
    * CUSTOM UTIL CLASSES
    * ==========================================
    */
    #v-pills-tabContent {
        padding-top: 0;
    }

        .custom-modal .modal-content {
            background-color: #f6f8f6;
        }

    .select-height{
        height: 44px;
    }
    .nav-pills-custom .nav-link {
        color: #8595ad;
        background: #fff;
        position: relative;
    }


    /* Add indicator arrow for the active tab */
    @media (min-width: 992px) {
        .nav-pills-custom .nav-link::before {
            content: '';
            display: block;
            border-top: 8px solid transparent;
            border-left: 10px solid #fff;
            border-bottom: 8px solid transparent;
            position: absolute;
            top: 50%;
            right: -10px;
            transform: translateY(-50%);
            opacity: 0;
        }
    }

    .nav-pills-custom .nav-link.active::before {
        opacity: 1;
    }
    @media (min-width: 768px) {
    .side-tab-sticky{
        position: sticky;
        overflow-y: auto;
        top: 75px;
        bottom: 0;
        height: 160vh;
    }
}

    #select2-candidate_type-container{
        text-transform: capitalize;
    }
    #select2-martial_status-container{
        text-transform: capitalize;
    }
    #select2-kin_relationship-container{
        text-transform: capitalize;
    }
    #select2-gender-container{
        text-transform: capitalize;
    }
    #select2-religion-container{
        text-transform: capitalize;
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



    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Candidate Entry</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Candidate Entry</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_candidate_personal_info"><i class="fa fa-plus"></i> Add Candidate Info</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('candidate-personal-info.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <form action="#" method="post" id="deleted-form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="delete">

                    </form>
                    <!-- Candidate Personal Table -->
                    <table id="candidate-index" class="table table-striped custom-table mb-0 ">
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn btn-sm btn-info print-candidate-app"><i class="fa fa-print"></i> Print Application</a>
                        </div>
                        <form action="#" method="post" route id="candidate-application-form" >
                            {{csrf_field()}}

                        </form>
                        <thead>
                        <tr>
                            <th>
                                <button class="btn btn-sm btn-info" id="select-all" value="check all">select all</button>
                            </th>
                            <th>Fullname</th>
                            <th>Registration No.</th>
                            <th>Serial No.</th>
                            <th>Contact Number</th>
                            <th>Passport No.</th>
                            <th>Created By</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach(@$candidate_personal as $personal)
                            <tr>
                                <td><label><input type="checkbox" name="cb-element" class="cb-element" value="{{@$personal->id}}" {{ ($personal->demandJobInfo !== null) ? "":"disabled readonly" }}  /></label></td>
                                <td><a href="{{route('candidate-individual.dashboard',$personal->id)}}" >{{@$personal->candidate_firstname}} {{@$personal->candidate_middlename}} {{@$personal->candidate_lastname}}</a></a></td>
                                <td>{{@$personal->registration_no}}</td>
                                <td>{{@$personal->serial_no}}</td>
                                <td>{{@$personal->contact_no}},<br/> {{@$personal->mobile_no}}</td>
                                <td>{{ucwords(@$personal->passport_no)}}</td>
                                <td> {{ucwords(App\Models\User::find($personal->created_by)->name)}}</td>
                                <td class="text-right">
{{--                                    <div class="dropdown dropdown-action">--}}
{{--                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                            <a class="dropdown-item action-edit" href="#" hrm-edit-action="{{route('candidate-personal-info.edit',$personal->id)}}" hrm-update-action="{{route('candidate-personal-info.update',$personal->id)}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                            <a class="dropdown-item" id="{{$personal->id}}" href="{{route('candidate-personal-info.addalldetails',$personal->id)}}"><i class="fa fa-plus m-r-5"></i> Add candidate details </a>--}}
{{--                                            @if($personal->demandJobInfo !== null)--}}
{{--                                                <a class="dropdown-item action-application" id="{{$personal->id}}" hrm-view-action="{{route('candidate-personal-info.application',$personal->id)}}" data-toggle="modal" data-target="#choose_application" href="#"><i class="fa fa-copy m-r-5"></i> Employment Application </a>--}}
{{--                                            @endif--}}
{{--                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('candidate-personal-info.destroy',$personal->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-edit" href="#" hrm-edit-action="{{route('candidate-personal-info.edit',$personal->id)}}" hrm-update-action="{{route('candidate-personal-info.update',$personal->id)}}" data-toggle="modal">
                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="edit-item-btn" href="{{route('candidate-personal-info.addalldetails',$personal->id)}}" id="{{$personal->id}}">
                                                    <i class="fa fa-plus align-bottom me-2 text-muted"></i> </a></li>
                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-delete" hrm-delete-action="{{route('candidate-personal-info.destroy',$personal->id)}}">
                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /Candidate Entry Table -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Add candidate personal info Modal -->
    @include('admin.modals.candidate.add')
    <!-- /Add candidate personal info Modal -->

    <!-- Add candidate personal info Modal -->
    @include('admin.modals.candidate.edit')
    <!-- /Add candidate personal info Modal -->

    {{--professional modals--}}

    <!-- Add candidate personal info Modal -->
    @include('admin.modals.candidate.professional.add')
    <!-- /Add candidate personal info Modal -->

     <!-- Forbidden Attribute Modal -->
     @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Attribute Modal -->

    <!-- view Branch Office Modal -->
    @include('admin.modals.application.chooseapp')
    <!-- /view Branch Office Modal -->

@endsection
@section('js')
    <script src="{{asset('backend/assets/js/nepali.datepicker.v3.5.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript">
        var loadFile = function(event) {
            var image = document.getElementById('image');
            var replacement = document.getElementById('current-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadEdit = function(event) {
            var image = document.getElementById('image-edit');
            var replacement = document.getElementById('currentedit-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };
    $(document).ready(function () {
        $( ".select2" ).select2({
            width:'100%'
        });

        $("#select-all").click(function () {
            if ($("#select-all").val() == "check all") {
                $(".cb-element").not(":disabled").prop("checked", true);
                $("#select-all").val("uncheck all");
            } else if ($("#select-all").val() == "uncheck all") {
                $(".cb-element").not(":disabled").prop("checked", false);
                $("#select-all").val("check all");
            }
        });

        // $('#nepali-dob-datepicker').nepaliDatePicker({
        //     ndpYear: true,
        //     ndpMonth: true,
        //     ndpYearCount: 10,
        //     dateFormat :'YYYY-MM-DD',
        //     language: "english",
        // });
        // $('#edit-nepali-dob-datepicker').nepaliDatePicker({
        //     ndpYear: true,
        //     ndpMonth: true,
        //     ndpYearCount: 10,
        //     dateFormat :'YYYY-MM-DD',
        //     language: "english",
        // });
        $('#english-dob-datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: moment()

        });
        $('#edit-english-dob-datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: moment()
        });

        <?php if(@$theme_data->default_date_format=='nepali'){ ?>

            $('#issuedatetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#edit-issuedatetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

            $('#expiredatetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#edit-expiredatetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#dobdatetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#edit-dobdatetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#datepicker-from').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

            $('#datepicker-to').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

        <?php }
        else if(@$theme_data->default_date_format=='english'){ ?>
            $("#issuedatetimepicker").on("dp.change", function (e) {
                // Add 2 years to the selected date (you can change the number of years as needed)
                var newDate = e.date.clone().add(10, 'years');

                // Set the new date in expiredatetimepicker
                $('#expiredatetimepicker').data("DateTimePicker").date(newDate);

                $('#expiredatetimepicker').data("DateTimePicker").minDate(e.date);
            });
            $("#edit-issuedatetimepicker").on("dp.change", function (e) {
                // Add 2 years to the selected date (you can change the number of years as needed)
                var newDate = e.date.clone().add(10, 'years');

                // Set the new date in expiredatetimepicker
                $('#edit-expiredatetimepicker').data("DateTimePicker").date(newDate);

                $('#edit-expiredatetimepicker').data("DateTimePicker").minDate(e.date);
            });

            $('#issuedatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#edit-issuedatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#expiredatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false
            });
            $('#edit-expiredatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false

            });
            $('#dobdatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'

            });
            $('#edit-dobdatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#datepicker-from').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#datepicker-to').datetimepicker({
                format: 'YYYY-MM-DD'
            });


            $("#edit-dobdatetimepicker").on("dp.change", function() {
                var today = new Date(),
                dob = new Date($(this).val()),
                age = new Date(today - dob).getFullYear() - 1970;
                $('#age').attr('value',age);
            });

            $("#dobdatetimepicker").on("dp.change", function() {
                var today = new Date(),
                dob = new Date($(this).val()),
                age = new Date(today - dob).getFullYear() - 1970;
                $('#addage').attr('value',age);
            });
        <?php }
        else{?>
            $("#issuedatetimepicker").on("dp.change", function (e) {
            // Add 2 years to the selected date (you can change the number of years as needed)
            var newDate = e.date.clone().add(10, 'years');

            // Set the new date in expiredatetimepicker
            $('#expiredatetimepicker').data("DateTimePicker").date(newDate);

            $('#expiredatetimepicker').data("DateTimePicker").minDate(e.date);
            });
            $("#edit-issuedatetimepicker").on("dp.change", function (e) {
                // Add 2 years to the selected date (you can change the number of years as needed)
                var newDate = e.date.clone().add(10, 'years');

                // Set the new date in expiredatetimepicker
                $('#edit-expiredatetimepicker').data("DateTimePicker").date(newDate);

                $('#edit-expiredatetimepicker').data("DateTimePicker").minDate(e.date);
            });
            $('#issuedatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#edit-issuedatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#expiredatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false
            });
            $('#edit-expiredatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false

            });
            $('#dobdatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#edit-dobdatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#datepicker-from').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#datepicker-to').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $("#dobdatetimepicker").on("dp.change", function() {
                var today = new Date(),
                dob = new Date($(this).val()),
                age = new Date(today - dob).getFullYear() - 1970;
                $('#addage').attr('value',age);
            });

            $("#edit-dobdatetimepicker").on("dp.change", function() {
                var today = new Date(),
                dob = new Date($(this).val()),
                age = new Date(today - dob).getFullYear() - 1970;
                $('#age').attr('value',age);
            });

        <?php }?>

<!---->
       function format(mainvalue) {
           console.log(mainvalue);
           var inner_table = '<span>Professional Detail</span><table class="child_row-verified table-responsive table table-striped table-bordered nowrap"><thead><tr><th>Job Ref No</th><th>Company Name</th><th>Job Category</th><th>Designation</th><th>Duration</th><th>From</th><th>To</th><th>Action</th></tr></thead><tbody>';
           $.each(mainvalue.professional_info, function( index, value ) {
               var viewroute    = "/candidate-professional-info/"+ value.id +"/single";
               var updateroute  = "/candidate-professional-info/"+ value.id;
               var editroute    = "/candidate-professional-info/"+ value.id +"/edit";
               var destroyroute = "/candidate-professional-info/"+ value.id +"/destory";
               inner_table += '<td>' +
                   value.job_ref_no + '</td><td>'
                   + value.company_name + '</td><td>'
                   + value.category_of_job
                   + '</td><td>' + value.designation + '</td><td><span class="text-capitalize">'
                   + value.duration
                   + '</span></td><td>' + value.from + '</td>' +
                   '<td>'+ value.to +'</td>'+
                   '<td style=" text-align: center;">' +
                       '<div class="dropdown dropdown-action">'+
                       '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>'+
                       '<div class="dropdown-menu dropdown-menu-right">'+
                       '<a class="dropdown-item action-jobs-view" href="#" hrm-view-action="'+ viewroute +'" data-toggle="modal" data-target="#view_job_demand" id="'+ value.id +'"><i class="fa fa-eye m-r-5"></i> View </a>'+
                       '<a class="dropdown-item action-jobs-edit" href="#" id="'+ value.id +'" hrm-update-action="'+ updateroute +'"  hrm-edit-action="'+ editroute +'" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>'+
                       '<a class="dropdown-item action-jobs-delete" href="#"  hrm-delete-action="'+ destroyroute +'" ><i class="fa fa-trash-o m-r-5"></i> Remove</a>'+
                       '</div>'+
                       '</div>'+
                   '</td></tr>';
           });

           inner_table += '<span>Professional Detail</span><table class="child_row-verified table-responsive table table-striped table-bordered nowrap"><thead><tr><th>Job Ref No</th><th>Company Name</th><th>Job Category</th><th>Designation</th><th>Duration</th><th>From</th><th>To</th><th>Action</th></tr></thead><tbody>';
           return inner_table;
       }

        var table = $('#candidate-index').DataTable({
            paging: true,
            searching: true,
            ordering:  false,
            lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

        });

        // $('#candidate-index tbody').off('click', 'td.details-control');
        // $('#candidate-index tbody').on('click', 'td.details-control', function () {
        //     var tr = $(this).closest('tr');
        //     var row = table.row(tr);
        //
        //     if (row.child.isShown()) {
        //         // This row is already open - close it
        //         row.child.hide();
        //         tr.removeClass('shown');
        //     } else {
        //         // Open this row
        //         row.child(format(tr.data('child-value'))).show();
        //         tr.addClass('shown');
        //     }
        // });

    });

    $(document).on('click','.action-edit', function (e) {
        e.preventDefault();
        var url =  $(this).attr('hrm-edit-action');
        // console.log(action)
        var id=$(this).attr('id');
        var action = $(this).attr('hrm-update-action');
        var src;
        $.ajax({
            url: $(this).attr('hrm-edit-action'),
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                // console.log(dataResult);
                if(dataResult.image == null && dataResult.gender === "male"){
                        src = '/images/profiles/male.png';
                    }else if(dataResult.image == null && dataResult.gender === "female"){
                        src = '/images/profiles/female.png';
                    }else if(dataResult.image == null && dataResult.gender === "others"){
                        src = '/images/profiles/others.png';
                    }else{
                        src = '/images/candidate_info/'+dataResult.image;
                    }

                showHideMaritialDetails(dataResult.martial_status, $('#martial_status').attr('data-id'));
                $("#edit_candidate_personal_info").modal("toggle");
                $('#registration_no').attr('value',dataResult.registration_no);
                $('#serial_no').attr('value',dataResult.serial_no);
                $('.update_registration_date_ad').attr('value',dataResult.registration_date_ad);
                $('.update_registration_date_bs').attr('value',dataResult.registration_date_bs);
                $('.update_issued_date').attr('value',dataResult.issued_date);
                $('.update_expiry_date').attr('value',dataResult.expiry_date);
                $('#passport_no').attr('value',dataResult.passport_no);
                $('#birth_place').attr('value',dataResult.birth_place);
                $('#receipt_no').attr('value',dataResult.receipt_no);
                $('#document_processing_fee').attr('value',dataResult.document_processing_fee);
                $('#advance_fee').attr('value',dataResult.advance_fee);
                $('#passport_status').val(dataResult.passport_status ?? 0).trigger('change');
                $('#candidate_firstname').attr('value',dataResult.candidate_firstname);
                $('#candidate_middlename').attr('value',dataResult.candidate_middlename);
                $('#candidate_lastname').attr('value',dataResult.candidate_lastname);
                $('#age').attr('value',dataResult.age);
                $('#next_of_kin').attr('value',dataResult.next_of_kin);
                $('#select2-kin_relationship-container').text(dataResult.kin_relationship);
                $('#select2-gender-container').text(dataResult.gender);
                $('#kin_relationship option[value="'+dataResult.kin_relationship+'"]').prop('selected', true);
                $('#reference_information_id option[value="'+dataResult.reference_information_id+'"]').prop('selected', true);
                $('#gender option[value="'+dataResult.gender+'"]').prop('selected', true);
                $('#kin_contact_no').attr('value',dataResult.kin_contact_no);
                $('#nationality').val(dataResult.nationality ?? 'nepali').trigger('change');
                $('#select2-religion-container').text(dataResult.religion);
                $('#religion option[value="'+dataResult.religion+'"]').prop('selected', true);
                $('.update_date_of_birth').attr('value',dataResult.date_of_birth);
                $('#mobile_no').attr('value',dataResult.mobile_no);
                $('#contact_no').attr('value',dataResult.contact_no);
                $('#martial_status').val(dataResult.martial_status).trigger('change');

                $('#province').val(dataResult.province).trigger('change');

                setTimeout(function() {
                    $('#district').val(dataResult.district).trigger('change');
                }, 1000);

                $('#spouse').attr('value',dataResult.spouse);
                $('#children').attr('value',dataResult.children);
                $('#email_address').attr('value',dataResult.email_address);
                $('#height').attr('value',dataResult.height);
                $('#weight').attr('value',dataResult.weight);
                $('#father_name').attr('value',dataResult.father_name);
                $('#father_contact_no').attr('value',dataResult.father_contact_no);
                $('#mother_name').attr('value',dataResult.mother_name);
                $('#mother_contact_no').attr('value',dataResult.mother_contact_no);
                $('#permanent_address').attr('value',dataResult.permanent_address);
                $('#temporary_address').attr('value',dataResult.temporary_address);
                $('#aboard_contact_no').attr('value',dataResult.aboard_contact_no);
                $('#select2-candidate_type-container').text(dataResult.candidate_type);
                $('#currentedit-img').attr('src',src);
                $('#candidate_type option[value="'+dataResult.candidate_type+'"]').prop('selected', true);
                $('.updatecandidatepersonal').attr('action',action);
            },
            error: function(error){
                if(error.statusText="Forbidden"){
                    $("#error-forbidden").modal("toggle");

                }
            }
        });
    });

    $(document).on('click','.action-delete', function (e) {
        e.preventDefault();
        var form = $('#deleted-form');
        var action = $(this).attr('hrm-delete-action');
        form.attr('action',$(this).attr('hrm-delete-action'));
        $url = form.attr('action');
        var form_data = form.serialize();
        // $('.deleterole').attr('action',action);
        swal({
            title: "Are You Sure?",
            text: "This item will be moved to trash",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function(){
            $.post( $url, form_data)
                .done(function(response) {
                    console.log(response);
                    swal("Trashed!", "Moved to Trash Successfully", "success");
                    $(response).remove();
                    window.location.reload();
                })
                .fail(function(response){
                    if(response.statusText="Forbidden"){
                        swal({
                            title: "Forbidden Error - 403",
                            text: "You do not have permission to execute !",
                            type: "error",
                            showCancelButton: true,
                            closeOnConfirm: false,
                        }, function(){
                            swal.close();
                        })
                    }
                });
        });
    });

    $(document).on('click','.action-application', function (e) {
        e.preventDefault();
        var id     = $(this).attr('id');
        var action = $(this).attr('hrm-view-action');
        $("#choose_application").modal("toggle");
        $('.updateapplicationchoice').attr('action',action);
    });

    $(document).on('click','.print-candidate-app', function (e) {
        e.preventDefault();
        // var url =  $(this).attr('hrm-edit-action');
        var candidate_id_list = [];
        $("input:checkbox[name=cb-element]:checked").each(function(){
            candidate_id_list.push($(this).val());
        });

        if (candidate_id_list.length === 0) {
            console.log("empty list");
        }
        else{
            console.log(candidate_id_list);
            var post_url       = "{{route('candidate-personal-info.generateapp')}}"; //get form action url
            var form_data  = new FormData(); //Creates new FormData object
            $("input:checkbox[name=cb-element]:checked").each(function(){
                form_data.append('can_id[]',$(this).val());
                $('form#candidate-application-form').append('<input type="hidden" name="can_id[]" value="'+$(this).val()+'" />');
            });
            $('form#candidate-application-form').attr('action',post_url);
            $('form#candidate-application-form').submit();
        }

    });
    $(document).on('change','select[name="martial_status"]', function (e) {
        e.preventDefault();
        let value   = $(this).val();
        let data_id = $(this).attr('data-id');
        showHideMaritialDetails(value,data_id);
    });

    function showHideMaritialDetails(value,data_id){
        let selector = data_id == 'index' ? '.martial_status_details':'#martial_status_details';
        if (value == 'single'){
            $(selector).addClass('d-none');
        }else{
            $(selector).removeClass('d-none');
        }
    }

        $(document).on('change','select[name="province"]', function (e) {
            e.preventDefault();
            var value   = $(this).val();
            var data_id = $(this).attr('data-id');

            $.ajax({
                type: "GET",
                url: "{{ route('candidate-personal-info.get_districts') }}",
                data: {'key':value},
                success: function(data) {
                    if (data_id == 'create'){
                        var selectField = $('.district');
                    }else{
                        var selectField = $('#district');
                    }

                    // Clear existing options
                    selectField.empty();

                    // Add a default option
                    selectField.append('<option value="">Select District</option>');

                    // Loop through the data and add options to the select field
                    $.each(data.districts, function (index, item) {
                        selectField.append('<option value="' + index + '">' + item + '</option>');
                    });
                },
                error: function() {
                    swal({
                        title: 'Fetching states error',
                        text: "Error. Could not confirm the status of the Company related states.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });

        });



    </script>

@endsection
