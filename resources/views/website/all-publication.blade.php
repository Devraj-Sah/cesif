@extends('layouts.master')
@push('title')
    {{ $publication_parent->caption }}
@endpush
@section('content')
    <section class="mt-120">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    <h3 class="h-sep theme-color"> {{ $publication_parent->caption }}</h3>
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
                @foreach ($publication_parent_sub as $publication_parent_subitem)
                    <div class="col-md-4 r-event mt-25">
                        <div class="item">
                            <a href="@if ($publication_parent_subitem->page_type == "Group")/{{$slug1}}/{{$publication_parent_subitem->nav_name}}@else{{ route('single_career', $publication_parent_subitem->nav_name) }}@endif ">
                                <div class="monthly-img text-center">
                                    @if ($publication_parent_subitem->banner_image)
                                        <img src="{{ $publication_parent_subitem->banner_image }}" alt=""
                                            class="img-responsive">
                                    @else
                                        <img src="/website/images/default-publication.jpg" alt=""
                                            class="img-responsive">
                                    @endif

                                    {{-- <a href="{{ route('single_career', $publication_parent_subitem->nav_name) }}"> --}}
                                        <h5 class="martel text-semi-bold d-black mt-10">                                        
                                            {{ Str::limit($publication_parent_subitem->caption, 50) }}        
                                        </h5>
                                    {{-- </a> --}}


                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach


            </div>
            {{-- <div class="bp-btns mt-50 text-center">
                <a href="#"><i class="fa fa-caret-left"></i> Previous</a>
                <a href="#">Next <i class="fa fa-caret-right"></i></a>
            </div> --}}
        </div>
    </section>
@endsection
