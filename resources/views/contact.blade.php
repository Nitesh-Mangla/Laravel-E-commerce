@extends('welcome')
@push('css')
@include('layouts.resource')


@endpush
@section('header')
@include('layouts.header')
@endsection

@section('body')
<link rel="stylesheet" type="text/css" href="{{asset('css/contact.css')}}">
<style>
@import url('https://fonts.googleapis.com/css?family=Roboto');
</style> 

<div class="container">

	<div class="map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d112061.09262729759!2d77.208022!3d28.632485!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x644e33bc3def0667!2sIndior+Tours+Pvt+Ltd.!5e0!3m2!1sen!2sus!4v1527779731123" width="100%" height="650px" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>

	<div class="contact-form">
		<h1 class="title">Contact Us</h1>
		<h2 class="subtitle">We are here assist you.</h2>
		@if( Session::has('message') )
		<div class="alert alert-warning alert-dismissible">
    <strong>{{ Session::get('message') }}</strong>.
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
		@endif
		
		<form action="{{url('/contactDetails')}}" method="post">
			@csrf
			<input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}"/>

			<input type="email" name="email" placeholder="Your E-mail Adress" value="{{old('email')}}" />

			<input type="number" name="phone" placeholder="Your Phone Number" value="{{old('phone')}}"/>

			
			<textarea name="message" id="" rows="8" placeholder="Your Message with minimun 50 word and maximum 500 word"  value="{{old('message')}}"></textarea>
		
			<button class="btn-send">Get a Call Back</button>
		</form>
	</div>
</div>


<!-- End product widget area -->
@endsection

@section('footer')
@include('layouts.footer')
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

