


<div class="container-fluid no-padding">
    <div class="main-slider">
        @foreach ($sliders as $sliders_item)
            <div class="item">
                <div class="main-slider-img position-r">
                    <img src="{{ $sliders_item->banner_image }}" alt="">
                    <div class="overlay"></div>
                    <div class="main-slider-content slide-2 text-center">
                        <h3 class="white text-uppercase mt-25 position-r">{!! $sliders_item->short_content !!}</h3>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
