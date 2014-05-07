<style>
#mapCanvas {
	width: 940px;
	height: 500px;
	float: left;
}

#infoPanel {
	float: left;
	margin-left: 10px;
}

#infoPanel div {
	margin-bottom: 5px;
}
</style>

<?php 

    if(!isset($_SESSION['pm']))

    {

        header("location:login.php");

    }

?>

<?php include('config.php');

 

// Queries

if(isset($_REQUEST['all_proj'])) 
{

// Get Lat/Long for all Projects (Facilites)

$sql_lat_long = $DBH->prepare("SELECT project_id, facility_id_num, facility_nam, facility_lat, facility_long FROM project_info WHERE facility_lat IS NOT NULL && facility_long IS NOT NULL");
$sql_lat_long->execute();
$results = $sql_lat_long->fetchAll();
$rows = $sql_lat_long->rowCount();


	// Define Zoom window for all Projects (Facilities)
$min_max = $DBH->prepare("SELECT MIN(facility_lat), MIN(facility_lat), MIN(facility_long), MAX(facility_lat), MAX(facility_long) FROM project_info");
$min_max->execute();
$min_max_results = $min_max->fetch();

if($rows > 0) 
	{
	// Find center for all Projects (Facilities)
  $latsum=0;
  $longsum=0;
  foreach($results as $row) 
  		{ 
	$latsum= $row['facility_lat']+$latsum;
    $longsum= $row['facility_long']+$longsum;
   		} 
  $center_lat=$latsum/$rows;
  $center_long=$longsum/$rows;
	}
} 
elseif(isset($_REQUEST['sel_projs'])) 
{

// Get Lat/Long for selected Projects (Facilites)
$sql_lat_long = $DBH->prepare("SELECT project_id, facility_id_num, facility_nam, facility_lat, facility_long FROM project_info WHERE facility_lat IS NOT NULL && facility_long IS NOT NULL && active_bool=1");
$sql_lat_long->execute();
$results = $sql_lat_long->fetchAll();
$rows = $sql_lat_long->rowCount();

	// Define Zoom window for all selected Projects (Facilities)
$min_max = $DBH->prepare("SELECT MIN(facility_lat), MIN(facility_long), MAX(facility_lat), MAX(facility_long) FROM project_info WHERE facility_lat IS NOT NULL && facility_long IS NOT NULL && active_bool=1");
$min_max->execute();
$min_max_results = $min_max->fetch();

if($rows > 0) 
	{  
	// Find center for all selected Projects (Facilites)
  $latsum=0;
  $longsum=0;
  foreach($results as $row) 
  		{ 
  if(isset($row['facility_lat']) && isset($row['facility_long'])) 
  			{
	$latsum= $row['facility_lat']+$latsum;
    $longsum= $row['facility_long']+$longsum;
			}    
   		}
  $center_lat=$latsum/$rows;
  $center_long=$longsum/$rows; 
	}
}
elseif(isset($_REQUEST['sel_proj'])) 
{		
// Get Lat/Long for the selected Project (Facility)
$sql_lat_long = $DBH->prepare("SELECT project_id, facility_id_num, facility_nam, facility_lat, facility_long FROM project_info WHERE project_id = '".$_REQUEST['pid']."'");
$sql_lat_long->execute();
$results = $sql_lat_long->fetch();
$rows=1;

$min_max = $DBH->prepare("SELECT MIN(facility_lat), MIN(facility_long), MAX(facility_lat), MAX(facility_long) FROM project_info WHERE project_id = '".$_REQUEST['pid']."'");
$min_max->execute();
$min_max_results = $min_max->fetch();

 $center_lat=$results['facility_lat'];
 $center_long=$results['facility_long']; 
}

// End Queries

	
// Map Marker Update

 if(isset($_REQUEST['oldlat']))

  {

$sql = "UPDATE project_info SET 
facility_lat = :l_la, 
facility_long = :l_lon
WHERE project_id = :loc_i
";

$stmt = $DBH->prepare($sql);
$stmt->bindParam(':loc_i', $_POST['local_id'], PDO::PARAM_INT); 
$stmt->bindParam(':l_la', $_POST['currentlat'], PDO::PARAM_STR); 
$stmt->bindParam(':l_lon', $_POST['currentlng'], PDO::PARAM_STR);
$stmt->execute();
     		
echo "<meta http-equiv='refresh' content='0;url=index.php?place_g_fac=1&all_proj=1&pid=".$_REQUEST['pid']."'>";

exit;
		
}
// End Marker Update
	  
// Show multiple locations
				  
if(!isset($_REQUEST['pid']))
{
	for($i=0; $i< $rows; $i++)
	{ 
    $fac_lat[$i]=$results[$i]['facility_lat'];
	$fac_long[$i]=$results[$i]['facility_long'];
	$fac_name[$i]=$results[$i]['facility_nam'];
	$fac_id[$i]=$results[$i]['facility_id_num'];
	$proj_id[$i]=$results[$i]['project_id'];
    }
	$count_fac=$rows;
	$center_lat=$center_lat;
	$center_long=$center_long;
} elseif(isset($_REQUEST['pid']))
	{
	$fac_lat[0]=$results['facility_lat'];
	$fac_long[0]=$results['facility_long'];
	$fac_name[0]=$results['facility_nam'];
	$fac_id[0]=$results['facility_id_num'];
	$proj_id[0]=$results['project_id'];
	$count_fac=1;
	$center_lat=$center_lat;
	$center_long=$center_long;
	}

			 if($fac_lat!='' and $fac_long!='')

                    {

                      ?>
                        
<!--Shows all locations (alllocs) -->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script type="text/javascript">
var points=[];
var r_start_lat;
var r_start_lng;
var r_end_lat;
var r_end_lng;
var r_point;
var map;
window.onload = function () {

	 var fac_lat=new Array();

	 var fac_long=new Array();

	 var fac_name=new Array();

	var fac_id=new Array();
	
	var proj_id=new Array();

	var markers = new Array();
	
	var totalelem=0;
	
	var centerlat=55
	var centerlong=-94
	var zoom=12
	var minlat=<?php echo $min_max_results['MIN(facility_lat)']; ?>;
	var minlong=<?php echo $min_max_results['MIN(facility_long)']; ?>;
	var maxlat=<?php echo $min_max_results['MAX(facility_lat)']; ?>;
	var maxlong=<?php echo $min_max_results['MAX(facility_long)']; ?>;
	var latlongcenter= new google.maps.LatLng(centerlat, centerlong, false);
	var latlongsw = new google.maps.LatLng(minlat, minlong, false);
	var latlongne = new google.maps.LatLng(maxlat, maxlong, false);
	var bounds = new google.maps.LatLngBounds(latlongsw, latlongne);

	totalelem='<?php echo $count_fac; ?>';
	
	 <?php for($i=0;$i<$count_fac;$i++){ ?>

    fac_lat[<?php echo $i; ?>]='<?php echo $fac_lat[$i]; ?>';

	fac_long[<?php echo $i; ?>]='<?php echo $fac_long[$i]; ?>';

	fac_name[<?php echo $i; ?>]='<?php echo $fac_name[$i]; ?>';

	fac_id[<?php echo $i; ?>]='<?php echo $fac_id[$i]; ?>';
	
	proj_id[<?php echo $i; ?>]='<?php echo $proj_id[$i]; ?>';
	
	markers[<?php echo $i; ?>]='<?php echo $fac_lat[$i]; ?>, <?php echo $fac_long[$i]; ?>';

    <?php } ?>

   var latlng = new google.maps.LatLng(<?php echo $center_lat;?>,<?php echo $center_long; ?>);

    map = new google.maps.Map(document.getElementById('mapCanvas'), {

       center: latlng,

        zoom: 12,

        mapTypeId: google.maps.MapTypeId.ROADMAP

    });

	 for (i = 0; i <fac_lat.length; i++) {

	var lat = fac_lat[i]

	var long = fac_long[i]

	var facName = fac_name[i]

	var projId = proj_id[i]

    var myLatlng = new google.maps.LatLng(lat,long);
	
    var marker = new google.maps.Marker({

        position: myLatlng,

        map: map,

		titlelat:lat,

		titlelong:long,

		titlename:facName,

		titleid:projId,

		draggable: true

    });

	marker.setIcon('http://maps.google.com/mapfiles/ms/icons/red-dot.png');

	 google.maps.event.addListener(marker, 'dragend', function(a) {

        console.log(a);

        var div = document.createElement('div');

       /* div.innerHTML = a.latLng.lat().toFixed(6) + ', ' + a.latLng.lng().toFixed(6);*/

		div.innerHTML = a.latLng.lat() + ', ' + a.latLng.lng();

    	var currentLat=a.latLng.lat();

		var currentLng=a.latLng.lng();

		var titlelat =this.titlelat;

		var titlelong =this.titlelong;

		var titleid =this.titleid;

		document.getElementById('Status').innerHTML=div.innerHTML;

		document.getElementById('currentlat').value=currentLat;

		document.getElementById('currentlng').value=currentLng;

	    document.getElementById('oldlat').value=titlelat;

	    document.getElementById('oldlng').value=titlelong;

		document.getElementById('local_id').value=titleid;
	
    });

	var infowindow = new google.maps.InfoWindow();

	google.maps.event.addListener(marker, 'click', function() {

    var windowmsg='Lat='+this.titlelat+'<br/><br/>Long='+this.titlelong;

	var localeCurrentName=this.titlename;

		infowindow.setContent(windowmsg+'<br/><br/>Facility Name='+localeCurrentName);

	// infowindow.setContent(windowmsg);

   infowindow.open(map,this);

});

	
map.fitBounds(bounds);
	 
	 }
	 var searchUrl = 'showxml.php';
       downloadUrl(searchUrl, function(data) {	   
       var xml = parseXml(data);
	   console.log(xml);
       var markerNodes = xml.documentElement.getElementsByTagName("marker");
       var bounds = new google.maps.LatLngBounds();
       for (var i = 0; i < markerNodes.length; i++) {
       var latlng = markerNodes[i].getAttribute("position");	 
	   
	drawpolygon(latlng);
    }
    });

};
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
  console.log(polygon);
}


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

<?php

//

        if(isset($_REQUEST['pid']))

        {

            $sql4=mysql_query("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");

            $row4=mysql_fetch_array($sql4);

        }?>


<!--Breadcrumb -->

<h2 id="com_name"> Breadcrumb.

 </h2>


<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>

<div id="mapCanvas"></div>

<div id="hiddentxt"></div>


<div id="infoPanel"> <b class='markerFontStatus'>Marker status: Please Select Marker One By One</b>

  <div id="Status" class="markerFontStatus"></div>

  <div id="markerStatus" class="markerFontStatus"><i></i></div>

  <!--<b>Current position:</b>-->

  <div id="info"></div>

  <!-- <b>Closest matching address:</b>-->

  <form action="" method="post">

    <input type="hidden" name="local_id" id="local_id"/>

    <input type="hidden" name="oldlat" id="oldlat">

    <input type="hidden" name="oldlng" id="oldlng">

    <input type="hidden" name="currentlat" id="currentlat">

    <input type="hidden" name="currentlng" id="currentlng"/>

    <input type="submit" class="submit" value=""/>

  </form>

</div>

<?php

 	}

?>