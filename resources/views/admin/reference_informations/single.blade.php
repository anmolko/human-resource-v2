@extends('layouts.master')
@section('title') Single Reference Information @endsection
@section('css')
<style>

 div#reference-single-data-card {
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

 .table > thead > tr:first-child > td, .table > tbody > tr:first-child > td, .table > tbody > tr:first-child > th {
    border: none;
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
                    <h3 class="page-title">Reference Information</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('reference-info.index')}}"> Reference Information</a></li>
                        <li class="breadcrumb-item active">Single Reference Information</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <div class="btn-group btn-group-sm">
                    <button class="btn btn-white" id="generate-pdf">PDF</button>
            <button class="btn btn-white" onclick="printerDiv('reference-single-data')"><i class="fa fa-print fa-lg"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row" id="reference-single-data">
            <div class="col-md-12">
            <div class="card" id="reference-single-data-card">
                    <div class="card-body">


                        <div class="row">
                            <div class="table-responsive no-border">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <th>Reference Name:</th>
                                            <td class="text-right referencename">{{ucwords($reference->name)}}</td>
                                        </tr>
                                        @if(!empty($reference->optional_name))
                                        <tr>
                                            <th>Optional Name:</th>
                                            <td class="text-right ">{{ucwords($reference->optional_name)}}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Branch Office:</th>
                                            <td class="text-right ">{{ucwords($reference->branchOffice->branch_office_name ?? '')}}</td>
                                        </tr>

                                        @if(!empty($reference->company))
                                        <tr>
                                            <th>Company:</th>
                                            <td class="text-right ">{{ucwords($reference->company)}}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Company:</th>
                                        <?php  $countries=CountryState::getCountries();?>
                                            @foreach(@$countries as $key => $value)
                                                @if($key== $reference->country)
                                                <td class="text-right ">{{ucwords($value)}} </td>
                                                @endif
                                            @endforeach
                                        </tr>

                                        <tr>
                                            <th>Address:</th>
                                            <td class="text-right ">{{ucwords($reference->address)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Number:</th>
                                            <td class="text-right ">{{ucwords($reference->contact_no)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile Number:</th>
                                            <td class="text-right ">{{ucwords($reference->mobile_no)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td class="text-right ">{{ucwords($reference->email)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Status:</th>
                                            <td class="text-right ">{{ucwords($reference->status)}}</td>
                                        </tr>

                                        @if(!empty($reference->name_of_organization))
                                        <tr>
                                            <th>Name of organization:</th>
                                            <td class="text-right ">{{ucwords($reference->name_of_organization)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($reference->membership_no))
                                        <tr>
                                            <th>Membership Number:</th>
                                            <td class="text-right ">{{ucwords($reference->membership_no)}}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <th>Image:</th>
                                            <td class="text-right">
                                                <a class="thumbnail-order" href="#thumb">
                                                    <img src="<?php if(!empty($reference->image)){ echo '/images/referenceinfo/'.$reference->image; } else { echo '/images/profiles/others.png'; }  ?>" style="width:8rem;" alt="{{$reference->name}}">
                                                    <span>
                                                         <img src="<?php if(!empty($reference->image)){ echo '/images/referenceinfo/'.$reference->image; } else { echo '/images/profiles/others.png'; }  ?>" style="height:15rem;" alt="{{$reference->name}}">
                                                    </span>
                                                </a>
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


var cache_width = $('#reference-single-data-card').width();
    var a4 = [595.28, 841.89];

    $(document).on("click", '#generate-pdf', function () {
        // $("#ledger-single-data-card").width((a4[0] * 1.33333)).css('max-width', 'none');
        var text = $('.referencename').text();
        // console.log(text.trim());
        var name = text.trim();
        // console.log(name);
        // Aqui ele cria a imagem e cria o pdf
        html2canvas($('#reference-single-data-card'), {
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
                doc.save(name+'-reference-information.pdf');
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
