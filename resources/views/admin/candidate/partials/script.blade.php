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
