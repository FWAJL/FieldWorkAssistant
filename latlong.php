 <html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>Show/Add multiple markers to Google Maps in asp.net website</title>

<style type="text/css">

html { height: 100% }

body { height: 100%; margin: 0; padding: 0 }

#map_canvas { height: 100% }

</style>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">



window.onload=function () {

var markers = [{ "lat": 12.897489183755905,"lng": 80.2880859375,"description": "Chennai"},

{

"lat": 17.26672782352052,

"lng": 78.5302734375,

"description": "Hyderabad"

},

{

"lat": 12.897489183755905,

"lng": 77.51953125,

"description": "Bangalore"

}

];

alert(markers);

var mapOptions = {

center: new google.maps.LatLng(11.44, 78.79),

zoom: 5,

mapTypeId: google.maps.MapTypeId.ROADMAP

//  marker:true

};

var infoWindow = new google.maps.InfoWindow();

var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

for (i = 0; i < markers.length; i++) {

	

var data = markers[i]



var myLatlng = new google.maps.LatLng(data.lat, data.lng);

alert(myLatlng);

var marker = new google.maps.Marker({

position: myLatlng,

map: map,

title: data.title

});

(function(marker, data) {



// Attaching a click event to the current marker

google.maps.event.addListener(marker, "click", function(e) {

infoWindow.setContent(data.description);

infoWindow.open(map, marker);

});

});

}

}

</script>

</head>

<body>



<div id="map_canvas" style="width: 500px; height: 400px"></div>



</body>

</html>