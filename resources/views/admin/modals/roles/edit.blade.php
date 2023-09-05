<div id="edit_role" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-md">
			<div class="modal-header">
				<h5 class="modal-title">Edit Role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			{!! Form::open(['method'=>'PUT','class'=>'needs-validation updaterole','novalidate'=>'']) !!}

					<div class="form-group">
						<label>Role Name <span class="text-danger">*</span></label>
						<input class="form-control updatename" type="text" name="name" required>
						<div class="invalid-feedback">
							Please enter a role name.
						</div>
						@if($errors->has('name'))
						<div class="invalid-feedback">
							{{$errors->first('name')}}
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
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Save</button>
					</div>
					{!! Form::close() !!}

			</div>
		</div>
	</div>
</div>