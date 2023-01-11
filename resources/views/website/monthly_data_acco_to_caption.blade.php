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
    
    $select_data = App\Models\Navigation::find(2613)->childs;
    
@endphp



@extends('layouts.master')
@push('title')
    {{ $monthly_dates_parent->caption }}
@endpush
@section('content')
    <section class="mt-120">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h3 class="h-sep theme-color"> {{ $monthly_dates_parent->caption }} Monthly Analysis</h3>
                </div>
                <div class="col-md-3">
                    <div class="s-archive">
                        <div class="input-group">
                            <select name="archive" id="archive" onchange="javascript:handleSelect(this)">
                                <option value="#">Archives</option>
                                @foreach ($select_data as $mainitem)
                                    <option value="{{ $mainitem->nav_name }}">
                                        {{ $mainitem->caption }}
                                    </option>
                                @endforeach
                            </select>

                            <script type="text/javascript">
                                function handleSelect(elm) {
                                    window.location = "/monthly_all/" + elm.value;
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

    <section class="projects themetic-area">
        <div class="container">
            <div id="Container">
                @foreach ($monthly_dates as $mainitem)
                    <div class="col-md-4 r-event mt-25">
                        <img src="{{ $mainitem->banner_image }}" alt="" class="img-responsive">
                        <h4 class="mt-20 fz-15 text-semi-bold d-black">
                            {{ Str::limit($mainitem->caption, 40) }}
                        </h4>
                        @if ($mainitem->page_keyword)
                            <h5 class="ubuntu fz-12 theme-color mt-10 r-divider">Date: <span class="blue-color">
                                    {{ $mainitem->page_keyword }}
                                </span>
                            @else
                        @endif
                        @if ($mainitem->icon_image_caption)
                            <span class="sep-space"> |</span> Posted by: <span
                                class="blue-color">{{ $mainitem->icon_image_caption }}</span>
                        @else
                        @endif
                        </h5>
                        <p class="lh-26 mt-20">
                            {!! Str::limit($mainitem->short_content, 100) !!}
                        </p>
                        <div class="mt-20">
                            <a href="{{ route('single_career', $mainitem->nav_name) }}" class="btn-green-br">Read
                                More</a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection


@section('custom_js')
    <script src="/website/js/jquery.mixitup1.js"></script>
@endsection
