@push('css')
<style type="text/css">
    .row.back-btn {
    align-items: right;
    float: right;
    margin: -39px 1pc;
    color: white;
}
</style>
@endpush
@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('css/registration.css')}}">
<div class="row back-btn">
    <a  href="{{ url('/')}}"class="btn btn-primary">Back</a>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('User Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="container">
            <div class="col-lg-12 well">
            <div class="row">
                <form>
                    <div class="col-sm-12"> 
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>First Name</label>
                                <input type="text" placeholder="Enter First Name Here.." class="form-control {{ $errors->has('fname')?'is-invalid':''}}" name="fname" value="{{ old('fname') }}" autofocus="">
                                <!-- @if ($errors->has('fname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Last Name</label>
                                <input type="text" placeholder="Enter Last Name Here.." class="form-control {{ $errors->has('lname')?'is-invalid':'' }}" name="lname" value="{{old('lname')}}">
                                @if ($errors->has('lname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label>Email Address</label>
                            <input type="email" placeholder="Enter Email Address Here.." class="form-control {{ $errors->has('email')?'is-invalid':'' }}"name="email" value="{{old('email')}}">
                            @if($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>  
                         <div class="form-group">
                            <label>Password</label>
                            <input type="Password" placeholder="Enter Password Here.." class="form-control {{ $errors->has('Password')?'is-invalid':'' }}"name="Password" value="{{old('Password')}}">
                            @if($errors->has('Password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Password') }}</strong>
                                    </span>
                                @endif
                        </div>   
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="Password" placeholder="Enter Confirm Password Here.." class="form-control {{ $errors->has('confirmPassword')?'is-invalid':'' }}"name="confirmPassword" value="{{old('confirmPassword')}}">
                            @if($errors->has('confirmPassword'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('confirmPassword') }}</strong>
                                    </span>
                                @endif
                        </div> 
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" placeholder="Enter Address Here.." class="form-control {{ $errors->has('address')?'is-invalid':'' }}"name="address" value="{{old('address')}}">
                            @if($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                        </div>   
                          <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>City</label>
                                <input type="text" placeholder="Enter City Name Here.." class="form-control {{ $errors->has('city')?'is-invalid':'' }}" name="city" value="{{ old('city') }}">
                                @if($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>  
                            <div class="col-sm-6 form-group">
                                <label>State</label>
                                <input type="text" placeholder="Select Country Name Here.." class="form-control {{ $errors->has('state')?'is-invalid':'' }}" name="state" value="{{ old('state') }}">
                                 @if($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div> 
                         <div class=" col-sm-6 form-group">
                            <label>Phone No</label>
                            <input type="number" placeholder="Enter Phone no Here.." class="form-control {{ $errors->has('phone')?'is-invalid':'' }}"name="phone" value="{{ old('phone') }}">
                            @if($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                        </div>                      
                          <div class=" col-sm-6 form-group">
                            <label>Pin No</label>
                            <input type="number" placeholder="Enter Phone no Here.." class="form-control {{ $errors->has('pin')?'is-invalid':'' }}"name="pin" value="{{old('pin')}}">
                            @if($errors->has('pin'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                                @endif
                        </div> 
                                              
                           

                        </div>   
    
                    <button type="submit" class="btn btn-lg btn-info">Submit</button>                   
                    </div>
                </form> 
                </div>
    </div>
    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
