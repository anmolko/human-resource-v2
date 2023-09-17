<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $( ".select2" ).select2({
            width:'100%'
        });
    });


    $("#name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'_');
        $("#key").val(Text);
    });

    $(".updatename").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'_');
        $(".updatekey").val(Text);
    });

    // $(".action-delete").click(function(){
    //     var action = $(this).attr('hrm-delete-action');
    //     $('.deletemodule').attr('action',action);

    // })

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
            $.post( $url, form_data,function(response) {
                if(response == 0){
                    swal({
                        title: "Warning!",
                        text: "You need to Remove Assigned Roles and Permissions First",
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
            });
        })
    })




    $(document).on('click','.action-view', function (e) {
        e.preventDefault();
        // console.log(action)
        var id=$(this).attr('id');
        $.ajax({
            url: $(this).attr('hrm-view-action'),
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                if(dataResult==null || dataResult ==0){
                    var trHTML = "";

                    trHTML = '<p class="role-not-found"> Role is not assigned yet !</p>';
                    $("#view-role-module").html(trHTML);

                }else{
                    var trHTML = "";

                    $.each(dataResult, function( index, value ) {
                        trHTML +='<button type="button" class="btn btn-info btn-sm">'
                            + value
                            + '</button>'

                    });
                    $("#view-role-module").html(trHTML);

                }

            }
        });
    });

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
                $('#parent_module_id').val(dataResult.parent_module_id).trigger('change');
                $('.updatename').attr('value',dataResult.name);
                $('.updatekey').attr('value',dataResult.key);
                $('.updateurl').attr('value',dataResult.url);
                $('#rank').attr('value',dataResult.rank);
                $('#icon').attr('value',dataResult.icon);
                $('.updatemodule option[value="'+dataResult.status ?? 1+'"]').prop('selected', true);
                $('.updatemodule').attr('action',action);
            }
        });
    });

</script>
