<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>News Portal Nepal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/websites/css/style.min.css">
</head>
<body>
@yield('top-adx')
@yield('header')
@yield('navbar')
<!----html---<body>---->


<!----top adz----->

<!--<div class="icon-bar">

    <h4>Hot Link</h4>
    <ul>
        <li><a href="#">Online Khabra</a></li>
        <li><a href="#">Ratopati</a></li>
        <li><a href="#">Seto Pati</a></li>
        <li><a href="#">Reporters Nepal</a></li>
        <li><a href="#">Nepali Patra</a></li>
        <li><a href="#">Nagarik News</a></li>
        <li><a href="#">Annapurna Post</a></li>

    </ul>

</div>-->


<!-- content section -->
    <section class="body-horizantal-adz ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <img src="/websites/images/NepalLife-Insurance-NEW_GIF_015_JEEVAN_SAHARA_1100-100.gif">
                </div>
            </div>
        </div>
    </section>

    <section class="breaking-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!----top_three_news---->
                    <a href="page.html">
                        <div class="box">
                            <h2 class="breaking-news-title">{{$top_first_news->caption_nepali}}</h2>
                            <figure><img src="{{$top_first_news->banner_image}}"></figure>
                            <div class="description"><p>{{$top_first_news->short_content_nepali}}</p></div>
                        </div>
                    </a>

                    <a href="page.html">
                        <div class="box">
                            <h2 class="breaking-news-title">{{$top_first_news->caption_nepali}}</h2>

                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="body-horizantal-adz ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <img src="/websites/images/ime.gif">
                </div>
            </div>
        </div>
    </section>
<!---top three news----->
    <section class="breaking-news horizantal-list">
        <div class="container">
            <div class="row">
                @foreach($homenews as $key=>$three_news)
                @php if($key>2){break;} @endphp
                <div class="col-md-4 col-sm-12">
                    <a href="#">
                        <div class="box">
                            <figure><img src="{{$three_news->banner_image}}"></figure>
                            <h3 class="title">{{$three_news->caption_nepali}}</h3>
                        </div>
                    </a>
                </div>   
               @endforeach
            </div>
        </div>
    </section>
<!------top three news completed---->


    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8">
                    <!--------------------------- adz------------------------------------>
                    <div class="body-horizantal-adz ">
                        <img src="/websites/images/ime.gif">
                    </div>
                    <!-------------------------------------- new  Section of news-------------------------------->
                    <!------here all category with their news displayed start------------------------------------------>
                    @foreach($menus as $menu)
                    <div class="category-style-four">
                        <div class="cat-title">
                            <div class="main-title">{{$menu->caption_nepali}}</div>
                            <div class="sub-title"><a href="#">सबै
                                    <i class="fas fa-list"></i></a>
                            </div>
                        </div>

                        <div class="news-listing">
                            <div class="row">
                                <div class="col-md-7  col-sm-12 ">
                                    <div class="row">
                                         <!-----per menu news start---->
                                         @php $news = $menu->getRelatedNews; @endphp
                                         @foreach($news as $key=>$new)
                                         @php if($key>6){break;} @endphp
                                        <div class="col-md-12">
                                            <div class="main-news-list">
                                                <a href="page.html">
                                                    <figure><img src="/websites/images/news-1.jpg" alt=""></figure>
                                                    <div class="abs-title">
                                                        <h3 class="title">पर्सा र बारामा थप ३५ जनामा कोरोना संक्रमण
                                                            पुष्टि {{$new->created_at}} </h3>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                         <!-----per menu news closed---->
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                     <!------here all category with their news displayed closed------------------------------------------>
                          <div class="category-style-four">
                        <div class="cat-title">
                            <div class="main-title"> नेपाली ब्रान्ड</div>
                            <div class="sub-title"><a href="#">सबै
                                    <i class="fas fa-list"></i></a>
                            </div>
                        </div>

                        <div class="news-listing">
                            <div class="row">
                                <div class="col-md-7  col-sm-12 ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="main-news-list">
                                                <a href="page.html">
                                                    <figure><img src="/websites/images/news-1.jpg" alt=""></figure>
                                                    <div class="abs-title">
                                                        <h3 class="title">पर्सा र बारामा थप ३५ जनामा कोरोना संक्रमण
                                                            पुष्टि</h3>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 ">
                                            <div class="main-news-list">
                                                <a href="page.html">
                                                    <figure><img src="/websites/images/news-1.jpg" alt=""></figure>
                                                    <div class="abs-title">
                                                        <h3 class="title">पर्सा र बारामा थप ३५ जनामा कोरोना संक्रमण
                                                            पुष्टि</h3>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 ">
                                            <div class="main-news-list">
                                                <a href="page.html">
                                                    <figure><img src="/websites/images/news-1.jpg" alt=""></figure>
                                                    <div class="abs-title">
                                                        <h3 class="title">पर्सा र बारामा थप ३५ जनामा कोरोना संक्रमण
                                                            पुष्टि</h3>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 ">
                                            <div class="main-news-list">
                                                <a href="page.html">
                                                    <figure><img src="/websites/images/news-1.jpg" alt=""></figure>
                                                    <div class="abs-title">
                                                        <h3 class="title">पर्सा र बारामा थप ३५ जनामा कोरोना संक्रमण
                                                            पुष्टि</h3>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12 ">
                                    <div class="normal-news-list">
                                        <a href="page.html">
                                            <figure><img src="/websites/images/news-1.jpg" alt=""></figure>
                                            <div class="abs-title">
                                                <h3 class="title">पर्सा र बारामा थप ३५ जनामा कोरोना संक्रमण पुष्टि</h3>
                                            </div>

                                        </a>
                                    </div>
                                    <div class="normal-news-list">
                                        <a href="page.html">
                                            <figure><img src="/websites/images/news-2.jpg" alt=""></figure>
                                            <div class="abs-title">
                                                <h3 class="title">कमजोर मुद्दा पेश भएपछि अवैध मिर्गौला प्रत्यारोपण गर्ने
                                                    गिरोहलाई हाइसञ्चो</h3>
                                            </div>

                                        </a>
                                    </div>
                                    <div class="normal-news-list">
                                        <a href="page.html">
                                            <figure><img src="/websites/images/news-3.jpg" alt=""></figure>
                                            <div class="abs-title">
                                                <h3 class="title">युएईमा पाँच महिनामा ११० नेपालीको मृत्यु</h3>
                                            </div>

                                        </a>
                                    </div>
                                    <div class="normal-news-list">
                                        <a href="page.html">
                                            <figure><img src="/websites/images/news-1.jpg" alt=""></figure>
                                            <div class="abs-title">
                                                <h3 class="title">युएईमा पाँच महिनामा ११० नेपालीको मृत्यु</h3>
                                            </div>

                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                    <!-------------------------------------- new  Section of news-------------------------------->
              
                    <!--------------------------- adz------------------------------------>
                    <div class="body-horizantal-adz ">
                        <img src="/websites/images/ime.gif">
                    </div>


                    <div class="photo-slider">
                        <div class="cat-title">
                            <div class="main-title">समाचार</div>
                            <div class="sub-title"><a href="#">सबै
                                    <i class="fas fa-list"></i></a>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme photo-slider-img">
                            <div class="item">
                                <img src="/websites/images/photo-1.jpg" alt="First slide">
                                <div class="caption">
                                    <p>तनहुँको भीमाद नगरपालिका–४ स्थित मैदीखोलामा गत असार २९ गतेको बाढीले भत्किएको पुल ।
                                        पुल भत्किएपछि स्थानीयवासीलाई आवतजावतमा समस्या भएको छ । तस्वीर: कृष्ण
                                        न्यौपाने/रासस</p>
                                </div>
                            </div>
                            <div class="item">
                                <img src="/websites/images/photo-2.jpg" alt="First slide">
                                <div class="caption">
                                    <p>तनहुँको भीमाद नगरपालिका–४ स्थित मैदीखोलामा गत असार २९ गतेको बाढीले भत्किएको पुल ।
                                        पुल भत्किएपछि स्थानीयवासीलाई आवतजावतमा समस्या भएको छ । तस्वीर: कृष्ण
                                        न्यौपाने/रासस</p>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
                <aside class="col-md-3 col-sm-3 sidebar">
                    <div class="side-links">
                        <div class="cat-title">
                            <div class="main-title">राशीफल</div>
                        </div>
                        <ul>
                            <li><a href="horoscope.html"><img src="/websites/images/horoscope-1.png" width="80" height="110"
                                                             alt=""/>
          section                          मिथुन</a></li>
                            <li><a href="horoscope.html"><img src="/websites/images/horoscope-4.png" width="80" height="110"
                                                             alt=""/>
                                    कर्कट</a></li>
                            <li><a href="horoscope.html"><img src="/websites/images/horoscope-5.png" width="80" height="110"
                                                             alt=""/>
                                    सिंह </a></li>
                            <li><a href="horoscope.html"><img src="/websites/images/horoscope-6.png" width="80" height="110"
                                                             alt=""/>
                                    कन्या</a></li>
                            <li><a href="horoscope.html"><img src="/websites/images/horoscope-7.png" width="80" height="110"
                                                             alt=""/>
                                    तुला</a></li>
                            <li><a href="horoscope.html"><img src="/websites/images/horoscope-8.png" width="80" height="110"
                                                             alt=""/>
                                    बृश्चिक</a></li>
                            <li><a href="horoscope.html"><img src="/websites/images/horoscope-9.png" width="80" height="110"
                                                             alt=""/>
                                    धनु </a></li>
                            <li><a href="horoscope.html"><img src="/websites/images/horoscope-10.png" width="80" height="110"
                                                             alt=""/>
                                    मकर </a></li>
                            <li><a href="horoscope.html"><img src="/websites/images/horoscope-11.png" width="80" height="110"
                                                             alt=""/>
                                    कुम्भ </a></li>
                            <li><a href="horoscope.html"><img src="/websites/images/horoscope-12.png" width="80" height="110"
                                                             alt=""/>
                                    मीन </a></li>
                        </ul>
                    </div>
                    <div class="sidebar-adz">
                        <figure>
                            <img src="/websites/images/sidead3.gif"/>
                        </figure>
                        <figure>
                            <img src="/websites/images/sidead4.gif"/>
                        </figure>
                        <figure>
                            <img src="/websites/images/sidead5.gif"/>
                        </figure>
                        <figure>
                            <img src="/websites/images/sidead6.gif"/>
                        </figure>
                        <figure>
                            <img src="/websites/images/sidead7.gif"/>
                        </figure>


                    </div>

                    <div class="interview-box">
                        <div class="client-img">
                            <a href="#"><img src="/websites/images/testimonial-1.png" alt="" class="img-fluid "></a>
                        </div>
                        <h3 class="title text-center"><a href="#">पर्सा र बारामा थप ३५ जनामा कोरोना संक्रमण पुष्टि</a>
                        </h3>
                    </div>

                    <div class="interview-box">
                        <div class="client-img">
                            <a href="#"><img src="/websites/images/testimonial-1.png" alt="" class="img-fluid "></a>
                        </div>
                        <h3 class="title text-center"><a href="#">पर्सा र बारामा थप ३५ जनामा कोरोना संक्रमण पुष्टि</a>
                        </h3>
                    </div>

                    <div class="sidebar-adz">
                        <figure>
                            <img src="/websites/images/sidead9.gif"/>
                        </figure>
                        <figure>
                            <img src="/websites/images/sidead10.gif"/>
                        </figure>
                        <figure>
                            <img src="/websites/images/sidead5.gif"/>
                        </figure>
                        <figure>
                            <img src="/websites/images/sidead6.gif"/>
                        </figure>


                    </div>

                </aside>
            </div>
        </div>
    </section>






<footer id="colophon" class="site-footer">
    <div class="upper-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div id="categories-4" class="widget widget_contact">
                        <figure><img src="/websites/images/footer-logo.png" alt=""/>
                        </figure>

                        <ul>
                            <li><a href="#" ><i class="fab fa-youtube "></i> Sample News Nepal</a> </li>
                            <li><a href="#" ><i class="fab fa-facebook-square "></i> Sample News Nepal</a> </li>
                            <li><a href="mailto:khabarinepal555@gmail.com" ><i class="fas fa-envelope "></i> SampleNews@gmail.com</a> </li>

                            <li><a href="tel:" class=""><i class="fas fa-phone-volume"></i> +977-9846xxxxxx</a>

                            </li>

                        </ul>

                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div id="categories-4" class="widget widget_contact">
                        <h2 class="widget-title">विविध</h2>
                        <ul>
                            <li><a href="#">हाम्रोबारे</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">विज्ञापन</a>

                            </li>
                            <li><a href="#"> प्रयोगका सर्त</a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div id="categories-4" class="widget widget_contact">
                        <h2 class="widget-title">विविध</h2>
                        <ul>
                            <li><a href="#">हाम्रोबारे</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">विज्ञापन</a>

                            </li>
                            <li><a href="#"> प्रयोगका सर्त</a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div id="categories-4" class="widget widget_contact">
                        <h2 class="widget-title">विविध</h2>
                        <ul>
                            <li><a href="#">ब्लोअप</a>
                            </li>
                            <li><a href="#">ताजा समाचार</a>
                            </li>
                            <li><a href="#">पर्यटन</a>

                            </li>
                            <li><a href="#">बजार</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="lower-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <p class="copyright">© 2021 newsportal.sample.com सर्वाधिकार सुरक्षित</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <ul class="social-media">
                        <li>
                            <a href="#">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-google"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="#" class="back-to-top"><i class="icofont-thin-up"></i></a>
    </div>

</footer>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">पत्रकार बानियाँको मृत्युबारे अनुसन्धान गर्न माग</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="/websites/images/photo-2.jpg" alt="" />
            </div>

        </div>
    </div>
</div>


<script src="/websites/js/vendor/jquery.min.js"></script>
<script src="/websites/js/vendor/bootstrap.js"></script>
<script src="/websites/js/vendor/owl.carousel.js"></script>
<script src="/websites/js/custom.js"></script>
<script>
    window.onscroll = function () {
        myFunction()
    };

    var header = document.getElementById("khabari-nav");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky-menu");
        } else {
            header.classList.remove("sticky-menu");
        }
    }
</script>
</body>

<!-- Mirrored from sample-news.demo.radiantnepal.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Jul 2022 09:09:02 GMT -->
</html>