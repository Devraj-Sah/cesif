@php
$breed = App\Models\Navigation::find($job->parent_page_id);
$parent_breed = App\Models\Navigation::find($breed->parent_page_id);
@endphp


@extends('layouts.master')

@push('title')
   {{ $job->caption }}
@endpush


@section('content')
    <section id="pageCover" class="row aboutUs">
        <div class="row pageTitle">{{ $job->caption }}</div>
        <div class="row pageBreadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="#">{{ $parent_breed->caption }}</a></li>
                <li><a href="/{{ $parent_breed->nav_name }}/{{ $breed->nav_name }}">{{ $breed->caption }}</a></li>
                <li class="active">{{ $job->caption }}</li>
            </ol>
        </div>
    </section>

    <section class="job-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="job-content">
                        <h4>Job Title:{{ $job->caption }}</h4>
                        <table>
                            <tr>
                                <td>Company Name:</td>
                                <td>{{ $job->getJob->company_name }}</td>
                            </tr>
                            <tr>
                                <td>Country:</td>
                                <td>{{ $job->getJob->country }}</td>
                            </tr>
                            <tr>
                                <td>No. of Recruits:</td>
                                <td>{{ $job->getJob->no_of_recruits }}</td>
                            </tr>
                            <tr>
                                <td>Salary:</td>
                                <td>{{ $job->getJob->salary }}</td>
                            </tr>
                            <tr>
                                <td>Normal working hours:</td>
                                <td>{{ $job->getJob->no_working_hr }}</td>
                            </tr>

                            <tr>
                                <td>Period of Employment</td>
                                <td>{{ $job->getJob->contract_time }} years</td>
                            </tr>

                        </table>

                    </div>
                </div>
                <aside class="col-sm-4 sidebar">
                    <div class="main-content">
                        <div class="form-wrapper">
                            <h4>Apply Now</h4>
                            <form action="{{ route('contactstore') }}" method="POST"
                                class="theme-form-one form-validation" enctype='multipart/form-data'>
                                @csrf
                                <div class="col-12"><input type="text" placeholder="Full Name *" name="name"></div>
                                <div class="col-12"><input type="number" placeholder="Phone Number*" name="number"></div>
                                <div class="col-12"><input type="email" placeholder="Email *" name="email"></div>
                                <div class="col-12"><input type="text" placeholder="Applying For *" name="apply_for"
                                        value="{{ $job->caption }}"></div>
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
                </aside>
            </div>
        </div>
    </section>
@endsection
