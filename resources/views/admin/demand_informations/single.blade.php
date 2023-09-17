@extends('layouts.master')
@section('title') Single Demand Information @endsection
@section('css')
<style>

 div#demand-single-data-card {
        border: none;
        border-radius: unset;
        background-clip: unset;

    }

 .thumbnail-order{
     position: relative;
     z-index: 0;
 }

 .thumbnail-order:hover{
     background-color: transparent;
     z-index: 50;
 }

 .thumbnail-order span{ /*CSS for enlarged image*/
     position: absolute;
     background-color: #d3d3d37a;
     padding: 5px;
     left: -1000px;
     box-shadow: 1px 1px 3px rgba(0,0,0,.45);
     visibility: hidden;
     display: none;
     color: black;
     text-decoration: none;
 }

 .thumbnail-order span img{ /*CSS for enlarged image*/
     border-width: 0;
     padding: 2px;
 }

 .thumbnail-order:hover span{ /*CSS for enlarged image on hover*/
     visibility: visible;
     display: block;
     top: -1152%;
     left: -269px; /*position where enlarged image should offset horizontally */
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
                    <h3 class="page-title">Demand Information</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('demand-info.index')}}"> Demand Information</a></li>
                        <li class="breadcrumb-item active">Single Demand Information</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <div class="btn-group btn-group-sm">
                    <button class="btn btn-white" id="generate-pdf">PDF</button>
            <button class="btn btn-white" onclick="printerDiv('demand-single-data')"><i class="fa fa-print fa-lg"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row" id="demand-single-data">
            <div class="col-md-12">
            <div class="card" id="demand-single-data-card">
                    <div class="card-body">
                        <div class="text-center">
    {{--                    <img src="<?php if(!empty($demand->image)){ echo '/images/demandinfo/'.$demand->image; } else { echo '/images/profiles/others.png'; }  ?>" class="inv-logo" alt="">--}}
                        </div>
                        <div class="row">
                            <div class="col-sm-6 m-b-20">
                                <h3 class="text-uppercase">Ref No. <span class="demandno">{{@$demand->ref_no}}</span> </h3>
                                    <ul class="list-unstyled">
                                    <li>{{ucwords(@$demand->company_name)}}</li>
                                    <li>
                                    {{ucwords($demand->countryState->country ?? '')}}  {{ucwords($demand->countryState ? ','.$demand->countryState->state: '')}}

                                    </li>
                                    <li>{{ucwords(@$demand->address ?? '')}}</li>
                                    <li>{{@$demand->telephone ?? ''}}</li>
                                    <li>{{@$demand->fax_no?? ''}}</li>
                                </ul>
                            </div>
                            <div class="col-sm-6 m-b-20">
                                <div class="invoice-details">
                                    <h3 class="text-uppercase clientnumber">Client No. {{@$demand->serial_no ?? ''}}</h3>
                                    <ul class="list-unstyled">
                                        <li>Email: <span>{{@$demand->email ?? ''}}</span></li>
                                        <li>Website: <span>{{@$demand->website ?? ''}}</span></li>
                                        <li>Category: <span>{{ucwords(@$demand->category ?? '')}}</span></li>
                                        <li>Advertised: <span>{{ucwords(@$demand->advertised ?? '')}}</span></li>
                                        <li>Status: <span>{{ucwords(@$demand->status ?? '')}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="table-responsive no-border">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <th>Overseas Agent:</th>
                                            <td class="text-right">{{ $demand->overseas_agent_id ? ucwords(App\Models\OverseasAgent::find($demand->overseas_agent_id)->fullname):''}}</td>
                                        </tr>
                                        <tr>
                                            <th>Fulfill Date:</th>
                                            <td class="text-right">{{ $demand->fulfill_date ? \Carbon\Carbon::parse($demand->fulfill_date)->isoFormat('MMMM Do, YYYY'):""}}</td>
                                        </tr>
                                        <tr>
                                            <th>Issued Date: </th>
                                            <td class="text-right">{{$demand->issued_date ? \Carbon\Carbon::parse($demand->issued_date)->isoFormat('MMMM Do, YYYY'):''}}</td>
                                        </tr>
                                        <tr>
                                            <th>Expired Date:</th>
                                            <td class="text-right"><h5>{{$demand->expired_date ? \Carbon\Carbon::parse($demand->expired_date)->isoFormat('MMMM Do, YYYY'):''}}</h5></td>
                                        </tr>

                                        <tr>
                                            <th>Document Status:</th>
                                            <td class="text-right"><h5>{{@$demand->doc_status ?? ''}}</h5></td>
                                        </tr>

                                        <tr>
                                            <th>Number of PAX:</th>
                                            <td class="text-right"><h5>{{@$demand->num_of_pax ?? ''}}</h5></td>
                                        </tr>

                                        <tr>
                                            <th>Document received date:</th>
                                            <td class="text-right"><h5>{{@$demand->doc_received_date ?? ''}}</h5></td>
                                        </tr>

                                        <tr>
                                            <th>Document status remarks:</th>
                                            <td class="text-right"><h5>{{@$demand->doc_status_remarks ?? ''}}</h5></td>
                                        </tr>
                                        <tr>
                                            <th>Image:</th>
                                            <td class="text-right">
                                                <a class="thumbnail-order" href="#thumb">
                                                    <img src="<?php if(!empty($demand->image)){ echo '/images/demandinfo/'.$demand->image; } else { echo '/images/profiles/others.png'; }  ?>" style="width:8rem;" alt="{{$demand->ref_no ?? ''}}">
                                                    <span>
                                                         <img src="<?php if(!empty($demand->image)){ echo '/images/demandinfo/'.$demand->image; } else { echo '/images/profiles/others.png'; }  ?>" style="height:15rem;" alt="{{$demand->ref_no ?? ''}}">
                                                    </span>
                                                </a>
{{--                                                <img src="<?php if(!empty($demand->image)){ echo '/images/demandinfo/'.$demand->image; } else { echo '/images/profiles/others.png'; }  ?>" class="inv-logo" alt="">--}}
                                            </td>
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


var cache_width = $('#demand-single-data-card').width();
    var a4 = [595.28, 841.89];

    $(document).on("click", '#generate-pdf', function () {
        // $("#ledger-single-data-card").width((a4[0] * 1.33333)).css('max-width', 'none');
        var text = $('.demandno').text();
        // console.log(text.trim());
        var name = text.trim();
        // console.log(name);
        // Aqui ele cria a imagem e cria o pdf
        html2canvas($('#demand-single-data-card'), {
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
                doc.save(name+'-demand-information.pdf');
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
