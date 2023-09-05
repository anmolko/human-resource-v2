@extends('layouts.setting_master')
@section('title') Country Setting @endsection
@section('css')
<style>
   .select2-container {
            width: 440px;
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
<div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Country Settings</h3>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_country_state"><i class="fa fa-plus"></i> Add Country's State</a>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('country-setting.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                <!-- Country Group Table -->
                <table id="country-index" class="table table-striped custom-table mb-0 ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Country Name</th>
                        <th>Country Code </th>
                        <th>State</th>
                        <th>Currency </th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($country_settings as $country_setting)
                    <tr>
                        <td> {{$i++}}          </td>
                        <td> {{@$country_setting->country}} </td>
                        <td> {{@$country_setting->country_code}} </td>
                        <td> {{ucwords(@$country_setting->state)}} </td>
                        <td> {{@$country_setting->currency}} </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                            
                                    <a class="dropdown-item action-edit" href="#" hrm-update-action="{{route('country-setting.update',$country_setting->id)}}"  hrm-edit-action="{{route('country-setting.edit',$country_setting->id)}}" data-toggle="modal" data-target="#edit_country_setting"><i class="fa fa-edit m-r-5"></i> Edit </a>
                                    <a class="dropdown-item action-delete"  href="#" hrm-delete-action="{{route('country-setting.destroy',$country_setting->id)}}" data-target="#delete_country_setting"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                   
                    </tbody>
                </table>
                <!-- /Country Info Table -->

            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->

  <!-- Add Country State Modal -->
  @include('admin.modals.country_state.add')
    <!-- /Add Country State Modal -->

      <!-- Edit Country State Modal -->
  @include('admin.modals.country_state.edit')
    <!-- /Edit Country State Modal -->


@endsection
@section('js')
    <script type="text/javascript">
    

        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
           
            $( "select[name='country']" ).select2({
                width: 'style',
            });

           

           

            $('#country-index').DataTable({
                paging: true,
                searching: true,
                orderable: false,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

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
                        if(response == 0){
                            swal({
                                title: "Warning!",
                                text: "You need to Remove Assigned Candidate Entry First",
                                type: "info",
                                showCancelButton: true,
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true,
                            }, function(){
                                //window.location.href = ""
                                swal.close();
                            })
                        }else{
                            swal("Trashed!", "Moved to Trash Successfully", "success");
                            // toastr.success('file deleted Successfully');
                            $(response).remove();
                            window.location.reload();
                        }
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
            // console.log(action)
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    // $('#id').val(data.id);
                    console.log(dataResult);
                    $("#edit_country_setting").modal("toggle");
                    $('#state').attr('value',dataResult.editcountry.state);
                    $('#currency').attr('value',dataResult.editcountry.currency);
                    
                    $('.updatecountry option[value="'+dataResult.editcountry.country_code+'"]').prop('selected', true);
                   
                    $('.updatecountrystate').attr('action',action);
                  
                    $('#select2-editcountry-container').text(dataResult.editcountry.country);
                      
                 
                   
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        // $("#error-forbidden").modal("toggle");

                    }
                }
            });
        });
     
      
    </script>
@endsection