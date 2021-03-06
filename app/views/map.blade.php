<html>
<head>
	<style type="text/css">
      html, body, #map-canvas { height: 100%; margin: 0; padding: 0;}
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?sensor=false">
    </script>
    <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerwithlabel/1.1.5/src/markerwithlabel_packed.js"></script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: { lat: -6.278678, lng: 106.855942},
          zoom: 12
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);

        <?php     
          $locations = Location::all();
          foreach ($locations as $location)
          {
            $polygonXML = $location->polygonal_coordinates;
            if (!empty($polygonXML)) {
              $polygonalCoordinates = preg_replace( "/<coordinates>/", "", $polygonXML);
              $coordinates = explode(" ", $polygonalCoordinates);
              ?>

              var locationCoords = [];

              <?php
              foreach($coordinates as $coordinate)
              {

                $longLat = explode(",", $coordinate);
                if (!empty($longLat[1]) and !empty($longLat[0])) {
                  $longPos = $longLat[0];
                  $latPos = $longLat[1];
                ?>

                locationCoords.push(new google.maps.LatLng( <?php echo $latPos; echo ','; echo $longPos;?> ));

                <?php 
                }
              }
              ?>

              var markerContent = " {{ str_replace('"', "'", $location->name) }} ";

              makePolygon(locationCoords, markerContent, map);

              

              
              <?php
            }
          }
          ?>

        
      }

      function makePolygon(polyCoords, markerContent, map) {
        var locationPolygon = new google.maps.Polygon({
                paths: polyCoords,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35
              });
        
        var marker = new MarkerWithLabel({
                position: new google.maps.LatLng(0,0),
                draggable: false,
                raiseOnDrag: false,
                map: map,
                labelContent: markerContent,
                labelAnchor: new google.maps.Point(30, 20),
                labelClass: "labels", // the CSS class for the label
                labelStyle: {opacity: 1.0},
                icon: "http://placehold.it/1x1",
                visible: false
              });

        locationPolygon.setMap(map);

              google.maps.event.addListener(locationPolygon, "mousemove", function(event) {
                marker.setPosition(event.latLng);
                marker.setVisible(true);
              });
              google.maps.event.addListener(locationPolygon, "mouseout", function(event) {
                marker.setVisible(false);
              });

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>
  <a href="<?php echo url(); ?>">Home</a>
	<div id="map-canvas">
	</div>
</body>
</html>