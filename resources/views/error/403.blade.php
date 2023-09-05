@extends('layouts.master')
@section('title') Forbidden Action - HRMS @endsection
@section('content')

    <div class="custom-content container-fluid">
    
      
        <div class="main-wrapper">
			
			<div class="error-box">
				<h1>{{$code}}</h1>
				<h3><i class="fa fa-warning"></i> Oops! Forbidden Action.</h3>
                <p>
                <strong>{{ $message }}</strong><br>
                </p>
			</div>
		
        </div>
    </div>
		<!-- /Main Wrapper -->
@endsection