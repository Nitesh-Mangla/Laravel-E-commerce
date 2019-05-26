@extends('welcome')
@push('css')
@include('layouts.resource');
@endpush

@section('header')
@include('layouts.header')
@endsection

@section('body')

     
<div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./">Mangla Store</a></h1>
                    </div>
                </div>
                
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('shop')}}">Shop page</a></li>
                        <li><a href="{{url('card')}}">Cart</a></li>
                        @auth
                        <li><a href="{{url('checkout')}}">Checkout</a></li>
                        @endauth
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Others</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
    <div class="slider-area">
            <!-- Slider -->
            <div class="block-slider block-slider4">
                <ul class="" id="bxslider-home4">
                    <li>
                        <img src="img/h4-slide.png" alt="Slide">
                        <div class="caption-group">
                            <h2 class="caption title">
                                iPhone <span class="primary">6 <strong>Plus</strong></span>
                            </h2>
                            <h4 class="caption subtitle">Dual SIM</h4>
                            <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                        </div>
                    </li>
                    <li><img src="img/h4-slide2.png" alt="Slide">
                        <div class="caption-group">
                            <h2 class="caption title">
                                by one, get one <span class="primary">50% <strong>off</strong></span>
                            </h2>
                            <h4 class="caption subtitle">school supplies & backpacks.*</h4>
                            <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                        </div>
                    </li>
                    <li><img src="img/h4-slide3.png" alt="Slide">
                        <div class="caption-group">
                            <h2 class="caption title">
                                Apple <span class="primary">Store <strong>Ipod</strong></span>
                            </h2>
                            <h4 class="caption subtitle">Select Item</h4>
                            <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                        </div>
                    </li>
                    <li><img src="img/h4-slide4.png" alt="Slide">
                        <div class="caption-group">
                          <h2 class="caption title">
                                Apple <span class="primary">Store <strong>Ipod</strong></span>
                            </h2>
                            <h4 class="caption subtitle">& Phone</h4>
                            <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- ./Slider -->
    </div> <!-- End slider area -->
    
    
    
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                            @if( isset($products) )
                            @for( $i=0; $i<$size; $i++ )
                            
                                <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/{{$products[$i]->image }}" alt="">
                                    <div class="product-hover">
                                        <a href="{{ url('card') }}?id={{ $products[$i]->id }}" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="{{ url('singleproduct') }}?id={{ $products[$i]->id }}" class="view-details-link" ><i class="fa fa-link" ></i> See details</a>
                                    </div>
                                </div>
                                
                                <h2><a href="single-product.html">{{ $products[$i]->type }}</a></h2>
                                
                                <div class="product-carousel-price">
                                    <ins>${{ $products[$i]->price }}.00</ins> <del>${{ $products[$i]->discount }}.00</del>
                                </div> 
                            </div>
                          
                                @endfor
                             @endif  
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    
    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <img src="img/brand1.png" alt="">
                            <img src="img/brand2.png" alt="">
                            <img src="img/brand3.png" alt="">
                            <img src="img/brand4.png" alt="">
                            <img src="img/brand5.png" alt="">
                            <img src="img/brand6.png" alt="">
                            <img src="img/brand1.png" alt="">
                            <img src="img/brand2.png" alt="">                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->
    
    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top Sellers</h2>
                        <a href="" class="wid-view-more">View All</a>
                         @if( isset($products) )
                            @for( $i=0; $i<3; $i++ )
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/{{$products[$i]->image }}" alt="" class="product-thumb"></a>
                            <h2><a href="{{url('singleproduct')}}?id={{$products[$i]->id}}">{{$products[$i]->product_name }}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>${{$products[$i]->price }}</ins> <del>${{$products[$i]->discount }}</del>
                            </div>                            
                        </div>
                        @endfor
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Recently Viewed</h2>
                        <a href="#" class="wid-view-more">View All</a>
                         @if( isset($products) )
                            @for( $i=3; $i<6; $i++ )
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/{{$products[$i]->image }}" alt="" class="product-thumb"></a>
                             <h2><a href="{{url('singleproduct')}}?id={{$products[$i]->id}}">{{$products[$i]->product_name }}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>${{$products[$i]->price }}</ins> <del>${{$products[$i]->discount }}</del>
                            </div>                            
                        </div>
                       @endfor
                       @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top New</h2>
                        <a href="#" class="wid-view-more">View All</a>
                          @if( isset($products) )
                            @for( $i=6; $i<9; $i++ )
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/{{$products[$i]->image }}" alt="" class="product-thumb"></a>
                             <h2><a href="{{url('singleproduct')}}?id={{$products[$i]->id}}">{{$products[$i]->product_name }}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>${{$products[$i]->price }}</ins> <del>${{$products[$i]->discount }}</del>
                            </div>                            
                        </div>
                          @endfor
                       @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End product widget area -->
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

