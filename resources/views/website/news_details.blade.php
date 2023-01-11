@extends('layouts.master')
@push('title')
   {{ $normal->caption }}
@endpush
@section('content')
    <section id="pageCover" class="row aboutUs">
        <div class="row pageTitle">{{ $normal->caption }}</div>
        <div class="row pageBreadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>

                <li class="active">{{ $normal->caption }}</li>
            </ol>
        </div>
    </section>




    <section id="aboutus" class="row">
        <div class="container">
            <div class="row">

                <div class=" col-sm-12">
                    <div class="row aboutContent">
                        <div class="row aboutUsTexts m0 member">
                            <div class="fleft textsPart">
                                <h2>{!! $normal->short_content !!}</h2>
                                <p>{!! $normal->long_content !!}</p>
                            </div>
                            <div class="fleft aboutImg">
                                <img src="{{ $normal->banner_image }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
