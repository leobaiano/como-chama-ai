<?php

/* ---------------------------------------------------------------------- */
/*	GOOGLE MAPS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode("map", "luxe_map");

function luxe_map($atts, $content = null) {
	extract(shortcode_atts(array(
      "height" => '280',
      "lat" => '',
      "long" => '',
      "zoom" => '17',
      "saturation" => '-100',
      "lightness" => '0',
      "marker" => '',
      "hue" => '#000000'
   ), $atts));
	
  $marker_icon = ($marker ? $marker : get_template_directory_uri() .'/images/map-marker.png');  

  $output = '

  <style>
    #map_canvas {
      width: 100%;
      height: ' .  $height .'px;
    }
  </style>
  <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
  <script>
    // Standard google maps function
    function initialize() {
        var myLatlng = new google.maps.LatLng('. $lat .','. $long .');
        var myOptions = {
            zoom: '. $zoom .',
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            scrollwheel: false
        }
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        var styles = [
          {
            stylers: [
              { hue: "'. $hue .'" },
              { saturation: '. $saturation .' },
              { "lightness": '. $lightness .' }
            ]
          },{
            featureType: "road",
            elementType: "geometry",
            stylers: [
              { visibility: "simplified" }
            ]
          }
        ];

    map.setOptions({styles: styles});
        LuxeMarker();
    }


    // Function for adding a marker to the page.
    function addMarker(location) {
        marker = new google.maps.Marker({
            position: location,
            map: map,
            icon: "'. $marker_icon .'"
        });
    }

    // Testing the addMarker function
    function LuxeMarker() {
           userLocation = new google.maps.LatLng('. $lat .','. $long .');
           addMarker(userLocation);
    }
    google.maps.event.addDomListener(window, \'load\', initialize);

  </script>
  <div class="google-map"><div id="map_canvas"></div></div>

 
  ';
  return $output;
}


/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['map'] =     array(
        'title'   => 'Map',
        'code'    => '[map]',
        'attributes' => array(
          array(
            'name'  => 'hue',
            'type'  => 'color',
            'label' => __('Hue', 'luxe_framework'),
            'default' => '#000000',
          ),
          array(
            'name'  => 'zoom',
            'type'  => 'slider',
            'label' => __('Zoom', 'luxe_framework'),
            'default' => '17',
            'min' => 0,
            'max' => 19,
          ),
          array(
            'name'  => 'lightness',
            'type'  => 'slider',
            'label' => __('Lightness', 'luxe_framework'),
            'default' => '0',
            'min' => -100,
            'max' => 100,
          ),
          array(
            'name'  => 'saturation',
            'type'  => 'slider',
            'label' => __('Saturation', 'luxe_framework'),
            'default' => '-100',
            'min' => -100,
            'max' => 100,
          ),
          array(
            'name'  => 'marker',
            'type'  => 'upload',
            'label' => __('Marker Icon', 'luxe_framework'),
          ),
          array(
            'name'  => 'lat',
            'type'  => 'textbox',
            'label' => __('Latitude', 'luxe_framework'),
          ),
          array(
            'name'  => 'long',
            'type'  => 'textbox',
            'label' => __('Longitude', 'luxe_framework'),
          ),
          array(
            'name'  => 'height',
            'type'  => 'textbox',
            'label' => __('Height (in pixels)', 'luxe_framework'),
            'default' => '280',
          ),
        )
      );
?>