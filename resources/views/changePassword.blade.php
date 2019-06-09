@extends('welcome')
@push('css')
@include('layouts.resource')
<link rel="stylesheet" type="text/css" href="asset('css/forgetPassword.css ')">
@endpush

@section('body')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <div class="form-gap"></div>
<div class="container">
	<div class="row" style="margin-top: 18px;">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
                  @if( Session::has('message') )
        <div class="alert alert-warning alert-dismissible">
            <strong>{{ Session::get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        @endif
                    <form action ="{{url('changePassword')}}" id="register-form" role="form" autocomplete="off" class="form" method="post">
                      @csrf
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input type="hidden" name="id" value="{{$id}}">
                          <input id="email" name="password" placeholder="Enter password" class="form-control"  type="password">
                           <input id="pass" name="confirmpassword" placeholder="Confirm password" class="form-control"  type="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
<!-- End product widget area -->
@endsection
@push('js')
 <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.sticky.js')}}"></script>
    <script src="{{asset('js/jquery.easing.1.3.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bxslider.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/script.slider.js')}}"></script>
  @endpush  

