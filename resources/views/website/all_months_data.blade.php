@php
    $all_nav_data = App\Models\Navigation::query()
        ->orWhere('page_type', 'Monthly Analysis')
        ->orWhere('page_type', 'Commentaries')
        ->orWhere('page_type', 'News Digest')
        ->orWhere('page_type', 'Proceeding Report')
        ->orWhere('page_type', 'Research Reports')
        ->orWhere('page_type', 'Publication')
        ->orderBy('page_title', 'desc')
        ->paginate(12);
    // ->get();
    
    $select_data = App\Models\Navigation::find(2613)->childs;
    
    $all_monthly_data = App\Models\Navigation::query()
        ->orWhere('page_type', 'Monthly Analysis')
        ->paginate(12);
    
@endphp





@extends('layouts.master')
@push('title')
    {{ $page_type }}
@endpush
@section('content')

    @if ($page_type == 'Monthly Analysis')
        {{-- monthly analysis --}}

        <section class="mt-120">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="h-sep theme-color"> {{ $page_type }}</h3>
                    </div>

                </div>
                <div class="divider_block clearfix">
                    <hr class="divider first">
                    <hr class="divider subheader_arrow">
                    <hr class="divider last">
                </div>
            </div>
        </section>



        <section class="projects themetic-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="p-filter-nav monthly_data_analysis" >
                            <a href="javascript:" data-filter="all" class="filter">All</a>
                            @foreach ($select_data as $themic_parent_sub_item)
                                <a href="javascript:" data-filter=".{{ $themic_parent_sub_item->id }}" class="filter">
                                    {{ $themic_parent_sub_item->caption }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div id="Container">
                    @foreach ($select_data as $mainitem)
                        <div class="row  mix {{ $mainitem->id }}">
                            @foreach ($mainitem->childs as $mainitem_itemitem)
                                @if ($mainitem_itemitem->caption == 'Monthly Analysis')
                                    @foreach ($mainitem_itemitem->childs as $item)
                                        <div class="col-md-4 r-event mt-25 ">
                                            <img src="{{ $item->banner_image }}" alt="" class="img-responsive">
                                            <h4 class="mt-20 fz-15 text-semi-bold d-black">
                                                {{ Str::limit($item->caption, 40) }}
                                            </h4>
                                            @if ($item->page_keyword)
                                                <h5 class="ubuntu fz-12 theme-color mt-10 r-divider">Date: <span
                                                        class="blue-color">
                                                        {{ $item->page_keyword }}
                                                    </span>
                                                @else
                                            @endif
                                            @if ($item->icon_image_caption)
                                                <span class="sep-space"> |</span> Posted by: <span
                                                    class="blue-color">{{ $item->icon_image_caption }}</span>
                                            @else
                                            @endif
                                            </h5>
                                            <p class="lh-26 mt-20">
                                                {!! Str::limit($item->short_content, 100) !!}
                                            </p>
                                            <div class="mt-20">
                                                <a href="{{ route('single_career', $item->nav_name) }}"
                                                    class="btn-green-br">Read
                                                    More</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
        </section>










        {{-- not monthly analysis --}}
    @else
        <section class="mt-120">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-9">
                        <h3 class="h-sep theme-color"> {{ $page_type }}
                        </h3>
                    </div>

                </div>
                <div class="divider_block clearfix">
                    <hr class="divider first">
                    <hr class="divider subheader_arrow">
                    <hr class="divider last">
                </div>
            </div>
        </section>




        <section class="mb-50">
            <div class="container">
                <div class="row">
                    @foreach ($allData as $allData_item)
                        <div class="col-md-4 r-event mt-25 dates_allImg">
                            <img src="{{ $allData_item->banner_image }}" alt="" class="img-responsive">
                            <h4 class="mt-20 fz-15 text-semi-bold d-black">


                                {{ Str::limit($allData_item->caption, 40) }}


                            </h4>
                            @if ($allData_item->page_keyword)
                                <h5 class="ubuntu fz-12 theme-color mt-10 r-divider">Date: <span class="blue-color">
                                        {{ $allData_item->page_keyword }}
                                    </span>
                                @else
                            @endif


                            @if ($allData_item->icon_image_caption)
                                <span class="sep-space"> |</span> Posted by: <span
                                    class="blue-color">{{ $allData_item->icon_image_caption }}</span>
                            @else
                            @endif
                            </h5>
                            <p class="lh-26 mt-20">{!! Str::limit($allData_item->short_content, 100) !!}</p>
                            <div class="mt-20">
                                <a href="{{ route('single_career', $allData_item->nav_name) }}" class="btn-green-br">Read
                                    More</a>
                            </div>
                        </div>
                    @endforeach


                </div>



                <div class="bp-btns mt-50 text-center">
                    @if ($allData->hasPages())
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                @if ($allData->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"><i class="fa fa-caret-left"></i>
                                            Previous</a>
                                    </li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $allData->previousPageUrl() }}"><i
                                                class="fa fa-caret-left"></i>
                                            Previous</a></li>
                                @endif

                                @foreach ($allData as $element)
                                    @if (is_string($element))
                                        <li class="page-item disabled">{{ $element }}</li>
                                    @endif
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $allData->currentPage())
                                                <li class="page-item active">
                                                    <a class="page-link">{{ $page }}</a>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                @if ($allData->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $allData->nextPageUrl() }}" rel="next">Next <i
                                                class="fa fa-caret-right"></i></a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">Next <i class="fa fa-caret-right"></i></a>
                                    </li>
                                @endif
                            </ul>
                    @endif

                </div>

            </div>
        </section>
    @endif




@endsection


@section('custom_js')
    <script src="/website/js/jquery.mixitup1.js"></script>
@endsection
