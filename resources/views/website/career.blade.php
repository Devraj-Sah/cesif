@extends('layouts.master')
@push('title')
    {{ $career->caption }}
@endpush
@section('content')
    <section class="mt-120">
        <div class="container">
            <h3 class="h-sep theme-color"> {{ $career->caption }}</h3>
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
                @foreach ($career_breed as $career_breed_item)
                    <div class="col-md-4 col-sm-6 r-event mt-25">
                        <div class="item">
                            <a href="{{ route('single_career', $career_breed_item->nav_name) }}">
                                <div class="monthly-img">
                                    <img src="{{ $career_breed_item->banner_image }}" alt="" class="img-responsive">
                                    <h5 class="martel text-semi-bold blue-color theme-color-hover fz-14 mt-10">
                                        {{ $career_breed_item->caption }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection
