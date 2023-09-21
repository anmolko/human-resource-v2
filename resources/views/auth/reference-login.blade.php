@extends('layouts.app')

@section('content')


<div class="account-wrapper">
    <h3 class="account-title">Reference Agent Login</h3>
    <!-- Account Form -->
    <form method="POST" enctype="multipart/form-data" action="{{ route('reference.login') }}">
    @csrf

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <b class="alert-link">{{session('error')}}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="form-group">
            <label>Email</label>
            <input id="email" class="form-control" name="email" required type="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
        </div>
        @error('email')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <b class="alert-link">{{ $message }} </b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @enderror

        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label>Password</label>
                </div>
            </div>
            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">

        </div>

        @error('password')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <b class="alert-link">{{ $message }}</b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @enderror

        <!-- <div class="form-group">

            <div class="form-check float-left">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

        </div> -->

        <div class="form-group text-center">
            <button class="btn btn-primary account-btn" name="login" type="submit">Login</button>

        </div>


        <div class="account-footer">
            <p></p>
        </div>
    </form>
    <!-- /Account Form -->

</div>


@endsection
