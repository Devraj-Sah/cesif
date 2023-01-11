jQuery(function($) {
    "use strict";
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});
function initialize() {
    "use strict";
      

      var locations = [

                        ['London Eye, London', 51.503454,-0.119562]
                        //['Palace of Westminster, London', 51.499633,-0.124755]
                      
              ];
      var mapCanvas = document.getElementById('map');
      var mapOptions = {
      center: new google.maps.LatLng(51.503454,-0.119562),
      scrollwheel: false,
      zoom: 7,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      styles: [
    {
        "featureType": "all",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#f2f2f2"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "geometry",
        "stylers": [
            {
                "weight": 0.9
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#eee"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ddd"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#b8b8b8"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#fee379"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "om"
            },
            {
                "color": "#7fc8ed"
            }
        ]
    }
]
      }
      var map = new google.maps.Map(mapCanvas, mapOptions);

      var infowindow = new google.maps.InfoWindow();

      var marker, i;

        for (i = 0; i < locations.length; i++) {  

          marker = new google.maps.Marker({ 
            position: new google.maps.LatLng(locations[i][1], locations[i][2]), 
            map: map ,
            icon: 'img/map-pointer.png'
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
      }
    }

  google.maps.event.addDomListener(window, 'load', initialize);