@extends('layouts.master')
@push('title')
    Team
@endpush
@section('content')
    <section class="mt-120">
        <div class="container">
            <h3 class="h-sep theme-color">Our <span class="text-ultra-bold blue-color">Team</span></h3>
            <div class="divider_block clearfix">
                <hr class="divider first">
                <hr class="divider subheader_arrow">
                <hr class="divider last">
            </div>
        </div>
    </section>


    <section class="staff mb-50">
        <div class="container">
            <div class="row">
                @foreach ($teamsub as $teamsub_item)
                    <div class="col-md-3 col-md-offset-1 staff-member position-r text-center col-sm-6 mt-25">
                        {{-- <a href="#"></a> --}}
                        <img class="img-responsive" src="{{ $teamsub_item->banner_image }}" alt="">
                        <div class="staff-hover">
                            <ul class="staff-social list-inline">
                                <li><a target="_blank" href="{{ $teamsub_item->extra_one }}"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank" href="{{ $teamsub_item->extra_two }}"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="{{ $teamsub_item->extra_three }}"><i
                                            class="fa fa-linkedin"></i></a></li>
                            </ul>
                            <h6 class="blue-color text-bold text-uppercase"><a
                                    href="{{ route('team-details', $teamsub_item->nav_name) }}">{{ $teamsub_item->caption }}</a>
                            </h6>
                            <span
                                class=" mt-10 ubuntu black text-bold text-uppercase display-block fz-12">{!! $teamsub_item->short_content !!}</span>
                            <p class="black">{!! $teamsub_item->long_content !!}</p>
                        </div>
                        <div class="staff-overlay">
                            <h6 class="blue-color text-bold text-uppercase">{{ $teamsub_item->caption }}</h6>
                            <span
                                class=" mt-10 ubuntu black text-bold text-uppercase display-block fz-12">{!! $teamsub_item->short_content !!}</span>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection
