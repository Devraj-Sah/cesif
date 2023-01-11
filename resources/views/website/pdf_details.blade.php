  <!--<iframe src="/uploads/main_attachment/{{ $career_details->file }}{{ $career_details->main_attachment }}"-->-->
  <!--                  <allowfullscreen width="100%" height="100vh"></iframe>-->
  
  
  




@extends('layouts.master')
@push('title')
    {{ $career_details->caption }}
@endpush
@section('content')
   
    <section class="mt-120">
        <div class="container">
            <h3 class="h-sep theme-color"> {{ $career_details->caption }}</h3>
            <br>
            
        </div>
    </section>

    <section class="detail-page mt-30 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   
        
                     <iframe src="/uploads/main_attachment/{{ $career_details->file }}{{ $career_details->main_attachment }}"
                    allowfullscreen width="100%" height="1000px"></iframe>
                </div>
                
              
              




                
                
                
            </div>
        </div>
        
    </section>
    
@endsection
