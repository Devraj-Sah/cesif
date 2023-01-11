@php
    $global_setting = app\Models\GlobalSetting::all()->first();
    
@endphp


@extends('layouts.master')

@push('title')
    Contact
@endpush

@section('content')
    <section class="mt-120">
        <div class="container">
            <h3 class="h-sep theme-color">Contact <span class="text-ultra-bold blue-color">Us</span></h3>
            <div class="divider_block clearfix">
                <hr class="divider first">
                <hr class="divider subheader_arrow">
                <hr class="divider last">
            </div>
        </div>
    </section>
    <section class="mt-25 mb-50 contact-us">
        <div class="container">
            <p class="fz-16 gray-666">We’d love to hear from you and build out your next dream project. Drop us a line and
                we’ll get back to you as soon as we can!</p>
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <!-- <div class="mt-30" id="message"></div> -->
                    <form action="{{ route('contactstore') }}" method="POST" id="contactform_forms" class="checkout-form"
                        enctype='multipart/form-data'>
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mt-25"><input id="contact_name" type="text" name="name"
                                    class="form-control" placeholder="First name"></div>
                            <div class="col-md-6 mt-25"><input id="contact_email" type="email" name="email"
                                    class="form-control" placeholder="Email address" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-25"><input id="contact_phone" type="text" name="number"
                                    class="form-control" placeholder="Phone"></div>
                            <div class="col-md-6 mt-25"><input id="contact_website" type="text" name="apply_for"
                                    class="form-control" placeholder="Your website" ></div>
                        </div>
                        <textarea id="contact_message" rows="10" name="message" class="mt-25 form-control" placeholder="Write message"></textarea>
                        <div class="mt-25 submit">
                            <input type="submit" class="martel text-extra-bold text-uppercase fz-14" value="Send message" required>
                        </div>
                    </form>

                </div>
                <div class="col-md-3 col-md-offset-1 col-sm-4 mt-25">
                    <div class="contact-info clearfix">
                        <div class="pull-left">
                            <h5 class="fz-15 theme-color text-bold mb-10">Office Address</h5>
                            <span class="ubuntu fz-14 gray-777 lh-22"> {{ $global_setting->website_full_address }}
                                {{ $global_setting->address_ne }}</span>
                        </div>
                        <div class="contact-icon pull-right position-r">
                            <img src="/website/images/office.png" alt="">
                        </div>
                        <div class="clearfix"></div>
                        <hr class="c-border">
                    </div>
                    <div class="contact-info clearfix mt-20">
                        <div class="pull-left">
                            <h5 class="fz-15 theme-color text-bold mb-10">Phone</h5>
                            <span class="ubuntu fz-14 gray-777 lh-22">{{ $global_setting->phone }}
                                <br>{{ $global_setting->phone_ne }}
                            </span>
                        </div>
                        <div class="contact-icon pull-right position-r">
                            <img src="/website/images/phone.png" alt="">
                        </div>
                        <div class="clearfix"></div>
                        <hr class="c-border">
                    </div>
                    <div class="contact-info clearfix mt-20">
                        <div class="pull-left">
                            <h5 class="fz-15 theme-color text-bold mb-10">E-mail</h5>
                            <span class="ubuntu fz-14 gray-777 lh-22">{{ $global_setting->site_email }}</span>
                        </div>
                        <div class="contact-icon pull-right position-r">
                            <img src="/website/images/mail.png" alt="">
                        </div>
                        <div class="clearfix"></div>
                        <hr class="c-border">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
