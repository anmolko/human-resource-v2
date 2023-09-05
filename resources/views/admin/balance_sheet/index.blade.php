@extends('layouts.account_master')
@section('title') Balance Sheet @endsection
@section('css')
<style>
  .report-groups{
        margin-top:20px;
        margin-bottom:10px;
    }

    .inner-secondary{
        font-size:small;
    }

    section.heading-profit-loss {
        margin-bottom: 10px;
    }

    .col-sm-6.right-balance-sheet {
        padding-left: 0px;
    }

    .col-sm-6.left-balance-sheet {
        padding-right: 0px;
    }

    .balance-sheet-hidden{
        visibility: hidden;
    }
    .balance-sheet-table-row{
        opacity: 0;
    }

    div#balance-sheet-single-data-card {
        border: none;
        border-radius: unset;
        background-clip: unset;

    }

    tr.balance-sheet-hidden > td {
        border: 1px solid #ffffff;
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
                    <h3 class="page-title">Balance Sheet</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                        <li class="breadcrumb-item active">Balance Sheet</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <form id="balance-sheet-form">
        @csrf

            <div class="row filter-row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating" id="datetimepickerfrom" name="date_from" type="text">
                        </div>
                        <label class="focus-label">From</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating" id="datetimepickerto" name="date_to" type="text">
                        </div>
                        <label class="focus-label">To</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <button type="submit" id="btn-search" class="btn btn-success btn-block"> Search </button>
                </div>
            </div>
        </form>
        <!-- /Search Filter -->

        <section  id="balance_sheet_data">


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
                        disableBefore: from,
                        disableAfter: to,
                        ndpYearCount: 10,
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
        });


        $(document).on("click", '#btn-search', function(event){
            event.preventDefault();

            var datastring = $("#balance-sheet-form").serialize();
            var from = $("input[name=date_from]").val();
            var to = $("input[name=date_to]").val();
                if(from==""){
                    swal({
                        title: 'Balance Sheet Warning',
                        text: "Please choose start date",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }else if(to==""){
                    swal({
                        title: 'Balance Sheet Warning',
                        text: "Please choose end date",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }else{
                    $.ajax({
                        type: "POST",
                        url: "{{ route('balancesheet.detail') }}",
                        data: datastring,
                        success: function(data) {
                            $('#balance_sheet_data').html(data);

                            var values = $("input[name='primary[]']").map(function()
                            {
                                return $(this).val();
                            }).get();
                            // var left = $('#left_value').val();
                            // var right = $('#right_value').val();
                            
                            // var count;
                            // var count_second;
                            // if(left > right){
                            //     count = left - right;
                            //     for(var i =0 ; i < count; i++){
                            //         $('#right-section-investment').append('<tr class="balance-sheet-hidden"><td><strong>Other Allowance</strong> <span class="float-right">$44</span></td></tr>');
                            //     }
                            // }else{
                            //     count = right - left;
                            //     for(var i =0 ; i < count; i++){
                            //         $('#left-section-current-liabilities').append('<tr class="balance-sheet-hidden"><td><strong>Other Allowance</strong> <span class="float-right">$44</span></td></tr>');
                            //     }
                            // }


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



        function printerDiv(divID) {
            var cssname      = "/backend/assets/css/<?php if(@$theme_data->color){?>{{@$theme_data->color}}<?php }else{ echo "light_grey"; }?>.css";
            var bootstrap    = '<link rel="stylesheet" href="backend/assets/css/bootstrap.min.css" type="text/css">';
            var fontawesome  = '<link rel="stylesheet" href="backend/assets/css/font-awesome.min.css" type="text/css">';
            var colorname    = '<link rel="stylesheet" href="'+cssname+'" type="text/css">';
            var stylename    = '<link rel="stylesheet" href="backend/assets/css/style.css" type="text/css">';
            var from         = document.getElementById("datetimepickerfrom").value;
            var to           = document.getElementById("datetimepickerto").value;

            var getpanel = document.getElementById(divID);
            var MainWindow = window.open('', '', 'height=1000,width=1000');
            MainWindow.document.write('<html><head><title> Balance Sheet data form '+ from +' / ' + to +' </title>');
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


    var cache_width = $('#balance-sheet-single-data-card').width();
    var a4 = [595.28, 841.89];

    $(document).on("click", '#generate-pdf', function () {
        // $("#balance-sheet-single-data-card").width((a4[0] * 1.33333)).css('max-width', 'none');
        var from_text = $('#balance_from').val();
        var to_text = $('#balance_to').val();
        // console.log(text.trim());
        var from = from_text.trim();
        var to = to_text.trim();
        // console.log(name);
        // Aqui ele cria a imagem e cria o pdf
        html2canvas($('#balance-sheet-single-data-card'), {
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
                doc.save(from+' to '+to+' balance-sheet.pdf');
                //return div to CSS normal
                // $('#balance-sheet-single-data-card').width('auto');
            }
        });
    });



</script>
@endsection