@php
	 $gallery_breed = App\Models\Navigation::find(2489);
	//  $gallery_breed = App\Models\Navigation::find(2489);
@endphp

@extends('layouts.master')
@push('title')
    {{ $gallery_breed->caption }}
@endpush
@section('content')
    <section id="pageCover" class="row aboutUs">
        <div class="row pageTitle">Gallery</div>
        <div class="row pageBreadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="#"> {{ $gallery_breed->caption }}</a></li>
                <li class="active">{{ $normal->caption ?? " " }}</li>
            </ol>
        </div>
    </section>

    <section class="gallery">
        <div class="container">
            <div class="gallery-view">
                <div class="row" id="lightgallery">
                    @foreach ($photos as $photo)
                        <div class="item col-md-4" data-src="/uploads/photo_gallery/{{ $photo->file }}"
                            data-sub-html="<h4>Blue Ocean</h4>">
                            <a href="">
                                <img src="/uploads/photo_gallery/{{ $photo->file }}" alt="Blue Ocean" />
                            </a>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </section>
@endsection
