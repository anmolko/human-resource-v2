@extends('layouts.entry_master')
@section('title') {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_lastname}}'s application @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/backend/assets/print3.css')}}"/>
@endsection


@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_lastname}}'s application form</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate-personal-info.index')}}">Candidate Entry</a></li>
                        <li class="breadcrumb-item active">
                            <span class="dropdown">
                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Employment Application 3
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/candidate-personal-application/{{$candidate_personal->id}}/app" > Employment Application 1</a>
                                    <a class="dropdown-item" href="/candidate-personal-application/{{$candidate_personal->id}}/app2">Employment Application 2</a>
                                    <a class="dropdown-item active text-white disabled">Dynamic Application(Custom Letterhead)</a>
                                    <a class="dropdown-item action-application" href="/candidate-personal-application/{{$candidate_personal->id}}/app4" >Employment Application 4</a>
                                </div>
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="col-auto float-right ml-auto">
                    <button class="btn add-btn" id="print-button"><i class="fa fa-print"></i>Print Document</button>
                </div>
            </div>
        </div>

        <div class="cv-base" >
            <page id="printable_div" class="front">
                <header class="print-header">
                    <div class="head-top">
                        @if($company_settings->letterhead)
                            <img src="{{asset('/images/company/'.$company_settings->letterhead)}}" style="width:100%;"/>
                        @endif
                    </div>
                </header>
                <section class="print-body">

                    {{--                    <div class="greyed">Application for employment</div>--}}

                    <div class="body-margin">
                        <div class="row g-5 mb-3">
                            <div class="col-md-6" style="font-size: 14px">Referred by: <b>{{strtoupper(@$candidate_personal->referenceInfo->reference_name)}}</b></div>
                            <div class="col-md-6" style="font-size: 14px">Company name: <b>{{strtoupper($candidate_personal->demandJobInfo->demandInfo->company_name)}}</b></div>
                        </div>
                        <div class="row g-5">
                            <div class="col-md-9 col-lg-9 order-md-last ml-5">
                                <h4 class="mb-3">PERSONAL DETAILS</h4>

                                <div class="form-group row mb-0">
                                    <label for="name" class="col-sm-1 col-form-label">Name: </label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" value="{{@$name}}" id="name" disabled>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <label for="name" class="alt col-sm-2 col-form-label">Address: </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" value="{{@$candidate_personal->permanent_address}}" id="address" disabled>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="referred" class="alt2 col-sm-3 col-form-label">Applied for: </label>
                                    <div class="col-sm-9 alt3">
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" value="{{@$candidate_personal->demandJobInfo->jobtoDemand->jobCategory->name}}" id="referred" disabled>
                                    </div>
                                </div>
                                <div class="form-inline mb-1">
                                    <div class="form-group mr-2">
                                        <label for="dob">DOB:</label>
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="dob" value="{{\Carbon\Carbon::parse(@$candidate_personal->date_of_birth)->isoFormat('MMM Do, YYYY')}}" size="13" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age:</label>
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="age" value="{{@$candidate_personal->age}}" size="2" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="height">Height:</label>
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="height" value="{{@$candidate_personal->height}} fts" size="5" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="weight">Weight:</label>
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="weight" value="{{@$candidate_personal->weight}} kgs" size="5" disabled>
                                    </div>
                                </div>

                                <div class="form-inline mb-1">
                                    <div class="form-group mr-2">
                                        <label for="nationality">Nationality:</label>
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="nationality" value="{{@$candidate_personal->nationality}}" size="23" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="religion">Religion:</label>
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="religion" value="{{@$candidate_personal->religion}}" size="22" disabled>
                                    </div>
                                </div>



                                <div class="form-inline mb-1">
                                    <div class="form-group mr-2">
                                        <label for="mobileno">Mobile No:</label>
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="mobileno" value="{{@$candidate_personal->mobile_no}}" size="21" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="contactno">Contact No:</label>
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="contactno" value="{{@$candidate_personal->contact_no}}" size="21" disabled>
                                    </div>
                                </div>

                                <div class="form-inline mb-1">
                                    <div class="form-group mr-2">
                                        <label for="fathername">Father name:</label>
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="fathername" value="{{@$candidate_personal->father_name}}" size="20" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="contactnumber">Mother Name:</label>
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="mother_name" value="{{@$candidate_personal->mother_name}}" size="19" disabled>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <label for="languages" class="col-sm-2 col-form-label">Languages: </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control print-input text-uppercase font-weight-bold" value="{{implode(", ", $languages)}}" id="languages" disabled>
                                    </div>
                                </div>

                                <div class="form-group row mt-1 mb-0 ml-1 mr-2">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Passport No</th>
                                            <th scope="col">Issue Date</th>
                                            <th scope="col">Expiry Date</th>
                                            <th scope="col">Place of issue</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{@$candidate_personal->passport_no}}</th>
                                            <td>{{\Carbon\Carbon::parse(@$candidate_personal->issued_date)->isoFormat('MMM Do, YYYY')}}</td>
                                            <td>{{\Carbon\Carbon::parse(@$candidate_personal->expiry_date)->isoFormat('MMM Do, YYYY')}}</td>
                                            <td>{{@$candidate_personal->birth_place}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                            <div class="col-md-3 col-lg-2">

                                @if(count($candidate_personal->documentInfo) == 0)
                                    <img src="{{asset('/images/test-pic.png')}}" class="mt-3 mb-3" height="210px" width="auto"/>
                                @else
                                    <img src="{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}" class="mt-3 mb-3" height="230px" width="auto"/>
                                @endif

                                {!! QrCode::size(150)->generate('Redg. no: '.@$candidate_personal->registration_no."\n".'candidate name:'.@$name."\n".'serial number:'.@$candidate_personal->serial_no."\n".'company name'.strtoupper(@$candidate_personal->demandJobInfo->demandInfo->company_name)."\n".'Job category:'.strtoupper(@$candidate_personal->demandJobInfo->jobtoDemand->jobCategory->name)) !!}


                            </div>

                        </div>
                        <div class="row g-5 mt-2 ml-1 mb-2">
                            <h4 class="mb-0 mt-0">QUALIFICATION INFORMATION</h4>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row mb-0 mr-2">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Qualification</th>
                                            <th scope="col">Name of the institute</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($candidate_personal->qualificationInfo)>0)
                                            @foreach($candidate_personal->qualificationInfo as $q)
                                                <tr>
                                                    <th scope="row">{{strtoupper(str_replace('-',' ',$q->academic_level))}}</th>
                                                    <td>{{strtoupper($q->school_college_name)}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th scope="row"><p></p></th>
                                                <td> </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><p></p></th>
                                                <td> </td>
                                            </tr>
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <h4 class="mb-1  mt-0">WORK EXPERIENCE </h4>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row mb-0 mr-2">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Position Held</th>
                                            <th scope="col">Name of the employer</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($candidate_personal->professionalInfo)>0)
                                            @foreach($candidate_personal->professionalInfo as $p)
                                                <tr>
                                                    <th scope="row">{{strtoupper($p->category_of_job)}}</th>
                                                    <td>{{strtoupper($p->company_name)}}</td>
                                                    <td>
                                                        @foreach($countries as $value=>$c)
                                                            @if($value == $p->country)
                                                                {{$c}}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{\Carbon\Carbon::parse(@$p->from)->isoFormat('MMM Do, YYYY')}}</td>
                                                    <td>{{\Carbon\Carbon::parse(@$p->to)->isoFormat('MMM Do, YYYY')}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th scope="row"><p></p></th>
                                                <td><p></p></td>
                                                <td></td>
                                                <td></td>
                                                <td><p></p></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><p></p></th>
                                                <td><p></p></td>
                                                <td></td>
                                                <td></td>
                                                <td><p></p></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <h4 class="mb-0  mt-0">DECLARATION</h4>
                            <div class="col-md-12 col-lg-12 alt4 mt-2">I certify that the statement in this application are true by nature and best of my knowledge. Any information necessary to
                                verify my qualification can be authorized. I also agree that if I fail to meet any physical requirements, or if, for any reason, I am not
                                qualified for employment and no one shall be liable for any compensation.
                            </div>
                        </div>
                        <div class="row g-5 mb-1 mt-0 p-2">
                            <div class="col-6">
                                {{--                                 <span class="float-left text-center">--}}
                                {{--                                    <input type="text" class="form-control print-input text-uppercase font-weight-bold" size="30" disabled>--}}
                                {{--                                    <label class="mt-2">SInterviewer</label>--}}
                                {{--                                 </span>--}}
                            </div>
                            <div class="col-6">
                                <span class="float-right text-center">
                                     <input type="text" class="form-control print-input text-uppercase font-weight-bold" size="30" disabled>
                                     <label class="mt-2">Applicant's signature</label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="languages" class="col-sm-2 alt6 col-form-label">Evaluation/Comments: </label>
                            <div class="col-sm-10 alt7">
                                <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="languages" disabled>
                            </div>
                            <label for="languages" class="col-sm-2 alt6 col-form-label">(office use only) </label>
                            <div class="col-sm-10 alt7">
                                <input type="text" class="form-control print-input text-uppercase font-weight-bold" id="languages" disabled>
                            </div>
                        </div>
                    </div>

                </section>

            </page>

        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#print-button').on('click',function(){
            // var printContents = document.getElementById('printable_div').innerHTML;
            // var originalContents = document.body.innerHTML;
            // document.body.innerHTML = printContents;
            // window.print();
            // document.body.innerHTML = originalContents;
            // return true;

            var stylename    = '<link rel="stylesheet" href="/backend/assets/print3.css" type="text/css">';
            var getpanel = document.getElementById('printable_div');
            var MainWindow = window.open('', '', 'height=1000,width=1000');
            MainWindow.document.write('<html><head><title>Application form</title>');
            MainWindow.document.write(stylename);
            MainWindow.document.write('</head><body onload="window.print();window.close()">');
            MainWindow.document.write(getpanel.innerHTML);
            MainWindow.document.write('</body></html>');
            MainWindow.document.close();
            setTimeout(function () {
                MainWindow.print();
            }, 500)
            return true;
        });

    </script>
@endsection
