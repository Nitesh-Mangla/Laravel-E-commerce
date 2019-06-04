@extends('welcome')

@push('css')

@endpush


@section('body')
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->

<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
  <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
<link href="{{asset('css/profile.css')}}" rel="stylesheet" id="bootstrap-css">
/<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

@if( isset($data) )
@foreach( $data as $value )
<div class="container emp-profile">
            
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="profile_pic/{{$value->image}}" id="{{ $value->id }}" title="Profile Pic" class="profile" style="cursor:pointer"/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name=" " id="file" class="{{ $value->id }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        {{ $value->name }}
                                    </h5>
                                    <h6>
                                        Customer
                                    </h6>
                                    <!-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                 <li class="nav-item" style="    margin: 1px 165px;">
                                     <a class="nav-link " id="home-tab" data-toggle="tab" href="{{ route('logout') }}"
                                        role="tab" aria-controls="home" aria-selected="true"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>

                                <!--  <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                      EDIT PROFILE
                    </button>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>HISTORY LINK</p>
                            <a href="{{url('card')}}">Card Details</a><br/>
                            <a href="">Your Orders</a><br/>
                            <a href="{{url('/')}}">Home</a><br/>
                            <!-- <a href="">Bootply Profile</a>
                            <p>SKILLS</p>
                            <a href="">Web Designer</a><br/>
                            <a href="">Web Developer</a><br/>
                            <a href="">WordPress</a><br/>
                            <a href="">WooCommerce</a><br/>
                            <a href="">PHP, .Net</a><br/> -->
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $value->id }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $value->name }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $value->email }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $value->phone_no }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-3">
                                                <p>{{ $value->address.' '.$value->city.' '.$value->state }}</p>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-6">
                                                <label>Password</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>**********</p>
                                            </div>
                                        </div>
                                       
                            </div>
                           
                            </div>
                        </div>
                    </div>
                </div>
                 
        </div>


<!-- Edit profile Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  >
         <form name="editForm" action="" method="post">
          
        @if( isset($data) )
        @foreach( $data as $value )
       
    <div class="form-group">
        <div class="alert alert-success" id="successMsg"></div>
        <div class="alert alert-warning" id="errorMsg"></div>
      <!-- <label for="email">User Id:</label> -->
      <input type="hidden" class="form-control" id="id" title="User Id" placeholder="Enter id" name="id" value="{{ $value->id }}" >
    </div>
    <div class="form-group">
      <label for="pwd">Name:</label>
      <input type="text" class="form-control" id="name" title="User Name" placeholder="Enter name" name="name" value="{{ $value->name }}" disabled>
    </div>
    <div class="form-group">
      <label for="pwd">Email:</label>
      <input type="email" class="form-control" id="email" title="User Email" placeholder="Enter Email" name="email" value="{{ $value->email }}" disabled>
    </div>
    <div class="form-group">
      <label for="pwd">Phone No:</label>
      <input type="text" class="form-control" id="phone" title="Usser Phone No" placeholder="Enter Phone No" name="phone" value="{{ $value->phone_no }}">
    </div>

    <div class="form-group">
      <div class="col-md-4">
      <label for="pwd">Address:</label>
      <input type="text" class="form-control" id="address" title="Usser Phone No" placeholder="Enter Phone No" name="address" value="{{ $value->address }}" style="margin-left: -15px;">
    </div>
    <div class="col-md-4">
      <label for="pwd">State:</label>
      <input type="text" class="form-control" id="state" title="Usser Phone No" placeholder="Enter Phone No" name="state" value="{{ $value->state }}" style="margin-left: -15px;">
    </div>
    <div class="col-md-4">
      <label for="pwd">City:</label>
      <input type="text" class="form-control" id="city" title="Usser Phone No" placeholder="Enter Phone No" name="city" value="{{ $value->city }}" style="margin-left: -15px;">
    </div>
    </div>
    <div class="form-group">
      <label for="pwd">Password*:</label>
      <input type="password" class="form-control" id="pwd" title="User Password" placeholder="Enter password" name="pswd" value="">
    </div>
    <div class="form-group">
      <label for="pwd">Confirm Password*:</label>
      <input type="password" class="form-control" id="confipwd"  placeholder="Enter password" name="pswd" value="">
    </div>
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
  
  <button type="button" class="btn btn-primary save_profile" >Save Change</button>
         </div>
         @endforeach
  @endif
    </form>
      </div>
    </div>
  </div>
</div>
 @endforeach
 @endif       
@endsection

