<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Google Maps JavaScript API v3 Example: Alternate Directions (panel)</title>
<style type="text/css">
html { height: 100% }
body { height: 100%; margin: 0px; padding: 0px }
</style>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript">
var directionDisplay;
var directionsRenderer;
var directionsService = new google.maps.DirectionsService();
var map;

function drawMap(midpoint) {
  var mid = midpoint.split(",");
  var start = new google.maps.LatLng(mid[0], mid[1]);
  var myOptions = {
    zoom:7,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: start,
    mapTypeControl: false
  }
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
}

function getRendererOptions(main_route)
{
  if(main_route)
  {
    var _colour = '#00458E';
    var _strokeWeight = 4;
    var _strokeOpacity = 1.0;
    var _suppressMarkers = false;
  }
  else
  {
    var _colour = '#ED1C24';
    var _strokeWeight = 2;
    var _strokeOpacity = 0.7;
    var _suppressMarkers = false;
  }

  var polylineOptions ={ strokeColor: _colour, strokeWeight: _strokeWeight, strokeOpacity: _strokeOpacity  };

  var rendererOptions = {draggable: false, suppressMarkers: _suppressMarkers, polylineOptions: polylineOptions};

  return rendererOptions;
}

function renderDirections(result, rendererOptions, routeToDisplay)
{

  if(routeToDisplay==0)
  {
    var _colour = '#00458E';
    var _strokeWeight = 4;
    var _strokeOpacity = 1.0;
    var _suppressMarkers = false;
  }
  else
  {
    var _colour = '#ED1C24';
    var _strokeWeight = 4;
    var _strokeOpacity = 0.7;
    var _suppressMarkers = false;
  }

// if (routeToDisplay == 0) _colour = "#FF0000";


    // create new renderer object
    var directionsRenderer = new google.maps.DirectionsRenderer({
      draggable: false, 
      suppressMarkers: _suppressMarkers, 
      polylineOptions: { 
        strokeColor: _colour, 
        strokeWeight: _strokeWeight, 
        strokeOpacity: _strokeOpacity  
        }
      });
    directionsRenderer.setMap(map);
                directionsRenderer.setPanel(document.getElementById('directions_panel'));
    directionsRenderer.setDirections(result);
    directionsRenderer.setRouteIndex(routeToDisplay);
}

function requestDirections(start, end, routeToDisplay, main_route) {

  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING,
    provideRouteAlternatives: main_route
  };


  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK)
    {
      if(main_route)
      {
        var rendererOptions = getRendererOptions(true);
        for (var i = 0; i < result.routes.length; i++)
        {
            renderDirections(result, rendererOptions, i);
        }
      }
      else
      {
        var rendererOptions = getRendererOptions(false);
        renderDirections(result, rendererOptions, routeToDisplay);
      }
    }
  });
}
  </script>
</head>
<body >
<div id="map_canvas" style="float:left;width:70%;height:100%;"></div>
<div id="control_panel" style="float:right;width:30%;text-align:left;padding-top:20px">
<div id="directions_panel" style="margin:20px;background-color:#FFEE77;"></div>
</div>
        <script type="text/javascript">
          // users route
          requestDirections('(<?php echo '-7.350702573657568, 112.69775276437372';?>)', '(<?php echo '-7.345026,112.692442';?>)', 0, true);
          drawMap("-7.4830233,112.679546");
        </script>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"> 
</script> 
<script type="text/javascript"> 
_uacct = "UA-162157-1";
urchinTracker();
</script> 


</body></html>