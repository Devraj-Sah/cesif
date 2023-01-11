@php
    $global_setting = app\Models\GlobalSetting::all()->first();
    $normal_gallary_notice = app\Models\Navigation::query()
        ->where('nav_category', 'Main')
        ->where('page_type', '!=', 'Job')
        ->where('page_type', '!=', 'Photo Gallery')
        ->where('page_type', '!=', 'Notice')
        ->where('parent_page_id', 0)
        ->where('page_status', '1')
        ->orderBy('position', 'ASC')
        ->get();
    if (isset($normal)) {
        $seo = $normal;
    } elseif (isset($job)) {
        $seo = $job;
    }
    
    $father = [];
    $commentaries = App\Models\Navigation::query()
        ->where('page_type', 'Commentaries')
        ->orWhere('page_type', 'Monthly Analysis')
        ->get();
       
    // return $commentaries;
    foreach ($commentaries as $index => $value) {
        $p = $value->parents;
    
        $father[$p->caption] = $p;
    }
    
@endphp


{{-- @dd($father) --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <!-----SEO--------->

    <title> @stack('title') | {{ $seo->page_titile ?? $global_setting->page_title }}</title>
    <meta name="title" content="{{ $seo->page_titile ?? $global_setting->page_title }}">
    <meta name="description" content="{{ $seo->page_description ?? $global_setting->page_description }}">
    <meta name="keywords" content="{{ $seo->page_keyword ?? $global_setting->page_keyword }}">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="1 days">
    <meta name="author" content="{{ $global_setting->site_name ?? '' }}">


    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $global_setting->website_full_address ?? '' }}">
    <meta property="og:title" content="{{ $seo->page_title ?? $global_setting->page_title }}">
    <meta property="og:description" content="{{ $seo->page_description ?? $global_setting->page_description }}">
    <meta property="og:image" content="{{ $seo->banner_image ?? '/uploads/icons/' . $global_setting->site_logo }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ $global_setting->website_full_address ?? '' }}">
    <meta property="twitter:title" content="{{ $seo->page_title ?? $global_setting->page_title }}">
    <meta property="twitter:description" content="{{ $seo->page_description ?? $global_setting->page_description }}">
    <meta property="twitter:image"
        content="{{ $seo->banner_image ?? '/uploads/icons/' . $global_setting->site_logo }}">



    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ '/uploads/icons/' . $global_setting->favicon }}" type="image/png">




    <link rel="apple-touch-icon" href="/website/img/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="/website/css/bootstrap.css">
    <link rel="stylesheet" href="/website/css/font-awesome.min.css">
    <link rel="stylesheet" href="/website/css/owl.carousel.css">
    <link rel="stylesheet" href="/website/css/owl.theme.css">
    <link rel="stylesheet" href="/website/css/animate.css">
    <link rel="stylesheet" href="/website/css/normalize.css">
    <link rel="stylesheet" href="/website/css/main.css">
    <link rel="stylesheet" href="/website/css/responsive.css">
    <script src="/website/js/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <header>
        
        <div class="main-nav">
             <div class="container">
                 <div class="topheadbar">
        <p> WEBSITE UNDER REPAIR</p>
    </div>
            <div class="container">
                <div class="col-md-3 col-sm-3 text-center logo">
                    <a href="/">
                        <img class="img-responsive" src="{{ '/uploads/icons/' . $global_setting->site_logo }}"
                            alt="logo">
                    </a>
                </div>
                <div class="col-md-9 col-sm-9">
                    <nav class="navbar navbar-default">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse no-margin no-padding">

                            <ul class="nav navbar-nav">
                                <li @if (!isset($slug_detail))  @endif><a href="/">Home</a></li>

                                @foreach ($menus as $menu)
                                    @php $submenus = $menu->childs; @endphp


                                    

                                    <li class="nav-item dropdown" @if (isset($slug_detail) && $slug_detail->nav_name == $menu->nav_name)  @endif><a
                                            class="dropdown-toggle"
                                            @if ($menu->nav_name == 'career') @else data-toggle="dropdown" @endif
                                            role="button" aria-haspopup="true" aria-expanded="false"
                                            @if ($submenus->count() > 0) href="{{ route('category', $menu->nav_name) }}" @else href="  
                                    {{ route('category', $menu->nav_name) }}" @endif>{{ $menu->caption }}
                                            @if ($menu->nav_name == 'career')
                                            @else
                                                <span class="caret"></span>
                                            @endif


                                        </a>
                                        

                                        @if ($submenus->count() > 0)
                                            <ul class="dropdown-menu">
                                                @foreach ($submenus as $sub)
                                                    <li>
                                                        <a
                                                            href="{{ route('subcategory', [$menu->nav_name, $sub->nav_name]) }}">{{ $sub->caption }}</a>
                                                    </li>
                                                @endforeach


                                                @if ($menu->id == 2669)
                                                    @foreach ($father as $father_item)
                                                        <li>
                                                            <a href="{{ route('all-data', $father_item->nav_name) }}">{{ $father_item->caption }}

                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @else
                                                @endif
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                <li><a href="/contact">Contact</a></li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </nav>





                </div>
            </div>
        </div>
    </header>




    @yield('content')

    <footer>
        <div class="upper-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <img class="img-responsive mt-60"src="{{ '/uploads/icons/' . $global_setting->site_logo }}"
                            alt="footer_icon">
                    </div>
                    <div class="col-md-6 col-sm-3">
                        {!! $global_setting->page_keyword !!}
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h6 class="text-uppercase text-bold gray-e8 bb display-ib">keep in touch</h6>
                        <span class="ubuntu fz-14 black display-block mt-30 lh-24">Address :
                            {{ $global_setting->website_full_address }} {{ $global_setting->address_ne }}</span>
                        <span class="ubuntu fz-14 black display-block lh-24 contact-info">Phone : <a
                                href="tel:{{ $global_setting->phone }}">{{ $global_setting->phone }}</a>, <br><a
                                href="tel:015437508"> {{ $global_setting->phone_ne }}</a> </span>
                        <span class="ubuntu fz-14 black display-block lh-24 contact-info">Email : <a
                                href="mailto:info@cesifnepal.org">{{ $global_setting->site_email }}</a></span>
                        <div class="footer-social list-inline">
                            <a target="_blank" href="{{ $global_setting->facebook }}"><i
                                    class="fa fa-facebook"></i></a>
                            <a target="_blank" href="{{ $global_setting->twitter }}"><i
                                    class="fa fa-twitter"></i></a>
                            <a target="_blank" href="{{ $global_setting->linkedin }}"><i
                                    class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lower-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <span class="ubuntu fz-12 text-uppercase text-medium">Copyright ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> CESIF Nepal All Rights Reserved. Developed By <a
                                href="http://radiantnepal.com/" target="_blank">Radiant Infotech Nepal</a>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </footer>





    <!--jQuery, Bootstrap and other vendor JS-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="/website/js/jquery-1.11.3.min.js"><\/script>')
    </script>
    <script src="/website/js/bootstrap.min.js"></script>
    <script src="/website/js/owl.carousel.js"></script>
    <script src="/website/js/jquery.countdown.min.js"></script>
    <script src="/website/js/jquery.mixitup.js"></script>

    @yield('custom_js')
    <script src="/website/js/Chart.min.js"></script>
    <script src="/website/js/main.js"></script>



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    @if (Session::has('contact'))
        <script>
            Swal.fire(
                'Thank You !',
                "Form submitted sucessfully!!!",
                'success'
            )
        </script>
    @endif
</body>

</html>
