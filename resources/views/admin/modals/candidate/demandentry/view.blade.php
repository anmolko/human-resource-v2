<div id="view_demandentry_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Candidate Demand Job Information</h5>
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
                                            <h3 class="text-uppercase text-center">Candidate: <span id="view_demandentry_candidate_name"></span> </h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive no-border">
                                            <table class="table mb-0">
                                                <tbody>
                                                <tr>
                                                    <th>Skills: </th>
                                                    <td class="text-right text-capitalize" id="view_demandentry_skills"></td>
                                                </tr>
                                                <tr>
                                                    <th>Actual Job Category: </th>
                                                    <td class="text-right text-capitalize" id="view_demandentry_job_category_id"></td>
                                                </tr>
                                                <tr>
                                                    <th>Salary: </th>
                                                    <td class="text-right text-capitalize" id="view_demandentry_salary"></td>
                                                </tr>
                                                <tr>
                                                    <th>Company Name: </th>
                                                    <td class="text-right text-capitalize"><h5 id="view_demandentry_demand_info_id"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Job category: </th>
                                                    <td class="text-right text-capitalize"><h5 id="view_demandentry_job_to_demand_id"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Issued date:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_demandentry_issued_date"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Status Applied Date</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_demandentry_status_applied_date"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Number of PAX:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_demandentry_num_of_pax"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Agent Name:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_demandentry_overseas_agent_id"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Sub Status:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_demandentry_sub_status"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Remarks:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_demandentry_remarks"></h5></td>
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
