<div id="view_document_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Candidate Document Information</h5>
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
                                            <h3 class="text-uppercase text-center">Candidate: <span id="view_document_candidate_name"></span> </h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive no-border">
                                            <table class="table mb-0">
                                                <tbody>
                                                <tr>
                                                    <th>Resume: </th>
                                                    <td class="text-right text-capitalize" id="view_document_resume"></td>
                                                </tr>
                                                <tr>
                                                    <th>Original Passport: </th>
                                                    <td class="text-right text-capitalize" id="view_document_original_passport"></td>
                                                </tr>
                                                <tr>
                                                    <th>Passport Xerox Copy: </th>
                                                    <td class="text-right text-capitalize"><h5 id="view_document_passport_xerox_copy"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Academic certificates: </th>
                                                    <td class="text-right text-capitalize"><h5 id="view_document_academic_certificates"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Original Academic certificates: </th>
                                                    <td class="text-right text-capitalize"><h5 id="view_original_academic_certificates"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Professional Training:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_document_professional_training"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Work Documents</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_document_work_certificates"></h5></td>
                                                </tr>

                                                <tr>
                                                    <th>Medical Reports:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_document_medical_reports"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Original Driving License:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_document_original_driving_license"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Driving License Copy:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_document_driving_license_copy"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Photographs:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_document_photographs"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Photographs Image:</th>
                                                    <td class="text-right"><h5 id="view_document_photograph_image"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Passport Image:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_document_passport_image"></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Signature Image:</th>
                                                    <td class="text-right text-capitalize"><h5 id="view_document_signature_image"></h5></td>
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
