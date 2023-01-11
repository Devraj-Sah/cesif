@extends('layouts.master')
@push('title')
   {{ $career_details->caption }}
@endpush
@section('content')
    <section class="mt-120">
        <div class="container">
            <h3 class="h-sep theme-color">{{ $career_details->caption }}</h3>
            <div class="divider_block clearfix">
                <hr class="divider first">
                <hr class="divider subheader_arrow">
                <hr class="divider last">
            </div>
        </div>
    </section>


    <section class="staff mb-50">
        <div class="container">
            <div class="row mt-25">
                <div class="col-md-3 col-sm-offset-1 col-sm-4">
                    <div class="individual-staff-profile">
                        <img class="img-responsive" src="{{ $career_details->banner_image }}" alt="Vijay Kanta Karna">
                    </div>
                </div>
                <div class="col-md-7 col-sm-7">
                    <div class="individual-staff">
                        <h4 class="theme-color text-bold text-uppercase">{{ $career_details->caption }}</h4>
                        {{-- <br> --}}
                        <h6 style="color: black; margin: 15px 0px 11px 4px;" class="theme-color text-bold text-uppercase">
                            {!! $career_details->short_content !!}</h6>
                        <span style="font-size: 16px;line-height: 24px;font-weight: 500;">{!! $career_details->long_content !!}
                            </p>
                            <ul class="staff-social list-inline mt-25">
                                <li><a target="_blank" href="{{ $career_details->extra_one }}"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank" href="{{ $career_details->extra_two }}"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="{{ $career_details->extra_three }}"><i
                                            class="fa fa-linkedin"></i></a></li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
