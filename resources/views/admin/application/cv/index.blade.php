@extends('layouts.master')
@section('title') Generate Candidate CV @endsection
@section('css')
<style>

    .report-groups{
        margin-top:20px;
        margin-bottom:10px;
    }

    div#ledger-single-data-card {
        border: none;
        border-radius: unset;
        background-clip: unset;

    }


    span.select2-container{
        width: 290px !important;
    }
    @page { size: auto;  margin: 0mm; }
</style>
@endsection
@section('content')
<!-- Page Content -->
<div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Generate Candidate CV</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('account')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Generate CV</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <form id="generate-form">
        @csrf

            <div class="row filter-row">

                <div class="col-sm-6 col-md-4">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" name="candidate" id="candidate">
                            <option value="select" disabled selected> Select Candidate</option>
                            @foreach($candidate_personals as $candidate_personal)
                                <option value="{{$candidate_personal->id}}">{{ucwords($candidate_personal->candidate_firstname)}} {{ucwords($candidate_personal->candidate_middlename)}} {{ucwords($candidate_personal->candidate_lastname)}}  </option>
                            @endforeach
                        </select>
                        <label class="focus-label">Candidate List</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" name="template" id="template">
                            <option value="select" disabled selected> Select Template</option>
                                <option value="one">One</option>
                                <option value="two">Two</option>
                                <option value="three">Three</option>
                                <option value="four">Four</option>
                                <option value="five">Five</option>
                                <option value="six">Six</option>
                                <option value="seven">Seven</option>
                                <option value="eight">Eight</option>
                                <option value="nine">Nine</option>
                                <option value="ten">Ten</option>
                        </select>
                        <label class="focus-label">CV Templates</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" id="btn-search" class="btn btn-success btn-block"> Search </button>
                </div>
            </div>
        </form>
        <!-- /Search Filter -->

        <div  id="general_data_cv">

</div>



</div>
<!-- /Page Content -->
@endsection


@section('js')



<script type="text/javascript">

var accountname;


$(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $( "#candidate" ).select2();
        $( "#template" ).select2();

});
     $(document).on("click", '#btn-search', function(event){
            event.preventDefault();

            var datastring = $("#generate-form").serialize();
            var candidate = $('#candidate').find(":selected").val();
            var template = $('#template').find(":selected").val();

                if(candidate=='select'){
                    swal({
                        title: 'Generate CV Warning',
                        text: "Please Choose Candidate",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }else if(template=='select'){
                    swal({
                        title: 'Generate CV Warning',
                        text: "Please Choose Template",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
                else{
                        $.ajax({
                        type: "POST",
                        url: "{{ route('generate_cv') }}",
                        data: datastring,
                        success: function(data) {
                            $('#general_data_cv').html(data);
                            $('#all-ledger').DataTable({
                            ordering:  true,
                            paging:   false,
                            searching: false,
                            info:     false,

                        });
                        },
                        error: function() {
                                    // toastr.warning("Data Not Found");
                        }
                        });
                    }

        });

    function capitalizeFirstLetter(string){
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    var cache_width = $('#pdf-container').width();
    var a4 = [595.28, 841.89];

    $(document).on("click", '#generate-pdf', function () {
        // $("#ledger-single-data-card").width((a4[0] * 1.33333)).css('max-width', 'none');
        var text = $('.cv-name').text();
        // console.log(text.trim());
        var name = text.trim();
        // console.log(name);
        // Aqui ele cria a imagem e cria o pdf
        html2canvas($('#pdf-container'), {
            onrendered: function (canvas) {
                var imgData = canvas.toDataURL('image/png');
                var imgWidth = 210;
                var pageHeight = 295;
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;
                var doc = new jsPDF('p', 'mm');
                var position = 0; // give some top padding to first page

                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                position += 2 + heightLeft - imgHeight; // top padding for other pages
                doc.addPage();
                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
                }
                // var img = canvas.toDataURL("image/jpeg", 1.0);
                // // var doc = new jsPDF(); // default is portrait
                // var doc = new jsPDF("p", "mm", "a4"); // default is portrait
                // var pageWidth = doc.internal.pageSize.getWidth();
                // var pageHeight = doc.internal.pageSize.getHeight();
                // var imageWidth = canvas.width;
                // var imageHeight = canvas.height;

                // // doc.addImage(img, 'JPEG', 0, 0);
                // var ratio = imageWidth/imageHeight >= pageWidth/pageHeight ? pageWidth/imageWidth : pageHeight/imageHeight;
                // doc.addImage(img, 'JPEG', 0, 0, imageWidth * ratio, imageHeight * ratio);
                doc.save(capitalizeFirstLetter(name)+'-CV.pdf');
                //return div to CSS normal
                // $('#ledger-single-data-card').width('auto');
            }
        });
    });

    // function printerDiv(divID) {
    //     var divElements = document.getElementById(divID).innerHTML;
    //     var oldPage = document.body.innerHTML;
    //     document.body.innerHTML =
    //         "<html><head><title></title></head><body>" +
    //         divElements + "</body>";
    //     //Print Page
    //     window.print();
    //     //Restore orignal HTML
    //     document.body.innerHTML = oldPage;
    //
    // }

    function printerDiv(divID) {
        var template         = document.getElementById("template");
        var strtemplate = template.options[template.selectedIndex].text;

        var cssname      = "/backend/assets/"+strtemplate+".css";

        // if(strtemplate=='three'){
        // }

        var fontawesome  = '<link rel="stylesheet" href="/backend/assets/css/font-awesome.min.css" type="text/css">';

        var stylename    = '<link rel="stylesheet" href="'+cssname+'" type="text/css">';

        // var stylename    = '<link rel="stylesheet" href="backend/assets/css/style.css" type="text/css">';
        var candidate         = document.getElementById("candidate");
        var template         = document.getElementById("template");

        var strUser = candidate.options[candidate.selectedIndex].text;

        var getpanel = document.getElementById(divID);
        var MainWindow = window.open('', '', 'height=1000,width=1000');
        MainWindow.document.write('<html><head><title>'+ strUser +' CV'+'</title>');

        MainWindow.document.write(fontawesome);

        MainWindow.document.write(stylename);

        // MainWindow.document.write(colorname);
        MainWindow.document.write('</head><body onload="window.print();window.close()">');
        MainWindow.document.write(getpanel.innerHTML);
        MainWindow.document.write('</body></html>');
        // MainWindow.document.close();
        setTimeout(function () {
            MainWindow.print();
        }, 500)
        return false;
    }



    // $('#print-button').on('click',function(){


    //        var stylename    = '<link rel="stylesheet" href="/backend/assets/four.css" type="text/css">';

    //        var getpanel = document.getElementById('drag');
    //        var MainWindow = window.open('', '', 'height=1000,width=1000');
    //        MainWindow.document.write('<html><head><title>CV </title>');
    //        MainWindow.document.write(stylename);
    //        MainWindow.document.write('</head><body onload="window.print();window.close()">');
    //        MainWindow.document.write(getpanel.innerHTML);
    //        MainWindow.document.write('</body></html>');
    //        MainWindow.document.close();
    //        setTimeout(function () {
    //            MainWindow.print();
    //        }, 500)
    //        return true;
    //    })

</script>
@endsection

