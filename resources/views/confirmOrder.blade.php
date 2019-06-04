@extends('welcome')

@push('css')
@include( 'layouts.resource' )
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">  
 </script> 
<script type="text/javascript">
	$(window).on('load', function(){
		$("#paypal-button-container").css('width', '35%');
	});
</script>
@endpush

@section('header')
@include('layouts.header')
@endsection
@section('body')
<div class="container">
    <div class="row">
        <div class="well">
            <div class="row">
                <form action="{{ url('/paytmpayment') }}" method="post" name="payment">
                    @csrf
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <input type="hidden" name="address" value="{{$details['address']}} {{$details['city']}} {{ $details['state'] }} {{ $details['postcode'] }}">
                        <strong>{{$details['address']}}</strong>
                        <br>
                        {{Ucfirst($details['city'])}}
                        <br>
                        {{Ucfirst($details['state'])}} {{$details['postcode']}}
                        <br>
                        <input type="hidden" name="phone" value="{{ $phoneNo }}">
                        <abbr title="Phone">P:</abbr> {{ $phoneNo }}
                    </address>
                </div>
               <!--  <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: 1st November, 2013</em>
                    </p>
                    <p>
                        <input type="hidden" name="recept_no    " value="">
                        <em>Receipt #: 34522677W</em>
                    </p>
                </div> -->
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspQuantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( isset( $cardData ) )
                        @foreach( $cardData as $key => $value)
                           
                            <input type="hidden" name="product_name[]" value="{{ $value['product'] }}">
                            <input type="hidden" name="price[]" value="{{ $value['total'] }}">
                            <input type="hidden" name="quantity[]" value="{{ $value['product_quantity'] }}">
                            <!-- <input type="hidden" name="price[]" value="{{$tprice}}"> -->
                            <input type="hidden" name="id[]" value="{{ $value['id'] }}">
                        <tr>                           
                            <td class="col-md-9"><em></em>{{ $value['product'] }}</h4></td>
                            <td class="col-md-1" style="text-align: center"> {{ $value['product_quantity'] }} </td>
                            <td class="col-md-1 text-center">{{ $value['price'] }}</td>
                            <td class="col-md-1 text-center">{{ $value['total'] }}</td>
                        </tr>
                       @endforeach
                       @endif
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <input type="hidden" name="total" value="{{$tprice}}">
                            <td class="text-center text-danger"><h4><strong>{{ $tprice }}</strong></h4></td>
                        </tr>
                        <tr>
                        	<td><div id="paypal-button-container"></div> </td>
                        	<td style="width:20%"><a href="#" alt="paytm payment" class="paytm_payment"><img src="{{asset('img/paytm_logo.png')}}" ></a></td>
                        </tr>
                    </tbody>
                </table>
                </td>
            </div>
        </div>
    </div>

@endsection

