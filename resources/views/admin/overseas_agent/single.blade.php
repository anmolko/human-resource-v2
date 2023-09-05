@extends('layouts.entry_master')
@section('title') Single Overseas Agent @endsection
@section('css')
<style>

 div#overseas-single-data-card {
        border: none;
        border-radius: unset;
        background-clip: unset;

    }
    </style>
@endsection
@section('content')

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Overseas Agent</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('overseas-agent.index')}}">Overseas Agent</a></li>
                        <li class="breadcrumb-item active">Single Overseas Agent</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <div class="btn-group btn-group-sm">
                    <button class="btn btn-white" id="generate-pdf">PDF</button>
            <button class="btn btn-white" onclick="printerDiv('overseas-single-data')"><i class="fa fa-print fa-lg"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row" id="overseas-single-data">
            <div class="col-md-12">
            <div class="card" id="overseas-single-data-card">
                    <div class="card-body">
                    <div class="text-center">
                    <img src="<?php if(!empty($agent->image)){ echo '/images/agent/'.$agent->image; } else { echo '/images/profiles/others.png'; }  ?>" class="inv-logo" alt="">
                    </div>
                        <div class="row">
                            <div class="col-sm-6 m-b-20">

                                    <ul class="list-unstyled">
                                    <li>{{ucwords(@$agent->company_name)}}</li>
                                    <li>
                                        {{ucwords($agent->countryState->country)}} , {{ucwords($agent->countryState->state)}}
                                    </li>
                                    <li>{{ucwords(@$agent->company_address)}},</li>
                                    <li>{{@$agent->company_contact_num}}</li>
                                    <li>{{@$agent->fax_num}}</li>
                                </ul>
                            </div>
                            <div class="col-sm-6 m-b-20">
                                <div class="invoice-details">
                                    <h3 class="text-uppercase clientnumber">Client No. {{@$agent->client_no}}</h3>
                                    <ul class="list-unstyled">
                                        <li>Email: <span>{{@$agent->company_email}}</span></li>
                                        <li>Website: <span>{{@$agent->website}}</span></li>
                                        <li>Type of Company: <span>{{ucwords(@$agent->type_of_company)}}</span></li>
                                        <li>Postal Address: <span>{{ucwords(@$agent->postal_address)}}</span></li>
                                        <li>Status: <span>{{ucwords(@$agent->status)}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="table-responsive no-border">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <th>Fullname:</th>
                                            <td class="text-right">{{ucwords(@$agent->fullname)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Designation: </th>
                                            <td class="text-right">{{ucwords(@$agent->designation)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Personal Email:</th>
                                            <td class="text-right"><h5>{{@$agent->personal_email}}</h5></td>
                                        </tr>

                                        <tr>
                                            <th>Personal Mobile:</th>
                                            <td class="text-right"><h5>{{@$agent->personal_mobile}}</h5></td>
                                        </tr>

                                        <tr>
                                            <th>Contact Number:</th>
                                            <td class="text-right"><h5>{{@$agent->personal_contact_num}}</h5></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

@endsection
@section('js')


<script type="text/javascript">


var cache_width = $('#overseas-single-data-card').width();
    var a4 = [595.28, 841.89];

    $(document).on("click", '#generate-pdf', function () {
        // $("#ledger-single-data-card").width((a4[0] * 1.33333)).css('max-width', 'none');
        var text = $('.clientnumber').text();
        // console.log(text.trim());
        var name = text.trim();
        // console.log(name);
        // Aqui ele cria a imagem e cria o pdf
        html2canvas($('#overseas-single-data-card'), {
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
                doc.save(name+'-Overseas-Agent.pdf');
                //return div to CSS normal
                // $('#ledger-single-data-card').width('auto');
            }
        });
    });

function printerDiv(divID) {
        var divElements = document.getElementById(divID).innerHTML;
        var oldPage = document.body.innerHTML;
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
            divElements + "</body>";
        //Print Page
        window.print();
        //Restore orignal HTML
        document.body.innerHTML = oldPage;

    }
</script>

@endsection
