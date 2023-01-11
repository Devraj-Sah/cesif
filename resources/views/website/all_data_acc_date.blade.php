@php
    $all_nav = [];
    $commentaries = App\Models\Navigation::query()
    
        ->orWhere('page_type', 'Monthly Analysis')
        ->orWhere('page_type', 'Commentaries')
        ->orWhere('page_type', 'News Digest')
        ->orWhere('page_type', 'Proceeding Report')
        ->orWhere('page_type', 'Research Reports')
        ->orWhere('page_type', 'Publication')
        ->orderBy('page_title', 'desc')
        ->get();
    
    foreach ($commentaries as $index => $value) {
        $p = $value;
    
        $all_nav[$p->page_title] = $p;
    }
@endphp


@extends('layouts.master')
@push('title')
    {{ date('F-Y', strtotime($dates_title->page_title ?? "All Data" )) }}
@endpush
@section('content')
    <section class="mt-120">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    <h3 class="h-sep theme-color">
                        {{ date('F-Y', strtotime($dates_title->page_title ?? "data")) }}

                    </h3>
                </div>
                <div class="col-md-3">
                    <div class="s-archive">
                        <div class="input-group">
                            <select name="archive" id="archive" onchange="javascript:handleSelect(this)">
                                <option value="#">Archives</option>
                                @foreach ($all_nav as $mainitem)
                                    @if ($mainitem->page_title)
                                        <option value="{{ $mainitem->page_title }}">
                                            {{ date('F-Y', strtotime($mainitem->page_title)) }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            <script type="text/javascript">
                                function handleSelect(elm) {
                                    window.location = "/all-data/" + elm.value;
                                }
                            </script>

                            <div class="input-group-addon gray-777"> <button><i class="fa fa-search"></i></button></div>
                        </div>
                    </div>
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

                @foreach ($dates as $dates_item)
                    <div class="col-md-4 col-sm-6 r-event mt-25 dates_allImg">
                        <img src="{{ $dates_item->banner_image }}" alt="" class="img-responsive">

                        <h4 class="mt-20 fz-15 text-semi-bold d-black">
                            {{ Str::limit($dates_item->caption, 40) }}
                        </h4>
                        <h5 class="ubuntu fz-12 theme-color mt-10 r-divider">Date: <span
                                class="blue-color">{{ $dates_item->page_keyword }}</span>
                            @if ($dates_item->icon_image_caption)
                                <span class="sep-space"> |</span> Posted by: <span
                                    class="blue-color">{{ $dates_item->icon_image_caption }}</span>
                            @else
                            @endif

                        </h5>


                        <p class="lh-26 mt-20">
                            {!! Str::limit($dates_item->short_content, 100) !!}
                        </p>




                        <div class="mt-20">
                            <a href="{{ route('single_career', $dates_item->nav_name) }}" class="btn-green-br">Read More</a>
                        </div>
                    </div>
                @endforeach




            </div>
            <div class="bp-btns mt-50 text-center">


                @if ($dates->hasPages())
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            @if ($dates->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fa fa-caret-left"></i>
                                        Previous</a>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $dates->previousPageUrl() }}"><i
                                            class="fa fa-caret-left"></i> Previous</a></li>
                            @endif

                            @foreach ($dates as $element)
                                @if (is_string($element))
                                    <li class="page-item disabled">{{ $element }}</li>
                                @endif
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $dates->currentPage())
                                            <li class="page-item active">
                                                <a class="page-link">{{ $page }}</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            @if ($dates->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $dates->nextPageUrl() }}" rel="next">Next <i
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
@endsection
