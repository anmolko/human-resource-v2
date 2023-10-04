//handle form requests via ajax
$(document).ready(function() {
    loadEditor();
    loadNormalDatatable();
});

function loadNormalDatatable(){
    let selector =  $('#NormalDataTable');
    if(selector.length > 0){
        dataTable = $(selector).DataTable({
            paging: true,
            searching: true,
            ordering:  true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        });
    }
}

$("form.submit_form").on('submit', function (e){
   e.preventDefault();

   let button = $(this).find("[type=submit]");

   button.prop('disabled', true);

   if (typeof CKEDITOR !== "undefined"){
       for (instance in CKEDITOR.instances){
           CKEDITOR.instances[instance].updateElement();
       }
   }

    let selector =  $('.ck-editor');
    if(selector.length > 0){
        $(selector).each(function () {
            var editor_data = CKEDITOR.instances[$(this).prop('id')].getData();
            $('#'+$(this).prop('id')).text(editor_data);
        });
    }

   let route = $(this).attr('action');
   let method = $(this).attr('method');
   let data = new FormData(this);

   $.ajax({
       url:route,
       data:data,
       method:method,
       dataType:"JSON",
       cache:false,
       contentType:false,
       processData: false,
       success: function (url){
           window.location.href = url;
       },
       error: function (error){
           button.prop("disabled", false);
           $('span.text-danger').remove();
           if(error.responseJSON.errors){
               $.each(error.responseJSON.errors, function (index, error){
                   let html = document.createElement('span');
                   html.className = index + ' text-danger';
                   html.innerText = error[0];
                   if($("[name='"+index+"[]']").length){
                       $("[name='"+index+"[]']").after(html);
                   }else if($("[name='"+index.split('.')[0]+"[]']").length){
                       $("[name='"+index.split('.')[0]+"[]']")[index.split('.')[1]].after(html);
                   }else if($("[name='"+index.split('.')[0]+"["+ index.split('.')[1] +"]']").length){
                       $("[name='"+index.split('.')[0]+"["+ index.split('.')[1] +"]']").after(html);
                   }else if($("[name='"+index.split('.')[0]+"["+ index.split('.')[1] +"][]']").length){
                       $("[name='"+index.split('.')[0]+"["+ index.split('.')[1] +"][]']")[index.split('.')[2]].after(html);
                   }else{
                       $("[name='"+index+"']:first").after(html);
                   }
               })
           }
       }
   })
});
