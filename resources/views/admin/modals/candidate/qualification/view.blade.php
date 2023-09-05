<div id="view_qualification_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Candidate Qualification Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Page Content -->
                <div class="content container-fluid">

                    <!-- Page Header -->
                {{--                    <div class="page-header">--}}
                {{--                        <div class="row align-items-center">--}}
                {{--                            <div class="col-auto float-right ml-auto">--}}
                {{--                                <div class="btn-group btn-group-sm">--}}
                {{--                                    <button class="btn btn-white" id="generate-pdf">PDF</button>--}}
                {{--                                    <button class="btn btn-white" onclick="printerDiv('demand-single-data')"><i class="fa fa-print fa-lg"></i> Print</button>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <!-- /Page Header -->
                    <div class="row" id="demand-single-data">
                        <div class="col-md-12">
                            <div class="card" id="demand-single-data-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="text-uppercase text-center">Candidate: <span id="view_qualification_candidate_name"></span> </h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive no-border">
                                            <table class="table mb-0">
                                                <tbody>
                                                <tr>
                                                    <th>School/College name: </th>
                                                    <td class="text-right text-capitalize" id="view_qualification_school_college_name"></td>
                                                </tr>
                                                <tr>
                                                    <th>Academic level: </th>
                                                    <td class="text-right text-capitalize" id="view_qualification_academic_level"></td>
                                                </tr>
                                                <tr>
                                                    <th>Address: </th>
                                                    <td class="text-right"><h5 id="view_qualification_address"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Completed On: </th>
                                                    <td class="text-right"><h5 id="view_qualification_completed_on"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Division:</th>
                                                    <td class="text-right"><h5 id="view_qualification_division"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Result:</th>
                                                    <td class="text-right"><h5 id="view_qualification_result"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Study document:</th>
                                                    <td class="text-right"><h5 id="view_qualification_image"></h5></td>
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
            </div>
        </div>
    </div>
</div>
