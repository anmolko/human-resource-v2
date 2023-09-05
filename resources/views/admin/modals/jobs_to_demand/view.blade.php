<div id="view_job_demand" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Job Information</h5>
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
                                            <h3 class="text-uppercase text-center">Demand Ref No. <span id="view-ref-no"></span> </h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="table-responsive no-border">
                                            <table class="table mb-0">
                                                <tbody>
                                                <tr>
                                                    <th>Job Category: </th>
                                                    <td class="text-right text-capitalize" id="view-job-category"></td>
                                                </tr>
                                                <tr>
                                                    <th>Status: </th>
                                                    <td class="text-right text-capitalize" id="view-job-status"></td>
                                                </tr>
                                                <tr>
                                                    <th>Requirements: </th>
                                                    <td class="text-right"><h5 id="view-requirements"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Min Qualification: </th>
                                                    <td class="text-right"><h5 id="view-min-qualification"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Contact period:</th>
                                                    <td class="text-right"><h5 id="view-contact-period"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Working</th>
                                                    <td class="text-right"><h5 id="view-working"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Holidays:</th>
                                                    <td class="text-right"><h5 id="view-holidays"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Hours:</th>
                                                    <td class="text-right"><h5 id="view-hours"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Overtime:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-overtime"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Overtime per month:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-overtime-per-month"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Salary:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-salary"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Currency:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-currency"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Accommodation:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-accommodation"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Food facilities:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-food-facilities"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Ticket:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-ticket"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Medical In:</th>
                                                    <td class="text-right"><h5 id="view-medical-in"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Medical Company:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-medical-company"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Insurance In:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-insurance-in"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Insurance Company:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-insurance-company"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Levy:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-levy"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Levy Amount:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-levy-amount"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Remarks:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view-remarks"></h5></td>
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
