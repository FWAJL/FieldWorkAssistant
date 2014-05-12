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
include('config.php');


if(isset($_POST['submit']))

{
	  echo "<meta http-equiv='refresh' content='0;url=index.php?list_locations=1&amp;lid=".$lastinserted."&amp;pid=".$_REQUEST['pid']."'>";

    exit;
}
?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
				<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js">
</script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=drawing"></script>
    <script>
	var lat_arr=[];
	var lng_arr=[];
	var pol_array;
	var map;
	var respol;
	  var drawingManager;
function initialize() {
  var mapOptions = {
    center: new google.maps.LatLng(34.19302912451699, -118.24492709999998),
    zoom: 8
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);
drawpolygon();

}

function drawpolygon()
{
  drawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: google.maps.drawing.OverlayType.POLYGON,
    drawingControl: false,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: [
        google.maps.drawing.OverlayType.POLYGON
      ]
    },
	polygonOptions: {
      zIndex: 1,
	  editable:false
    }
  });
  drawingManager.setMap(map);
  google.maps.event.addListener(drawingManager,'polygoncomplete',function(polygon) {
   respol=polygon;
   drawingManager.setMap(null);
  	console.log(polygon.getPath().getArray());

	for(var k=0;k<polygon.getPath().getLength();k++)
	{
	polygon.getPath().getAt(k);
	var lat=polygon.getPath().getAt(k).lat();
	var lng=polygon.getPath().getAt(k).lng();
	lat_arr.push(lat);
	lng_arr.push(lng);
	}
	pol_array=polygon.getPath().getArray()+"  ";


  });
}
function reset()
{
respol.setMap(null);
drawpolygon();
}
function boundaries()
{
var placename=document.getElementById('b_name').value;
console.log(placename);
 $.ajax({
    type: "POST",
    url: "insert.php",
    data: 'lat='+pol_array+'&placename='+placename+'&pid='+'<?php echo $_REQUEST['pid']; ?>',
    cache: false,
    success: function()
    {
	alert("Boundary successfully added");
	}
	});
}
google.maps.event.addDomListener(window, 'load', initialize);

    </script>
 
    <div id="map-canvas"></div>

 <table  style="line-height:40px" width="50%">


    <tr>

      <td id="doc_lib">Boundary Name:</td>

      <td align="right"><input type="text"  name="b_name" id="b_name" class="edit_com" /></td>

	  <td align="right"><button  id="submit" value="Add New Boundary" onclick="boundaries();" >Save</button></td>
	  <td> <input type="button" value="Reset" onclick="reset()"/></td>
    </tr>
 
    

  </table>
  
 
