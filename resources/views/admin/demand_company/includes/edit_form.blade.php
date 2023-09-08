{!! Form::model($data['demand_company'], ['route' => ['company.update',$data['demand_company']->id ], 'method' => 'PUT','class'=>'submit_form','enctype'=>'multipart/form-data']) !!}

<div class="form-group">
    <label>Company Name <span class="text-danger">*</span></label>
    <input class="form-control" name="title" id="title" type="text" value="{{ $data['demand_company']->title  ?? ''}}" required>
    <div class="invalid-feedback">
        Please enter Company Name.
    </div>
    @if($errors->has('title'))
        <div class="invalid-feedback">
            {{$errors->first('title')}}
        </div>
    @endif
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Address </label>
            <input class="form-control" name="address" id="address" type="text" value="{{ $data['demand_company']->address  ?? ''}}">
            <div class="invalid-feedback">
                Please enter Company Address.
            </div>
            @if($errors->has('company_address'))
                <div class="invalid-feedback">
                    {{$errors->first('company_address')}}
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="col-form-label">Overseas Agent </label>
            {!! Form::select('overseas_agent_id',  $data['agents'] , $data['demand_company']->overseas_agent_id ?? null,['class'=>'form-select mb-3 select2','id'=>'overseas_agent_id','placeholder'=>'Select overseas agent']) !!}

            <div class="invalid-feedback">
                Please select a agent.
            </div>
            @if($errors->has('overseas_agent_id'))
                <div class="invalid-feedback">
                    {{$errors->first('overseas_agent_id')}}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="col-form-label">Country </label>
            {!! Form::select('country', $data['countries'], $data['demand_company']->country ?? null,['class'=>'form-select updatecountry mb-3 select2','id'=>'country','placeholder'=>'Select country']) !!}

            <div class="invalid-feedback">
                Please select a Country.
            </div>
            @if($errors->has('country'))
                <div class="invalid-feedback">
                    {{$errors->first('country')}}
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="col-form-label">State </label>
            {!! Form::select('country_state_id[]', $data['states'], $data['demand_company']->demandCompanyCountryStates ? $data['demand_company']->demandCompanyCountryStates->pluck('id'):null,['class'=>'custom-select select2','id'=>'country_state_id','multiple'=>'multiple']) !!}

            <div class="invalid-feedback">
                Please select a state.
            </div>
            @if($errors->has('state'))
                <div class="invalid-feedback">
                    {{$errors->first('state')}}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Phone Number <span class="text-danger">*</span></label>
            <input class="form-control" name="phone" id="phone" type="text" value="{{ $data['demand_company']->phone ?? '' }}" required>
            <div class="invalid-feedback">
                Please enter Company Contact Number.
            </div>
            @if($errors->has('company_contact_num'))
                <div class="invalid-feedback">
                    {{$errors->first('company_contact_num')}}
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Mobile Number </label>
            <input class="form-control" name="mobile" id="mobile" type="text" value="{{ $data['demand_company']->mobile ?? '' }}">
            <div class="invalid-feedback">
                Please enter Company Fax Number.
            </div>
            @if($errors->has('fax_num'))
                <div class="invalid-feedback">
                    {{$errors->first('fax_num')}}
                </div>
            @endif
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Email <span class="text-danger">*</span></label>
            <input class="form-control" name="email" id="email" type="email" value="{{ $data['demand_company']->email ?? ''}}" required>
            <div class="invalid-feedback">
                Please enter Company Email.
            </div>
            @if($errors->has('company_email'))
                <div class="invalid-feedback">
                    {{$errors->first('company_email')}}
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Company Fax Number </label>
            <input class="form-control" name="fax_number" id="fax_number" type="number" value="{{ $data['demand_company']->fax_number ?? ''}}">
            <div class="invalid-feedback">
                Please enter Company Fax Number.
            </div>
            @if($errors->has('fax_num'))
                <div class="invalid-feedback">
                    {{$errors->first('fax_num')}}
                </div>
            @endif
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Website </label>
            <input class="form-control" name="website" id="website" type="text" value="{{ $data['demand_company']->website ?? '' }}">
            <div class="invalid-feedback">
                Please enter Company Website.
            </div>
            @if($errors->has('website'))
                <div class="invalid-feedback">
                    {{$errors->first('website')}}
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Status  <span class="text-danger">*</span></label>
            {!! Form::select('status', ['continued'=>'Continued','discontinued'=>'Dis-Continued '], $data['demand_company']->status ?? 'continued' ,['class'=>'custom-select select2','id'=>'status']) !!}
            <div class="invalid-feedback">
                Please select a Status.
            </div>
            @if($errors->has('status'))
                <div class="invalid-feedback">
                    {{$errors->first('status')}}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="submit-section">
    <button class="btn btn-primary submit-btn" id="submit-module">Submit</button>
</div>
{!! Form::close() !!}
