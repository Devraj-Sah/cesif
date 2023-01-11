$(document).ready(function(){
	"use strict";
	 $(".main-slider").owlCarousel({
        autoPlay: 3000,//3000, //Set AutoPlay to 3 seconds
        navigation: true,
        navigationText:  ["<span><i class=\"fa fa-angle-left fa-lg\"></i></span>","<span><i class=\"fa fa-angle-right fa-lg\"></i></span>"],
        singleItem: true,
        pagination: false
    });




	$('#clock').countdown('2015/12/29', function(event) {
	   var $this = $(this).html(event.strftime(''
	    
	     + '<div class="time-p mt-80 text-center"><span class="days poppins text-uppercase d-black">days</span> <span class="karla fz-60 green-6f">%d</span><span class="year karala fz-14 gray-777">2015</span></div>  '
	     + '<div class="time-p mt-80 text-center"><span class="hr poppins text-uppercase d-black">hours</span> <span class="karla fz-60 green-6f">%H</span><span class="year karala fz-14 gray-777">2015</span></div>  '
	     + '<div class="time-p mt-80 text-center"><span class="min poppins text-uppercase d-black">mins</span> <span class="karla fz-60 green-6f">%M</span><span class="year karala fz-14 gray-777">2015</span></div>  '
	     + '<div class="time-p mt-80 text-center"><span class="sec poppins text-uppercase d-black">secs</span> <span class="karla fz-60 green-6f">%S</span><span class="year karala fz-14 gray-777">2015</span></div> '));
 	});
 	$(".causes").owlCarousel({
        autoPlay: false,
        loop: true,
        navigation: true,
        navigationText:  ["<span><i class=\"fa fa-angle-left fa-lg\"></i></span>","<span><i class=\"fa fa-angle-right fa-lg\"></i></span>"],
        items: 4,
        itemsCustom: [[0, 1], [400, 1], [700, 1], [1000, 3], [1200, 3], [1600, 3]],
        pagination: false
    });
    $(".publication-slider").owlCarousel({
        autoPlay: false,
        loop: true,
        navigation: true,
        navigationText:  ["<span><i class=\"fa fa-angle-left fa-lg\"></i></span>","<span><i class=\"fa fa-angle-right fa-lg\"></i></span>"],
        items: 4,
        itemsCustom: [[0, 1], [400, 1], [700, 1], [1000, 3], [1200, 3], [1600, 3]],
        pagination: false
    });
    $(".monthly-analysis-slider").owlCarousel({
        autoPlay: false,
        loop: true,
        navigation: true,
        navigationText:  ["<span><i class=\"fa fa-angle-left fa-lg\"></i></span>","<span><i class=\"fa fa-angle-right fa-lg\"></i></span>"],
        items: 5,
        itemsCustom: [[0, 2], [400, 2], [700, 3], [1000, 3], [1200, 5], [1600, 5]],
        pagination: false
    });
    //progressbar with tooltips
	$(function () { 
		"use strict";
	  $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
	});  

	$( window ).scroll(function() {
	"use strict";   
	  // if($( window ).scrollTop() > 10){   scroll down abit and get the action   
	  $(".progress-bar").each(function(){
	    var each_bar_width = $(this).attr('aria-valuenow');
	    $(this).width(each_bar_width + '%');
	  });
	       
	 //  }  
	});

	$(function(){
      "use strict";
      // Instantiate MixItUp:
      $('#Container').mixItUp();
    });
     $(".test-sldier").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 2,
        itemsCustom: [[0, 1], [400, 1], [700, 1], [1000, 1], [1200, 2], [1600, 2]]
    });

     $('#upcoming').countdown('2015/12/29', function(event) {
	   var $this = $(this).html(event.strftime(''
	    
	     + '<div class="text-center display-ib event-count-down mt-60"><span class="martel text-extra-bold green-5c fz-26 display-block">%d</span><span class="martel fz-16 display-block text-bold text-uppercase white">Days</span></div>  '
	     + '<div class="text-center display-ib event-count-down mt-60"><span class="martel text-extra-bold green-5c fz-26 display-block">%H</span><span class="martel fz-16 display-block text-bold text-uppercase white">hours</span></div>  '
	     + '<div class="text-center display-ib event-count-down mt-60"><span class="martel text-extra-bold green-5c fz-26 display-block">%M</span><span class="martel fz-16 display-block text-bold text-uppercase white">Minutes</span></div>  '
	     + '<div class="text-center display-ib event-count-down mt-60"><span class="martel text-extra-bold green-5c fz-26 display-block">%S</span><span class="martel fz-16 display-block text-bold text-uppercase white">seconds</span></div> '));
 	});
});