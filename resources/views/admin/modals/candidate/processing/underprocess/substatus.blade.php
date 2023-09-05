<div id="edit_underprocess_substatus" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Change Sub Status Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{--                {!! Form::open(['route' => 'candidate-professional-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}--}}

                <div class="form-group">
                    <label>Sub Status: </label>
                    <select class="custom-select country select-height" name="sub_status">
                        <option value disabled selected> Select Sub Status</option>
                        @foreach($sub_status as $sub)
                            <option value="{{$sub->id}}">{{ucwords($sub->name)}} </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select the sub status.
                    </div>
                    @if($errors->has('sub_status'))
                        <div class="invalid-feedback">
                            {{$errors->first('sub_status')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Remarks: </label>
                    <textarea type="text" class="form-control" rows="2" name="remarks"></textarea>
                    <div class="invalid-feedback">
                        Please enter the remarks
                    </div>
                    @if($errors->has('remarks'))
                        <div class="invalid-feedback">
                            {{$errors->first('remarks')}}
                        </div>
                    @endif
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-underprocessing-substatus-update">Submit</button>
                </div>
                {{--                {!! Form::close() !!}--}}
            </div>
        </div>
    </div>
</div>
