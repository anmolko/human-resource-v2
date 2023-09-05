@extends('layouts.account_master')
@section('title') Ledger Account @endsection
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

    tr > th.sorting_asc::after, tr > th.sorting_desc::after { content:"" !important; }
    tr > th.sorting::after, tr > th.sorting::after { content:"" !important; }
    tr > th.sorting_asc::before, tr > th.sorting_desc::before { content:"" !important; }
    tr > th.sorting::before, tr > th.sorting::before { content:"" !important; }

    .closing-balance-container{
        visibility: collapse;
    }

    span.select2-container{
        width: 245px !important;
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
                    <h3 class="page-title">Legder Accounts</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                        <li class="breadcrumb-item active">Ledger</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <form id="ledger-form">
        @csrf

            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating" id="datetimepickerfrom" name="date_from" type="text">
                        </div>
                        <label class="focus-label">From</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating" id="datetimepickerto" name="date_to" type="text">
                        </div>
                        <label class="focus-label">To</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" name="account" id="account">
                            <option value="select" disabled selected> Select Accounts</option>
                            @foreach($secondaryvalue as $value)
                                <option value="{{$value->id}}">{{ucwords($value->name)}} </option>
                            @endforeach
                        </select>
                        <label class="focus-label">Accounts</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" id="btn-search" class="btn btn-success btn-block"> Search </button>
                </div>
            </div>
        </form>
        <!-- /Search Filter -->

        <section  id="ledger_data">

        </section>



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

        var from = "<?php echo $company_data->from ?>";
        var to = "<?php echo $company_data->to ?>";
        <?php if(@$theme_data->default_date_format=='nepali'){ ?>

            $('#datetimepickerfrom').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                disableBefore: from,
                disableAfter: to,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            })


            $('#datetimepickerto').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                disableBefore: from,
                disableAfter: to,
                dateFormat :'YYYY-MM-DD',
                language: "english"
            })

       <?php }else if(@$theme_data->default_date_format=='english'){ ?>

            $('#datetimepickerfrom').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: from,
                maxDate: to
            })

            $('#datetimepickerto').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: from,
                maxDate: to
            })


        <?php }else{?>
            $('#datetimepickerfrom').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: from,
            maxDate: to
         })

         $('#datetimepickerto').datetimepicker({
            format: 'YYYY-MM-DD',
             minDate: from,
             maxDate: to
         })
        <?php }?>

        $( "#account" ).select2();

});
     $(document).on("click", '#btn-search', function(event){
            event.preventDefault();

            var datastring = $("#ledger-form").serialize();
            var account = $('#account').find(":selected").val();
            var from = $("input[name=date_from]").val();
            var to = $("input[name=date_to]").val();
                if(from==""){
                    swal({
                        title: 'Ledger Warning',
                        text: "Please choose start date",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }else if(to==""){
                    swal({
                        title: 'Ledger Warning',
                        text: "Please choose end date",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }else if(account=='select'){
                    swal({
                        title: 'Ledger Warning',
                        text: "Please Choose Account",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }else{
                        $.ajax({
                        type: "POST",
                        url: "{{ route('ledger.detail') }}",
                        data: datastring,
                        success: function(data) {
                            $('#ledger_data').html(data);
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

    var cache_width = $('#ledger-single-data-card').width();
    var a4 = [595.28, 841.89];

    $(document).on("click", '#generate-pdf', function () {
        // $("#ledger-single-data-card").width((a4[0] * 1.33333)).css('max-width', 'none');
        var text = $('.accountname').text();
        // console.log(text.trim());
        var name = text.trim();
        // console.log(name);
        // Aqui ele cria a imagem e cria o pdf
        html2canvas($('#ledger-single-data-card'), {
            onrendered: function (canvas) {
                var imgData = canvas.toDataURL('image/png');
                var imgWidth = 210;
                var pageHeight = 295;
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;
                var doc = new jsPDF('p', 'mm');
                var position = 5; // give some top padding to first page

                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                position += heightLeft - imgHeight; // top padding for other pages
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
                doc.save(capitalizeFirstLetter(name)+'-Legder-Details.pdf');
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
        var cssname      = "/backend/assets/css/<?php if(@$theme_data->color){?>{{@$theme_data->color}}<?php }else{ echo "light_grey"; }?>.css";
        var bootstrap    = '<link rel="stylesheet" href="backend/assets/css/bootstrap.min.css" type="text/css">';
        var fontawesome  = '<link rel="stylesheet" href="backend/assets/css/font-awesome.min.css" type="text/css">';
        var colorname    = '<link rel="stylesheet" href="'+cssname+'" type="text/css">';
        var stylename    = '<link rel="stylesheet" href="backend/assets/css/style.css" type="text/css">';
        var name         = document.getElementById("account");
        var from         = document.getElementById("datetimepickerfrom").value;
        var to           = document.getElementById("datetimepickerto").value;
        var strUser = name.options[name.selectedIndex].text;

        var getpanel = document.getElementById(divID);
        var MainWindow = window.open('', '', 'height=1000,width=1000');
        MainWindow.document.write('<html><head><title>'+ strUser +' ledger account form '+ from +' / ' + to +' </title>');
        MainWindow.document.write(bootstrap);
        MainWindow.document.write(fontawesome);
        MainWindow.document.write(stylename);
        MainWindow.document.write(colorname);
        MainWindow.document.write('</head><body onload="window.print();window.close()">');
        MainWindow.document.write(getpanel.innerHTML);
        MainWindow.document.write('</body></html>');
        MainWindow.document.close();
        setTimeout(function () {
            MainWindow.print();
        }, 500)
        return false;
    }



</script>
@endsection

