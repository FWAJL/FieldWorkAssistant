<style>
#map-canvas {
	width: 940px;
	height: 500px;
	float: left;
}
</style>
<?php 
    if(!isset($_SESSION['pm']))
    {
        header("location:login.php");
    }

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
	var bounds = new google.maps.LatLngBounds();
var points=[];
var r_start_lat;
var r_start_lng;
var r_end_lat;
var r_end_lng;
var r_point;
var map;
var id_arr=[];
var id='<?php echo $_REQUEST['pid'];?>';

//var id='<?php echo $id;?>';

function initialize() {
  var mapOptions = {
    zoom: 5,
    center: new google.maps.LatLng(33.60599089750828, -112.12505099999998),
    mapTypeId: google.maps.MapTypeId.ROAD
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
	//  jQuery.get('test.txt', function(data) {
	//  var text_id=data.split(",");
//for(var k=0;k<data.split(",").length;k++)
//{
   var searchUrl = 'showxmldata.php?pid='+id;
       downloadUrl(searchUrl, function(data) {	   
       var xml = parseXml(data);
       var markerNodes = xml.documentElement.getElementsByTagName("marker");
       var bounds = new google.maps.LatLngBounds();
       for (var i = 0; i < markerNodes.length; i++) {
       var latlng = markerNodes[i].getAttribute("position");
	drawpolygon(latlng);
    }
    });
	//}
	//});
}

function drawpolygon(latlng)
{
points=[];
var coord=latlng.split("  ")[0];
var split_coord=coord.split("),(");
for(var j=0;j<split_coord.length;j++)
{
var r_lat_lng_e=split_coord[j].split(',');   
var r_lat=r_lat_lng_e[0];       
var r_lng=r_lat_lng_e[1]; 
if(j==0){
r_start_lat=r_lat.split("(")[1];
r_start_lng=r_lng;
}
else if(j==split_coord.length-1){
r_end_lat=r_lat;
r_end_lng=r_lng.split(")")[0];
}
else{	 
r_point=new google.maps.LatLng(r_lat,r_lng);
points.push(r_point);
}
}
 var r_start=new google.maps.LatLng(r_start_lat,r_start_lng);
  var r_end=new google.maps.LatLng(r_end_lat,r_end_lng);
showpolygon(r_start,r_end,points);
}
function showpolygon(r_start,r_end,points)
{
 var coords=[];
	coords.push(r_start);
for(var i=0;i<points.length;i++)
{
coords.push(points[i]);
}
	coords.push(r_end);
	var polygon = new google.maps.Polygon({
    paths: coords,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });
  polygon.setMap(map);
console.log(polygon.getPath().getLength());

 for(var t=0;t<polygon.getPath().getLength();t++)
  {
  console.log(polygon.getPath().getLength());
   bounds.extend(polygon.getPath().getAt(t));
   map.fitBounds(bounds);
  }

//map.fitBounds(polygon.getBounds());
}

google.maps.event.addDomListener(window, 'load', initialize);
  function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;
      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request.responseText, request.status);
        }
      };
      request.open('GET', url, true);
      request.send(null);
    }
    function parseXml(str) {
      if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
      } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
      }
    }
    function doNothing() {}
    </script>
    <div id="map-canvas"></div>
  </body>