<div id="view_trainings_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Candidate Professional Training Information</h5>
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
                                            <h3 class="text-uppercase text-center">Candidate: <span id="view_training_candidate_name"></span> </h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive no-border">
                                            <table class="table mb-0">
                                                <tbody>
                                                <tr>
                                                    <th>Certificate number: </th>
                                                    <td class="text-right text-capitalize" id="view_training_certificate_no"></td>
                                                </tr>
                                                <tr>
                                                    <th>Training Type: </th>
                                                    <td class="text-right text-capitalize" id="view_training_training_type"></td>
                                                </tr>
                                                <tr>
                                                    <th>Institute Name: </th>
                                                    <td class="text-right"><h5 id="view_training_institute_name"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Country: </th>
                                                    <td class="text-right"><h5 id="view_training_country"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Duration:</th>
                                                    <td class="text-right"><h5 id="view_training_duration"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Certificate:</th>
                                                    <td class="text-right"><h5 id="view_certificate"></h5></td>
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
