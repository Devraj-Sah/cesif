@extends('layouts.master')
@push('title')
    Apply Form
@endpush
@section('content')
    <section id="pageCover" class="row aboutUs">
        <div class="row pageTitle">Apply Now</div>
        <div class="row pageBreadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Apply Now</li>
            </ol>
        </div>
    </section>

    <section class="apply-form">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="main-content">
                        <div class="form-wrapper">
                            <h4>Apply Now</h4>
                            <form action="{{ route('contactstore') }}" method="POST" class="theme-form-one form-validation" enctype='multipart/form-data'>
								@csrf
                                <div class="col-12"><input type="text" placeholder="Full Name *" name="name"></div>
                                <div class="col-12"><input type="text" placeholder="Phone Number*" name="number"></div>
                                <div class="col-12"><input type="email" placeholder="Email *" name="email"></div>
                                <div class="col-12"><input type="text" placeholder="Applying For *" name="apply_for"></div>
                                <div class="col-12">
                                    <label>Your CV</label>
                                    <input type="file" class="form-control file-upload">
                                </div>
                                <div class="col-12">
                                    <textarea placeholder="If any Question..." name="message"></textarea>
                                </div>
                                <button class="theme-button-one">Submit</button>
                            </form>
                        </div> <!-- /.form-wrapper -->
                    </div> <!-- /.col- -->
                </div>
            </div>
        </div>
    </section>
@endsection
