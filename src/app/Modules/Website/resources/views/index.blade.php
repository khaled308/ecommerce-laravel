@extends('website::layouts.main')

@section('slider')
    @include('website::includes.slider')
@endsection

@section('content')
    <div class="wrap-banner style-twin-default">
        <div class="banner-item">
            <a href="#" class="link-banner banner-effect-1">
                <figure><img src="assets/images/home-1-banner-1.jpg" alt="" width="580" height="190"></figure>
            </a>
        </div>
        <div class="banner-item">
            <a href="#" class="link-banner banner-effect-1">
                <figure><img src="assets/images/home-1-banner-2.jpg" alt="" width="580" height="190"></figure>
            </a>
        </div>
    </div>

    <!--On Sale-->
    <div class="wrap-show-advance-info-box style-1 has-countdown">
        <h3 class="title-box">On Sale</h3>
        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
            @foreach ($productsOnSale as $product)
                <div class="product product-style-2 equal-elem ">
                    <div class="product-thumnail">
                        <a href="{{route('product.details', $product->slug)}}" title="{{$product->name}}">
                            <figure>
                                @php
                                    $image = $product->image;
                                    if (!file_exists($image)) {
                                        $image = 'uploads/' . $image;
                                    }
                                @endphp
                                <img src="{{$image}}" alt="{{$product->name}}" style="width: 250px; height: 250px;">
                            </figure>
                        </a>
                        <div class="group-flash">
                            <span class="flash-item sale-label">sale</span>
                        </div>
                        <div class="wrap-btn">
                            <a href="{{route('product.details', $product->slug)}}" class="function-link">quick view</a>
                        </div>
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-name"><span>{{$product->name}}</span></a>
                        <div class="wrap-price"><span class="product-price">${{$product->price}}</span></div>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>

    <!--Latest Products-->
    <div class="wrap-show-advance-info-box style-1">
        <h3 class="title-box">Latest Products</h3>
        <div class="wrap-top-banner">
            <a href="#" class="link-banner banner-effect-2">
                <figure><img src="assets/images/digital-electronic-banner.jpg" width="1170" height="240" alt=""></figure>
            </a>
        </div>
        <div class="wrap-products">
            <div class="wrap-product-tab tab-style-1">						
                <div class="tab-contents">
                    <div class="tab-content-item active" id="digital_1a">
                        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                            @foreach ($latestProducts as $product)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{route('product.details', $product->slug)}}" title="{{$product->name}}">
                                            <figure>
                                                @php
                                                    $image = $product->image;
                                                    if (!file_exists($image)) {
                                                        $image = 'uploads/' . $image;
                                                    }
                                                @endphp
                                                <img src="{{$image}}" alt="{{$product->name}}" style="width: 250px; height: 250px;">
                                            </figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">new</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="{{route('product.details', $product->slug)}}" class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{$product->name}}</span></a>
                                        <div class="wrap-price"><span class="product-price">${{$product->price}}</span></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>							
                </div>
            </div>
        </div>
    </div>

    <!--Product Categories-->
    <div class="wrap-show-advance-info-box style-1">
        <h3 class="title-box">Product Categories</h3>
        <div class="wrap-top-banner">
            <a href="#" class="link-banner banner-effect-2">
                <figure><img src="assets/images/fashion-accesories-banner.jpg" width="1170" height="240" alt=""></figure>
            </a>
        </div>
        <div class="wrap-products">
            <div class="wrap-product-tab tab-style-1">
                <div class="tab-control">
                    @foreach ($categories as $category)
                    @if ($category->products->count() != 0)
                        <a href="#{{$category->id}}" class="tab-control-item {{$loop->first ? 'active' : ''}}">{{$category->name}}</a>
                    @endif
                    @endforeach
                </div>
                <div class="tab-contents">
                    @foreach ($categories as $category)
                        @if ($category->products->count() != 0)
                            <div class="tab-content-item {{$loop->first ? 'active' : ''}}" id="{{$category->id}}">
                                <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                    @foreach ($category->products as $product)
                                        <div class="product product-style-2 equal-elem ">
                                            <div class="product-thumnail">
                                                <a href="{{route('product.details', $product->slug)}}" title="{{$product->name}}">
                                                    <figure>
                                                        @php
                                                            $image = $product->image;
                                                            if (!file_exists($image)) {
                                                                $image = 'uploads/' . $image;
                                                            }
                                                        @endphp
                                                        <img src="{{$image}}" alt="{{$product->name}}" style="width: 250px; height: 250px;">
                                                    </figure>
                                                </a>
                                                <div class="group-flash">
                                                    <span class="flash-item new-label">new</span>
                                                </div>
                                                <div class="wrap-btn">
                                                    <a href="{{route('product.details', $product->slug)}}" class="function-link">quick view</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a href="#" class="product-name"><span>{{$product->name}}</span></a>
                                                <div class="wrap-price"><span class="product-price">${{$product->price}}</span></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection