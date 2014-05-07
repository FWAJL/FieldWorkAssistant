<!DOCTYPE html>



<html>

<head>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyB4iGeXYKfqv65-8c9UbR1qPavZb6VFXCU&sensor=false"></script>

<script type="text/javascript">



var geocoder = new google.maps.Geocoder();

var map;



function geocodePosition(pos) {

	geocoder.geocode({

    latLng: pos

  }, function(responses) {

    if (responses && responses.length > 0) {

      updateMarkerAddress(responses[0].formatted_address);

    } else {

      updateMarkerAddress('Cannot determine address at this location.');

    }

  });

}



function updateMarkerStatus(str) {

  document.getElementById('markerStatus').innerHTML = str;

}



function updateMarkerPosition(latLng) {

  document.getElementById('info').innerHTML = [

    latLng.lat(),

    latLng.lng()

  ].join(', ');

}



function updateMarkerAddress(str) {

  document.getElementById('address').innerHTML = str;

  

}



function initialize() {

  var latLng = new google.maps.LatLng(-33.90616588876475, 151.15102333450318);

  var map = new google.maps.Map(document.getElementById('mapCanvas'), {

    zoom: 15,

    center: latLng,

    disableDefaultUI: true,

    zoomControl: true,

    mapTypeId: google.maps.MapTypeId.ROADMAP

  });



  var marker = new google.maps.Marker({

    position: latLng,

    title: 'Point A',

    map: map,

    draggable: true

  });



  // Update current position info.

  updateMarkerPosition(latLng);

  geocodePosition(latLng);



  // Add dragging event listeners.

  google.maps.event.addListener(marker, 'dragstart', function() {

    updateMarkerAddress('Dragging...');

  });



  google.maps.event.addListener(marker, 'drag', function() {

    updateMarkerStatus('Dragging...');

    updateMarkerPosition(marker.getPosition());

  });



  google.maps.event.addListener(marker, 'dragend', function() {

    updateMarkerStatus('Drag ended');

    geocodePosition(marker.getPosition());

    map.panTo(marker.getPosition());

  });



  google.maps.event.addListener(map, 'bounds_changed', function() {

    marker.setPosition(map.getCenter());

    updateMarkerPosition(marker.getPosition());

  });

}



function codeAddress() {

    var address2 = document.getElementById('target').value;

    geocoder.geocode( { 'address': address2}, function(results) {

            alert(results[0].geometry.location);

            map.setCenter(results[0].geometry.location);

    });

}



google.maps.event.addDomListener(window, 'load', initialize);

</script>

</head>

<body>

  <style>

   html { height: 100% }

   body { height: 100%; margin: 0; padding: 0 }

  #mapCanvas {

    height: 85%;

    width: 100%;

    position: relative;

  }

  #infoPanel div {

    background: white;

    top: 0px;

    position: relative;

    height: 20px;

    width: 500px;

  }

  </style>



  <div id="mapCanvas"></div>

  <div id="infoPanel">

    <b>Marker status:</b>

    <div id="markerStatus"><i>Click and drag the marker.</i></div>

    <b>Current position:</b>

    <div id="info"></div>

    <b>Closest matching address:</b>

    <div id="address"></div>

  </div>

  <div>

      <input id="target" type="textbox" value="Sydney, NSW">

      <input type="button" value="Geocode" onclick="codeAddress();">

      <input type="button" value="Test" onclick="test();">

  </div>

 </body>

</html>