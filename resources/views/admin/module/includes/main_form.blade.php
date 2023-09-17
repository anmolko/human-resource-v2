<div class="form-group">
    <label>Parent Module </label>
    {!! Form::select('parent_module_id', $modules->pluck('name','id'), null,['class'=>'custom-select mb-3 select2','id'=>'parent_module_id','placeholder'=>'Select parent module']) !!}
    <div class="invalid-feedback">
        Please enter parent module.
    </div>
    @if($errors->has('parent_module_id'))
        <div class="invalid-feedback">
            {{$errors->first('parent_module_id')}}
        </div>
    @endif
</div>
<div class="form-group">
    <label class="required">Module Name </label>
    <input class="form-control updatename" id="name" name="name" type="text">
    <div class="invalid-feedback">
        Please enter a module name.
    </div>
</div>
<div class="form-group">
    <label class="required">Key </label>
    <input class="form-control updatekey" type="text" id="key" name="key" value="" readonly="">
</div>
<div class="form-group">
    <label class="required">Url </label>
    <input class="form-control updateurl" name="url" type="text">
    <div class="invalid-feedback">
        Please enter a url.
    </div>
</div>
<div class="form-group">
    <label>Icon </label>
    <input class="form-control" type="text" name="icon" id="icon">
    <small class="text-warning">Applicable only for parent module, not child module</small>
</div>
<div class="form-group">
    <label>Rank </label>
    <input class="form-control" type="number" name="rank" min="0" id="rank">
    <small class="text-warning">Applicable only for child module, not parent module</small>
</div>
<div class="form-group">
    <label>Status <span class="text-danger">*</span></label>
    <select  class="custom-select" name="status" required>
        <option value="1">Active </option>
        <option value="0">Inactive</option>
    </select>
</div>
<div class="submit-section">
    <button class="btn btn-primary submit-btn" type="submit" id="submit-module">Submit</button>
</div>
