@extends('layouts.account_master')
@section('title') Secondary Group @endsection
@section('css')
    <style>
        p.no-permission{
            color: #e81f1f;
            font-size: 20px;
        }


        .scrollbar
        {
            height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* .force-overflow
        {
            min-height: 450px;
        } */

        table.table.table-striped.custom-table.force-overflow tbody.row tr > td {
            border-top: none;
        }
        .attribute-side-by{
            display: flex;
            justify-content: space-between;
        }

        /*
        *  STYLE 1
        */

        #style-1::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        #style-1::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }

        #style-1::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }

        .select2-container {
            width: 350px;
        }

        @media only screen and (max-width: 768px) {
            .select2-container {
                width: 205px;
            }
        }
        @media only screen and (max-width: 425px) {
            .select2-container {
                width: 350px;
            }
        }

        @media only screen and (max-width: 375px) {
            .select2-container {
                width: 305px;
            }
        }

        @media only screen and (max-width: 320px) {
            .select2-container {
                width: 250px;
            }
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

    @if($errors->has('name'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('name')}}</span>
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


    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Secondary Group</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                        <li class="breadcrumb-item active">Secondary Group</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_secondary_group"><i class="fa fa-plus"></i> Add Secondary Group</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('secondary-groups.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Secondary Group Table -->
                    <table id="secondary-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Primary Name</th>
                            <th>Secondary Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($secondary_groups as $secondary_group)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>{{ucwords(App\Models\PrimaryGroup::find($secondary_group->primary_group_id)->name)}}</td>
                                <td>{{ucwords(@$secondary_group->name)}}</td>
                                <td>{{$secondary_group->slug}}</td>
                                <td> @if ($secondary_group->status==1)
                                        <i class="fa fa-dot-circle-o text-success"></i> Active
                                    @else
                                        <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                    @endif
                                </td>
                                <td> {{ucwords(App\Models\User::find($secondary_group->created_by)->name)}}</td>
                                <td>@if(isset($secondary_group->updated_by))
                                        {{ucwords(App\Models\User::find($secondary_group->updated_by)->name)}}
                                    @else
                                        This is not Updated Yet.
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('secondary-groups.single',$secondary_group->id)}}"><i class="fa fa-eye m-r-5"></i> View</a>
                                            <a class="dropdown-item action-edit" href="#" id="{{$secondary_group->id}}" hrm-update-action="{{route('secondary-groups.update',$secondary_group->id)}}"  hrm-edit-action="{{route('secondary-groups.edit',$secondary_group->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            @if($secondary_group->slug != "candidate_document_fee" && $secondary_group->slug !="candidate_document_advance" && $secondary_group->slug !="overseas_commission_expenses" && $secondary_group->slug !="reference_commission_expenses" && $secondary_group->slug !="commission_receivable"  )
                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('secondary-groups.destroy',$secondary_group->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Secondary Group Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Secondary Group Modal -->
    @include('admin.modals.secondary_groups.add')
    <!-- /Add Secondary Group Modal -->

    <!-- Edit Secondary Group Modal -->
    @include('admin.modals.secondary_groups.edit')
    <!-- /Edit Secondary Group Modal -->

    <!-- Forbidden Secondary Group Modal -->
    @include('admin.modals.secondary_groups.forbidden')
    <!-- /Forbidden Secondary Group Modal -->

@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $( "select[name='primary_group_id']" ).select2({
                width: 'style',
            });
            $('#secondary-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });
        });

        $("#name").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            var regExp = /\s+/g;
            Text = Text.replace(regExp,'_');
            $("#slug").val(Text);
        });

        $(".updatename").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            var regExp = /\s+/g;
            Text = Text.replace(regExp,'_');
            $(".updateslug").val(Text);
        });

        $(document).on('change','#primary_group_add', function (e) {
            var id = $(this).children("option:selected").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('primary.attributes') }}",
                data: {'id':id},
                success: function(data) {
                    //    console.log(data);
                    if(data.attributes.length > 0) {
                        var attribute = '<div class="table-responsive m-t-15">' +
                            '<h4>Select Attributes</h4>' +
                            '<div class="scrollbar " id="style-1">';
                        $.each(data.attributes, function (index, value) {
                            attribute += '<div class="col-sm-12">' +
                                '<div class="form-group">' +
                                '<label class="col-form-label">' + value.name + '<span class="text-danger"></span></label>' +
                                '<input class="form-control" type="' + value.field_type + '" name="attr[' + value.id + ']" placeholder="' + value.name + '" id="' + value.id + '" />' +
                                '<input class="form-control" type="hidden" name="attrfieldtype[]" value="' + value.field_type + '" />' +
                                '<div class="invalid-feedback"> Please Enter ' +
                                value.name
                                +
                                '</div></div></div>'
                        });
                        attribute += '</div></div>';

                    }else{
                        attribute = '';
                    }
                    $('.primary-attributes').html(attribute);

                },
                error: function() {
                    swal({
                        title: 'Contra Voucher Warning',
                        text: "Error. Could not confirm the attributes of primary group",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
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
                        if(response == 0){
                            swal({
                                title: "Warning!",
                                text: "You need to Remove Assigned Primary Group & Attributes First",
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
                    // console.log(dataResult)
                    var slug = dataResult.editsecondarygroup.slug;

                    $("#edit_secondary_group").modal("toggle");

                    if(dataResult.editsecondarygroup.imported_from =="true" || slug == "candidate_document_fee" || slug == "candidate_document_advance" || slug == "overseas_commission_expenses" || slug == "reference_commission_expenses" || slug == "commission_receivable"){
                        $(".updatename").attr("readonly", "readonly");

                    }else{
                        $(".updatename").removeAttr("readonly", "readonly");

                    }
                    $('.updatename').attr('value',dataResult.editsecondarygroup.name);
                    $('.updateslug').attr('value',dataResult.editsecondarygroup.slug);
                    $('#select2-update_primary_id-container').text(dataResult.editsecondarygroup.primary_group.name);
                    $('input[name="status"]').filter('[value="'+dataResult.editsecondarygroup.status+'"]').prop('checked', true);
                    $('.updateselectprimary option[value="'+dataResult.editsecondarygroup.primary_group_id+'"]').prop('selected', true);
                    $('#hidden_primary_group_id').attr('value', dataResult.editsecondarygroup.primary_group_id);
                    $.each(dataResult.selected, function( index, valuen ) {
                        var att_value= valuen.id;
                        $('.updateattribute').each(function () {
                            if(this.value==att_value){
                                this.checked = "true"
                            }
                        });

                    });

                    // if(dataResult.editsecondarygroup.primary_group.attributes.length > 0) {

                    //     var attribute = '<div class="table-responsive m-t-15">' +
                    //         '<h4>Select Attributes</h4>' +
                    //         '<div class="scrollbar " id="style-1">';

                    //     $.each(dataResult.editsecondarygroup.primary_group.attributes, function (index, value) {
                    //         attribute += '<div class="col-sm-12">' +
                    //             '<div class="form-group">' +
                    //             '<label class="col-form-label">' + value.name + '<span class="text-danger"></span></label>' ;
                    //                     $.each(value.secondary_attributes, function (indexsec, valuesec) {

                    //                                 if(valuesec.secondary_group_id == dataResult.editsecondarygroup.id ) {

                    //                                             attribute +=   '<input class="form-control" type="hidden" name="secondary_attributes_id[]" value="'+valuesec.id+'">'+
                    //                                                         '<input class="form-control" type="' + value.field_type + '" name="attr[' + value.id + ']" value="' + valuesec.value + '" id="' + value.id + '" required/>' +
                    //                                                         '<input class="form-control" type="hidden" name="attrfieldtype[]" value="' + value.field_type + '" />' +
                    //                                                         '<div class="invalid-feedback"> Please Enter ' +
                    //                                                         value.name
                    //                                                         +
                    //                                                         '</div>';
                    //                                     }else{
                    //                                         attribute +=   '<input class="form-control" type="' + value.field_type + '" name="attr[' + value.id + ']" placeholder="' + value.name + '" id="' + value.id + '" required/>' +
                    //                                                         '<input class="form-control" type="hidden" name="attrfieldtype[]" value="' + value.field_type + '" />' +
                    //                                                         '<div class="invalid-feedback"> Please Enter ' +
                    //                                                         value.name
                    //                                                         +
                    //                                                         '</div>';
                    //                                     }
                    //                     });

                    //             attribute += '</div></div>'
                    //     });
                    //     attribute += '</div></div>';

                    // }else{
                    //     attribute = '';
                    // }

                    // $('.primary-attributes_edit').html(attribute);

                    var isset = function(variable){
                        return typeof(variable) !== "undefined" && variable !== null && variable !== '';
                    }

                    // console.log(dataResult.selected_attributes.length);

                    if(dataResult.selected_attributes.length > 0) {

                    var attribute = '<div class="table-responsive m-t-15">' +
                        '<h4>Select Attributes</h4>' +
                        '<div class="scrollbar " id="style-1">';
                    attribute += '<div class="col-sm-12">' +
                        '<div class="form-group">' ;




                    $.each(dataResult.selected_attributes, function (index, value) {

                        attribute +=
                            '<label class="col-form-label">' + value.name + '<span class="text-danger"></span></label>';
                        if($.inArray(value.id, dataResult.selected_attribute_id) !== -1){
                            $.each(value.secondary_attributes, function (index, valueed) {
                                if (dataResult.secondarygroup_id == valueed.secondary_group_id) {

                                    attribute += '<input class="form-control" type="' + valueed.type + '" name="attr[' + valueed.id + ']" value="' + valueed.value + '" id="" required/>'+
                                    '<input class="form-control" type="hidden" name="attrfieldtype[]" value="' + valueed.type + '" />' +
                                    '<input class="form-control" type="hidden" name="secondary_attributes_id[]" value="'+ valueed.id +'" id="'+ valueed.id +'">';
                                }
                            });
                        }else{
                            attribute += '<input class="form-control" type="' + value.type + '" name="attr[' + value.id + ']" placeholder="'+ value.name +'" id="" required/>' +
                                '<input class="form-control" type="hidden" name="attrfieldtype[]" value="' + value.field_type + '" />';
                        }
                        attribute +=
                        '<div class="invalid-feedback"> Please Enter ' +
                        value.name
                        +
                        '</div>';
                    });

                    attribute += '</div></div></div></div>';
                    }else{
                        if(dataResult.selected_attributes.length > 0) {
                            var attribute = '<div class="table-responsive m-t-15">' +
                                '<h4>Select Attributes</h4>' +
                                '<div class="scrollbar " id="style-1">';
                            attribute += '<div class="col-sm-12">' +
                                '<div class="form-group">' ;
                            $.each(dataResult.selected_attributes, function (index, value) {
                                attribute +=
                                    '<label class="col-form-label">' + value.name + '<span class="text-danger"></span></label>' +
                                    '<input class="form-control" type="' + value.field_type + '" name="attr[' + value.id + ']" placeholder="' + value.name + '" id="' + value.id + '" required/>' +
                                    '<input class="form-control" type="hidden" name="attrfieldtype[]" value="' + value.field_type + '" />' +
                                    '<div class="invalid-feedback"> Please Enter ' +
                                    value.name
                                    +
                                    '</div>';

                            });
                            attribute += '</div></div></div></div>';
                            // var attribute = '';
                        }

                    }






                    // if(dataResult.editsecondarygroup.secondary_attributes.length > 0) {

                    //     var attribute = '<div class="table-responsive m-t-15">' +
                    //         '<h4>Select Attributes</h4>' +
                    //         '<div class="scrollbar " id="style-1">';
                    //     attribute += '<div class="col-sm-12">' +
                    //         '<div class="form-group">' ;
                    //     $.each(dataResult.editsecondarygroup.primary_group.attributes, function (index, value) {
                    //         $.each(dataResult.editsecondarygroup.secondary_attributes, function (sec_index, sec_value) {

                    //         try {
                    //                 if(isset(sec_value.value) ) {
                    //                     if(value.id == sec_value.attribute_id){
                    //                         attribute +=
                    //                             '<label class="col-form-label">' + value.name + '<span class="text-danger"></span></label>' +
                    //                             '<input class="form-control" type="' + value.field_type + '" name="attr[' + value.id + ']" value="' + sec_value.value + '" id="' + value.id + '" required/>' +
                    //                             '<input class="form-control" type="hidden" name="attrfieldtype[]" value="' + value.field_type + '" />' +
                    //                             '<input class="form-control" type="hidden" name="secondary_attributes_id[]" value="'+sec_value.id + '" id="' + sec_value.id+'">'+
                    //                             '<div class="invalid-feedback"> Please Enter ' +
                    //                             value.name
                    //                             +
                    //                             '</div>';
                    //                     }
                    //                 }

                    //         } catch (e) {
                    //             attribute +=
                    //                 '<label class="col-form-label">' + value.name + '<span class="text-danger"></span></label>' +
                    //                 '<input class="form-control" type="' + value.field_type + '" name="attr[' + value.id + ']" placeholder="' + value.name + '" id="' + value.id + '" required/>' +
                    //                 '<input class="form-control" type="hidden" name="attrfieldtype[]" value="' + value.field_type + '" />' +
                    //                 '<div class="invalid-feedback"> Please Enter ' +
                    //                 value.name
                    //                 +
                    //                 '</div>';
                    //         }
                    //     });


                    //     });

                    //     attribute += '</div></div></div></div>';
                    // }else{
                    //     var attribute = '<div class="table-responsive m-t-15">' +
                    //         '<h4>Select Attributes</h4>' +
                    //         '<div class="scrollbar " id="style-1">';
                    //     attribute += '<div class="col-sm-12">' +
                    //         '<div class="form-group">' ;
                    //     $.each(dataResult.editsecondarygroup.primary_group.attributes, function (index, value) {
                    //         attribute +=
                    //             '<label class="col-form-label">' + value.name + '<span class="text-danger"></span></label>' +
                    //             '<input class="form-control" type="' + value.field_type + '" name="attr[' + value.id + ']" placeholder="' + value.name + '" id="' + value.id + '" required/>' +
                    //             '<input class="form-control" type="hidden" name="attrfieldtype[]" value="' + value.field_type + '" />' +
                    //             '<div class="invalid-feedback"> Please Enter ' +
                    //             value.name
                    //             +
                    //             '</div>';

                    //     });
                    //     attribute += '</div></div></div></div>';
                    //     // var attribute = '';

                    // }


                    $('.primary-attributes_edit').html(attribute);


                    $('.updatesecondarygroup').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });
    </script>
@endsection
