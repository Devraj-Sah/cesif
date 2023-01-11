@php
    $all_nav_data = App\Models\Navigation::query()
        ->orWhere('page_type', 'Monthly Analysis')
        ->orderBy('page_title', 'desc')
        ->where('page_status', '1')
        ->get();
    
    $all_nav = [];
    $commentaries = App\Models\Navigation::query()
        ->where('page_type', 'Monthly Analysis')
        // ->orderBy('created_at', 'desc')
        ->get();
    
    foreach ($commentaries as $index => $value) {
        $p = $value;
        $all_nav[$p->page_title] = $p;
    }
    
@endphp


<div class="section-block projects monthly-analysis">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="text-uppercase theme-color h-sep">Monthly<span class="text-ultra-bold blue-color">
                        Analysis</span> </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <div class="monthly-analysis-slider mt-30">
                    @foreach ($all_nav as $date_item)
                        <a href="javascript:" data-filter=".{{ $date_item->page_title }}"
                            class="filter ubuntu text-medium">
                            {{ date('F-Y', strtotime($date_item->page_title)) }}
                        </a>
                    @endforeach


                </div>
            </div>
        </div>
        <div id="Container" class="mt-25">

            @php
                $ibc = $all_nav_data->first()->page_title;
            @endphp


            <div id="Container" class="mt-25">
                <div class="row  ">
                    @foreach ($all_nav_data as $index => $monthly_analysisitems)
                        <div
                            class="col-md-4 col-sm-6 mix {{ $monthly_analysisitems->page_title }} @if($ibc == $monthly_analysisitems->page_title)  active  @endif" >

                            <div class="monthly-analysis-item" >
                                <a href="{{ route('single_career', $monthly_analysisitems->nav_name) }}"></a>
                                <div class="monthly-img text-center">
                                    <img src="{{ $monthly_analysisitems->banner_image }}" alt=""
                                        class="img-responsive">
                                    <h5 class="martel text-semi-bold d-black">{{ $monthly_analysisitems->caption }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
            {{-- @endforeach --}}


        </div>
        {{-- @endforeach --}}


    </div>
</div>
</div>
