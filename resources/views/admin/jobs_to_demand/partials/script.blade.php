<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#jobdemand-index').DataTable({
            paging: true,
            searching: true,
            ordering:  false,
            lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

        });
        $( ".select2" ).select2({
            width:'100%'
        });

    });

    $(document).on('click','.status-update', function (e) {
        e.preventDefault();
        var status = $(this).attr('id');
        var url = $(this).attr('hrm-update-action');
        if(status == "discontinued"){
            swal({
                title: "Are You Sure?",
                text: "The overseas agent status to Dis-continued will prevent them from displaying in Demand Entry in. \n \n Set their status to continued to enable the displaying in Demand Entry!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                statusupdate(url,status);
            });
        }else{
            statusupdate(url,status);
        }

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
                    swal("Trashed!", "Moved to Trash Successfully", "success");
                    // toastr.success('file deleted Successfully');
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
        })

    })

    $(document).on('click','.action-edit', function (e) {
        e.preventDefault();
        var url =  $(this).attr('hrm-edit-action');
        var id=$(this).attr('id');
        var action = $(this).attr('hrm-update-action');
        $.ajax({
            url: $(this).attr('hrm-edit-action'),
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                $("#edit_job_demand").modal("toggle");
                $('#demand_information_id option[value="'+dataResult.job_demand_edit.demand_information_id+'"]').prop('selected', true);
                if(dataResult.job_demand_edit.job_status == "complete"){
                    $('#job_status').prop('checked', true);
                }
                $('#company_name_jobs').attr('value',dataResult.job_demand_edit.demand_information.demand_company ? dataResult.job_demand_edit.demand_information.demand_company.title:'');

                if (dataResult.job_demand_edit.demand_information.demand_company){
                    let company = dataResult.job_demand_edit.demand_information.demand_company;
                    let value = '';
                    if (company.overseas_agent_id){
                        value = company.overseas_agent.company_name ?? company.overseas_agent.fullname ?? '';
                    }else{
                        value = company.title;
                    }

                    $('#client_name').attr('value',value);
                }

                // $('#client_name').attr('value',dataResult.job_demand_edit.demand_information);

                $('#job_category_id option[value="'+dataResult.job_demand_edit.job_category_id+'"]').prop('selected', true);
                $('#requirements').attr('value',dataResult.job_demand_edit.requirements);
                $('#min_qualification option[value="'+dataResult.job_demand_edit.min_qualification+'"]').prop('selected', true);
                $('#contact_period').attr('value',dataResult.job_demand_edit.contact_period);
                $('#working').attr('value',dataResult.job_demand_edit.working);
                $('#holidays').attr('value',dataResult.job_demand_edit.holidays);
                $('#hours').attr('value',dataResult.job_demand_edit.hours);
                $('#salary').attr('value',dataResult.job_demand_edit.salary);
                $('#category_amount').attr('value',dataResult.job_demand_edit.category_amount);

                $('#commission_amount').attr('value',dataResult.job_demand_edit.commission_amount);

                $('#overtime_per_month').attr('value',dataResult.job_demand_edit.overtime_per_month);
                $('#currency option[value="'+dataResult.job_demand_edit.currency+'"]').prop('selected', true);
                $('#accommodation option[value="'+dataResult.job_demand_edit.accommodation+'"]').prop('selected', true);
                $('#food_facilities option[value="'+dataResult.job_demand_edit.food_facilities+'"]').prop('selected', true);
                $('#ticket option[value="'+dataResult.job_demand_edit.ticket+'"]').prop('selected', true);
                $('#overtime option[value="'+dataResult.job_demand_edit.overtime+'"]').prop('selected', true);
                $('#medical_in option[value="'+dataResult.job_demand_edit.medical_in+'"]').prop('selected', true);
                $('#medical_company option[value="'+dataResult.job_demand_edit.medical_company+'"]').prop('selected', true);
                $('#insurance_in option[value="'+dataResult.job_demand_edit.insurance_in+'"]').prop('selected', true);
                $('#insurance_company option[value="'+dataResult.job_demand_edit.insurance_company+'"]').prop('selected', true);
                if(dataResult.job_demand_edit.levy == "yes"){
                    $('#levy').prop('checked', true);
                }
                $('#levy_amount').attr('value',dataResult.job_demand_edit.levy_amount);
                $('#remarks').text(dataResult.job_demand_edit.remarks);
                $('.updatejobsdemand').attr('action',action);
            },
            error: function(error){
                if(error.statusText="Forbidden"){
                    $("#error-forbidden").modal("toggle");

                }
            }
        });
    });

    $(document).on('click','.action-view', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('hrm-view-action'),
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                $('#view-ref-no').text(dataResult.demand_information.ref_no);
                $('#view-job-category').text(dataResult.job_category.name);
                $('#view-job-status').text(dataResult.job_status);
                $('#view-requirements').text(dataResult.requirements+" per person");
                $('#view-min-qualification').text(dataResult.min_qualification);
                $('#view-contact-period').text(dataResult.contact_period+" per year");
                $('#view-working').text(dataResult.working+" per weeks/days");
                $('#view-holidays').text(dataResult.holidays+" per days/year");
                $('#view-hours').text(dataResult.hours+" per days");
                $('#view-salary').text(dataResult.salary+" per month");
                $('#view-overtime').text(dataResult.overtime);
                $('#view-overtime-per-month').text(dataResult.overtime_per_month+" per month");
                $('#view-currency').text(dataResult.currency);
                $('#view-accommodation').text(dataResult.accommodation);
                $('#view-food-facilities').text(dataResult.food_facilities);
                $('#view-ticket').text(dataResult.ticket);
                $('#view-medical-in').text(dataResult.medical_in);
                $('#view-medical-company').text(dataResult.medical_company);
                $('#view-insurance-in').text(dataResult.insurance_in);
                $('#view-insurance-company').text(dataResult.insurance_company);
                $('#view-levy').text(dataResult.levy);
                $('#view-levy-amount').text(dataResult.levy_amount);
                $('#view-remarks').text(dataResult.remarks);
            }
        });
    });

    $(document).on('change','select[name="demand_information_id"]', function (e) {
        e.preventDefault();
        var value=$(this).val();
        console.log(value);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            type: "POST",
            url: "{{ route('jobs.demand-info') }}",
            data: {'demand_id':value},
            success: function(data) {
                $('.select-company').val(data.demand_company.title);
                if (data.demand_company){
                    let company = data.demand_company;
                    let value = '';
                    if (company.overseas_agent_id){
                        value = company.overseas_agent.fullname ?? company.overseas_agent.company_name ?? '';
                    }else{
                        value = company.title;
                    }

                    $('.select-client-name').attr('value',value);
                }
                // $('.select-client-name').attr('value',data.overseas_agent.fullname);
            },
            error: function() {
                swal({
                    title: 'Jobs to Demand error',
                    text: "Error. Could not confirm the status of the demand info.",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                });
            }
        });

    });

    function statusupdate(url,status){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: url,
            type: "PATCH",
            cache: false,
            data:{
                job_status: status,
            },
            success: function(dataResult){
                if(dataResult == "yes"){
                    swal("Success!", "Job To Demand Status has been updated", "success");
                    $(dataResult).remove();
                    setTimeout(function() {
                        window.location.reload();
                    }, 2500);
                }else{
                    swal({
                        title: "Error!",
                        text: "Failed to update Job To Demand status",
                        type: "error",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    }, function(){
                        //window.location.href = ""
                        swal.close();
                    })
                }
            },
            error: function() {
                swal({
                    title: 'Job To Demand  Warning',
                    text: "Error. Could not confirm the status of the job To demand .",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                });
            }
        });
    }

    $(document).on('change','.working_per_day', function (e) {
        e.preventDefault();
        let type = $(this).data('id');
        let hour_per_day = 8, week = 7;

        let holidays    = (week - $(this).val());
        let total_hours = (hour_per_day * $(this).val());

        if(type == 'create'){
            $('.holidays').attr('value', holidays);
            $('.hours').attr('value', total_hours);
        }else{
            $('#holidays').attr('value', holidays);
            $('#hours').attr('value', total_hours);
        }
    });
</script>
