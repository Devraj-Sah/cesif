<div class="section-block recent-causes gray-f9f9-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="text-uppercase theme-color h-sep"><span class="text-ultra-bold blue-color"> Commentaries</span>
                </h3>
            </div>
        </div>
        <div class="row mt-50">
            <div class="col-md-12">
                <div class="causes commentaries_image">
                    @foreach ($home_commentaries as $home_commentaries_item)
                        <div class="item">
                            <div class="causes-img text-center">
                                <a href="{{ route('single_career', $home_commentaries_item->nav_name) }}">
                                    @if ($home_commentaries_item->banner_image)
                                        <img src="{{ $home_commentaries_item->banner_image }}" alt=""
                                            class="img-responsive">
                                    @else
                                        <img src="/website/images/news-default.jpg" alt=""
                                            class="img-responsive">
                                    @endif

                                </a>
                            </div>
                          
                            <div class="cause-content">
                                <h5 class="martel text-semi-bold d-black">

                                    {{ Str::limit($home_commentaries_item->caption, 30) }}
                                  </h5>
                                <p class="lh-22 mt-10"> {{ Str::limit($home_commentaries_item->short_content, 80) }}</p>
                                   <br>
                                <p> Posted by: <span style="color: #F37C7A"> {{ $home_commentaries_item->icon_image_caption }}</span></p>

                                <a class="fz-14 mt-10 btn-green-br" href="{{ route('single_career', $home_commentaries_item->nav_name) }}" target="_blank">Read More</a>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
