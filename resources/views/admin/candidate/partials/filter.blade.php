<div class="col-12 col-md-12 col-lg-12 d-flex">
    <div class="card flex-fill">
        <div class="card-body">
            <div class="row filter-row" data-select2-id="10">
                <div class="col-sm-4 col-md-3">
                    <div class="form-group form-focus select-focus focused">
                        {!! Form::select('filter_period', ['today'=>'Today','yesterday'=>'Yesterday','week'=>'Last Week','two_weeks'=>'Last Two Weeks','month'=>'Month'], null,['class'=>'custom-select select-height select2','id'=>'filter_period','placeholder'=>'Select Search Period']) !!}
                        <label class="focus-label">Search Period</label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="form-group form-focus focused">
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" name="from_date" id="from_date" type="text" />
                        </div>
                        <label class="focus-label">From</label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="form-group form-focus focused">
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" name="to_date" id="to_date" type="text" />
                        </div>
                        <label class="focus-label">To</label>
                    </div>
                </div>
            @if (auth()->user() instanceof \App\Models\User && get_user_role() == 'admin' || get_user_role() == 'super-admin')
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group form-focus select-focus focused">
                            {!! Form::select('created_by',$createdBy, null,['class'=>'custom-select select-height select2','id'=>'created_by','placeholder'=>'Select created by']) !!}
                            <label class="focus-label">Created By</label>
                        </div>
                    </div>
                @endif
                <div class="col-sm-4 col-md-2">
                    <button type="button" id="filter_data" class="btn add-btn"> Filter </button>
                </div>
            </div>
        </div>
    </div>
</div>


