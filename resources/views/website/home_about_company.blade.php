@php
    $about_path = App\Models\Navigation::find(2625);
    $about_path_parent = App\Models\Navigation::find($about_path->parent_page_id);
@endphp

<div class="main-layout">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               
                <div class="section-block publiction mb-50">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3  style="margin-top:30px;" class="text-uppercase theme-color h-sep">Recent <span
                                    class="text-ultra-bold blue-color">Publications</span> </h3>
                        </div>
                    </div>
                    {{-- default-publication.jpg --}}
                    <div class="row mt-50">
                      
                            <div class="publication-sliderE">
                                @foreach ($home_publication as $home_publication_item)
                                        <div class="col-lg-4 col-md-4">
                                            
                                            <div class="item">
                                        <a href="{{ route('single_career', $home_publication_item->nav_name) }}">
                                            <div class="publication-img text-center">
                                                @if ($home_publication_item->banner_image)
                                                    <img src="{{ $home_publication_item->banner_image }}" alt=""
                                                        class="img-responsive" style="object-fit: unset">
                                                @else
                                                    <img src="/website/images/default-publication.jpg" alt=""
                                                        class="img-responsive">
                                                @endif
                                                <a
                                                    href="{{ route('single_career', $home_publication_item->nav_name) }}">

                                                    <h5 style="margin-bottom: 20px; font-size: 13px;" class="martel text-semi-bold d-black mt-10">


                                                        {{-- {{ Str::limit($home_publication_item->caption, 10) }} --}}
                                                        {{ $home_publication_item->caption }}

                                                    </h5>
                                                  
                                                </a>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                      
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-4 sidebar-main">
                <div class="mt-50 box-shadow news-event">
                    <h4 class=" theme-color h-sep mb-30">NEWS / <span class="text-ultra-bold blue-color">EVENTS</span>
                    </h4>
                    <div class="scrollbar-custom">

                        @foreach ($home_news as $home_News_item)
                            <div class="s-post mb-20 pb-20 clearfix">
                                <a href="{{ route('single_career', $home_News_item->nav_name) }}">
                                    @if ($home_News_item->banner_image)
                                        <img src="{{ $home_News_item->banner_image }}" alt=""
                                            class="pull-left img-responsive">
                                    @else
                                        <img src="images/news-1.jpg" alt="" class="pull-left img-responsive">
                                    @endif

                                    <div class="pull-left s-post-detail">
                                        <h6 class="fz-13 black-23 lh-20 mb-10">


                                            {!! Str::limit($home_News_item->caption, 40) !!}


                                        </h6>
                                        <span class="ubuntu fz-13 theme-color">
                                            @if ($home_News_item->page_keyword)
                                                <i class="fa fa-calendar"></i> {{ $home_News_item->page_keyword }}
                                        </span>
                                    @else
                        @endif


                    </div>
                    </a>
                </div>
                @endforeach



            </div>
        </div>
        <div class="mt-10 twitter">
            <a class="twitter-timeline" height="300" href="https://twitter.com/CsifNepal?ref_src=twsrc%5Etfw">Tweets
                by CsifNepal</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </div>
</div>
</div>
</div>
