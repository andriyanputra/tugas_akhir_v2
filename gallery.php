<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Google Maps JavaScript API v3 Example: Directions Travel Modes</title>
<style type="text/css">
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#map_canvas {
  height: 100%;
}

@media print {
  html, body {
    height: auto;
  }

  #map_canvas {
    height: 650px;
  }
}
</style>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
      var directionDisplay;
      var directionsService = new google.maps.DirectionsService();
      var map;
      var haight = new google.maps.LatLng(37.7699298, -122.4469157);
      var seaCliff = new google.maps.LatLng(37.78809,-122.491046);
      var oceanBeach = new google.maps.LatLng(37.7683909618184, -122.51089453697205);

      function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var mapOptions = {
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: haight
        }
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        directionsDisplay.setMap(map);
      }

      function calcRoute() {
        var selectedMode = document.getElementById('mode').value;
        var request = {
            origin: haight,
            destination: oceanBeach,
            // Note that Javascript allows us to access the constant
            // using square brackets and a string value as its
            // "property."
            travelMode: google.maps.TravelMode.DRIVING
        };
        if (document.getElementById('waypoint').checked)
          request.waypoints = [{location: seaCliff, stopover: true}];

        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          } else { 
            alert("Directions Request Failed, "+status);
          }
        });
      }
    </script>
  </head>
  <body onload="initialize()">
    <div>
    <b>Mode of Travel: </b>
    <select id="mode" onchange="calcRoute();">
      <option value="DRIVING">Driving</option>
      <option value="WALKING">Walking</option>
      <option value="BICYCLING">Bicycling</option>
      <option value="TRANSIT">Transit</option>
    </select>
    use waypoint <input id="waypoint" type="checkbox" checked="checked" onchange="calcRoute();" onclick="calcRoute();">
    </div>
    <div id="map_canvas" style="top:30px;"></div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-162157-1";
urchinTracker();
</script>
  

</body></html>