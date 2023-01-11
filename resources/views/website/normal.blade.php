@extends('layouts.master')
@push('title')
    {{ $normal->caption }}
@endpush
@section('content')
    <section class="mt-120">
        <div class="container">
            <h3 class="h-sep theme-color"> {{ $normal->caption }}</h3>
            <div class="divider_block clearfix">
                <hr class="divider first">
                <hr class="divider subheader_arrow">
                <hr class="divider last">
            </div>
        </div>
    </section>

    <section class="mt-25 about-us-main mb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if ($normal->banner_image)
                        <img src="{{ $normal->banner_image }}" alt="banner_image">
                    @else
                    @endif

                    <h4 class="d-black lh-33 h-sep">{!! $normal->short_content !!}</h4>
                    <p class="lh-24 fz-16">{!! $normal->long_content !!}</p>
                </div>
                <div class="col-md-12 panels mt-25">
                    <div class="panel-group" id="accordion">

                        @foreach ($normal_sub as $normal_sub_item)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title clearfix"> <a class="fz-16 d-black" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapse{{ $normal_sub_item->id }} "
                                            aria-expanded="true"> <img src="img/bell.png"
                                                alt=""><span>{{ $normal_sub_item->caption }}</span> </a></h4>
                                </div>
                                <div id="collapse{{ $normal_sub_item->id }}" class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <p class="fz-15 lh-28"> {!! $normal_sub_item->short_content !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
