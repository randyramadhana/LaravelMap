<html>
<head>
	<style type="text/css">
      html, body, #map-canvas { height: 100%; margin: 0; padding: 0;}
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?sensor=false">
    </script>
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
            if (isset($polygonXML)) {
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

              var locationPolygon = new google.maps.Polygon({
                paths: locationCoords,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35
              });

              locationPolygon.setMap(map);
              <?php
            }
          }
          ?>

        
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>

	<div id="map-canvas">
	</div>
</body>
</html>