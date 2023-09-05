<div id="edit_primary_group" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit  Primary Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="access-denied"> </div>
            <div class="modal-body">

                 {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateprimarygroup','novalidate'=>'']) !!}

                    <div class="form-group">
                            <label>Classfication  <span class="text-danger">*</span></label>
                            <select  class="custom-select updateselectclassfication" name="classfication" required>
                            <option value disabled selected> Select Classfication</option>
                            <optgroup label="Liabilities">
                                <option value="capital account">Capital Account</option>
                                <option value="non current liabilities">Non Current Liabilities</option>
                                <option value="current liabilities">Current Liabilities</option>
                            </optgroup>
                            <optgroup label="Assets">   
                                <option value="non current assets">Non Current Assets</option>
                                <option value="current assets">Current Assets</option>
                                <option value="fixed assets">Fixed Assets</option>
                                <option value="investment">Investment</option>
                            </optgroup>

                            <optgroup label="Expenses">   
                                    <option value="indirect expenses">Indirect Expenses</option>
                                    <option value="direct expenses">Direct Expenses</option>
                                </optgroup>

                                <optgroup label="Income">   
                                    <option value="indirect income">Indirect Income</option>
                                    <option value="direct income">Direct Income</option>
                                </optgroup>

                                <optgroup label="Sale">   
                                    <option value="sales">Sales</option>
                                </optgroup>

                                <optgroup label="Purchase">   
                                    <option value="purchases">Purchases</option>
                                </optgroup>


                            </select>
                            <div class="invalid-feedback">
                                Please select a classfication name.
                            </div>
                            
                    </div>

                    <div class="form-group">
                        <label>Primary Group Name <span class="text-danger">*</span></label>
                        <input class="form-control updatename" id="name"  name="name"  type="text"  required>
                        <div class="invalid-feedback">
                            Please enter a primary group name.
                        </div>
                        @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Slug <span class="text-danger"></span></label>
                        <input class="form-control updateslug" type="text"  id="slug" name="slug" value="" readonly="">
                        @if($errors->has('slug'))
                        <div class="invalid-feedback">
                            {{$errors->first('slug')}}
                        </div>
                        @endif
                    </div>
                   
                    
                    <div class="form-group">
                        {!! Form::label('status','Status:'); !!} &nbsp;&nbsp;
                        <label>
                            {!! Form::radio('status', 1) !!}  
                            Enable
                        </label>&nbsp;&nbsp;
                        <label>
                            {!! Form::radio('status', 0) !!}  
                            Disable
                        </label>
                    </div>

                    <div class="table-responsive m-t-15">
                        <h4>Select Attributes</h4>
                        <section class="scrollbar" id="style-1" >
                            <table class="table table-striped custom-table force-overflow" >
                                <tbody class="row" id="editselected_attribute">
                               
                                </tbody>
                            </table>
                        </section>

                    </div>
                    
                    <div class="submit-section">
                        <input class="btn btn-primary submit-btn" type="submit" value="Update" id="submit-module">
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>