@extends('layouts.master')
@push('title')
    Photo Gallery
@endpush
@section('content')
    <section id="pageCover" class="row aboutUs">
        <div class="row pageTitle">Photo Gallery</div>
        <div class="row pageBreadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Photo Gallery</li>
            </ol>
        </div>
    </section>

    <section class="gallery">
        <div class="container">
            <div class="row">



                @foreach ($photos as $photo)
                    <div class="col-md-4 col-sm-12">
                        <a href="{{ route('galleryview', $photo->nav_name) }}">
                            <div class="folder">
                                <div class="paper folder-pop"><img src="{{ $photo->banner_image }}" width="100%"></div>
                                <div class="paper folder-pop-middle"><img src="{{ $photo->banner_image }}" width="100%">
                                </div>
                                <div class="paper folder-pop-last"><img src="{{ $photo->banner_image }}" width="100%">
                                </div>
                            </div>
                            <h5 class="folder-text">{{ $photo->caption }}</h5>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
