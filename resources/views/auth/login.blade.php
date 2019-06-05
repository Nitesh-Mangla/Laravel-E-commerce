@extends('layouts.app')

@push('css')
@include('layouts.resource')
@endpush

@section('header')
@include('layouts.header')
@endsection

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="{{asset('css/login.css')}}">
                

               <div class="login-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                         <h2 class="text-center">Sign in</h2>   
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="email" class="form-control"  name="email" placeholder="Username" value="{{ old('email') }}" required="required">        
                 @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif     
            </div>
        </div>
                        
            <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password" value=" {{ old('password') }} " required="required">  
                 @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif           
            </div>
        </div>

                        <div class="form-group">
            <button type="submit" class="btn btn-primary login-btn btn-block">{{ __('Login') }}</button>
                 @if (Route::has('password.request'))
                                   
                                @endif
        </div>
                <div class="clearfix">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
            <a href="#" class="pull-right">Forgot Password?</a>
        </div>
                       

                       <div class="or-seperator"><i>or</i></div>
        <p class="text-center">Login with your social media account</p>
        <div class="text-center social-btn">
            <a href="{{ url('/facebookLogin') }}" class="btn btn-primary"><i class="fa fa-facebook"></i>&nbsp; Facebook</a>
            <a href="#" class="btn btn-info"><i class="fa fa-twitter"></i>&nbsp; Twitter</a>
            <a href="{{ url('/redirect') }}" class="btn btn-danger"><i class="fa fa-google"></i>&nbsp; Google</a>
        </div>
    </form>
    <p class="text-center text-muted small">Don't have an account? <a href="{{route('register')}}">Sign up here!</a></p>
</div>
                   
@endsection

@section('footer')
@include('layouts.footer')
@endsection