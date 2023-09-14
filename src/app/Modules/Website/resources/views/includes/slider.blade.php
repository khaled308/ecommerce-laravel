<div class="wrap-main-slide">
    <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
        @foreach ($sliders as $item)    
            <div class="item-slide">
                <img src="{{$item->image}}" alt="" class="img-slide">
                <div class="slide-info slide-1">
                    <h2 class="f-title">{{$item->title}}</h2>
                    <span class="subtitle">{{$item->subtitle}}</span>
                    <p class="sale-info"><b>${{$item->price}}</b></p>
                    <a href="{{$item->link}}" class="btn-link">Shop Now</a>
                </div>
            </div>
        @endforeach
    </div>
</div>