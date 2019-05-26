@extends('layouts.app')

@push('css')
@include('layouts.resource')
@endpush

@section('header')
@include('layouts.header')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
        </div>
    </div>
</div>
@endsection

@section('footer')
@include('layouts.footer')
@endsection

@push('js')
<script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.sticky.js')}}"></script>
    
    <!-- jQuery easing -->
    <script src="{{asset('js/jquery.easing.1.3.min.js')}}"></script>
    
    <!-- Main Script -->
    <script src="{{asset('js/main.js')}}"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="{{asset('js/bxslider.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/script.slider.js')}}"></script>
  @endpush  
