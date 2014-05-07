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

if(isset($_REQUEST['group_locs'])) 
{

// Get Lat/Long for Task Group Locations
$sql_lat_long = $DBH->prepare("SELECT location_to_group.loc_id, loc_name, location_info.l_lat, location_info.l_long FROM location_to_group, location_info WHERE location_to_group.loc_id=location_info.loc_id AND loc_group_id='".$_REQUEST['lgid']."'");
$sql_lat_long->execute();
$results = $sql_lat_long->fetchAll();
$rows = $sql_lat_long->rowCount();

	// Define Zoom window for Task Group Locations
$min_max = $DBH->prepare("SELECT MIN(l_lat), MIN(l_long), MAX(l_lat), MAX(l_long) FROM location_to_group, location_info WHERE location_to_group.loc_id=location_info.loc_id AND loc_group_id='".$_REQUEST['lgid']."'");
$min_max->execute();
$min_max_results = $min_max->fetch();

if($rows > 0) 
	{    	
	// Center map on Task Group Locations
  $latsum=0;
  $longsum=0;
  foreach($results as $row) 
  		{ 
  if(isset($row['l_lat']) && isset($row['l_long'])) 
  			{
	$latsum= $row['l_lat']+$latsum;
    $longsum= $row['l_long']+$longsum;
			} 
   		}
   $center_lat=$latsum/$rows;
  $center_long=$longsum/$rows;  
	}
}
elseif(isset($_REQUEST['this_proj_all_locs'])) 
{
// Get Lat/Long for all locations for a chosen Project
$sql_lat_long = $DBH->prepare("SELECT * FROM location_to_project, location_info WHERE location_info.l_lat IS NOT NULL AND location_info.l_long IS NOT NULL AND location_to_project.loc_id = location_info.loc_id AND project_id = '".$_REQUEST['pid']."'");
$sql_lat_long->execute();
$results = $sql_lat_long->fetchAll();
$rows = $sql_lat_long->rowCount();

$min_max = $DBH->prepare("SELECT MIN(l_lat), MIN(l_long), MAX(l_long), MAX(l_lat) FROM location_info, location_to_project WHERE location_to_project.loc_id = location_info.loc_id AND project_id = '".$_REQUEST['pid']."'");
$min_max->execute();
$min_max_results = $min_max->fetch();

if($rows > 0) 
	{
	// Center map on all Projects (Facilities)
  $latsum=0;
  $longsum=0;
  foreach($results as $row) 
  		{ 
	$latsum= $row['l_lat']+$latsum;
    $longsum= $row['l_long']+$longsum;
   		}
    $center_lat=$latsum/$rows;
  $center_long=$longsum/$rows; 
	}
}
elseif(isset($_REQUEST['this_proj_sel_locs'])) 
{

// Get Lat/Long for selected locations for a chosen Project
$sql_lat_long = $DBH->prepare("SELECT * FROM location_to_project, location_info WHERE location_info.l_lat IS NOT NULL AND location_info.l_long IS NOT NULL && location_info.active_bool=1 AND location_to_project.loc_id = location_info.loc_id AND project_id = '".$_REQUEST['pid']."'
 ");
$sql_lat_long->execute();
$results = $sql_lat_long->fetchAll();
$rows = $sql_lat_long->rowCount();

$min_max = $DBH->prepare("SELECT MIN(l_lat), MIN(l_long), MAX(l_long), MAX(l_lat) FROM location_info, location_to_project WHERE location_info.active_bool=1 && location_to_project.loc_id = location_info.loc_id AND project_id = '".$_REQUEST['pid']."'");
$min_max->execute();
$min_max_results = $min_max->fetch();

if($rows > 0) 
	{    
	
	// Center map on all active Project Locations
  $latsum=0;
  $longsum=0;
  foreach($results as $row) 
  		{ 
  if(isset($row['l_lat']) && isset($row['l_long'])) 
  			{
	$latsum= $row['l_lat']+$latsum;
    $longsum= $row['l_long']+$longsum;
			}
   		}
    $center_lat=$latsum/$rows;
  $center_long=$longsum/$rows;  
	}
}
elseif(isset($_REQUEST['sel_loc'])) 
{
	
// Get Lat/Long for the (single) Location
$sql_lat_long = $DBH->prepare("SELECT * FROM location_info WHERE loc_id='".$_REQUEST['lid']."'");
$sql_lat_long->execute();
$results = $sql_lat_long->fetch();
$rows=1;

$min_max = $DBH->prepare("SELECT MIN(l_lat), MIN(l_long), MAX(l_long), MAX(l_lat) FROM location_info WHERE loc_id='".$_REQUEST['lid']."'");
$min_max->execute();
$min_max_results = $min_max->fetch();

$center_lat=$results['l_lat'];
$center_long=$results['l_long'];

}
// End Queries

// Map Marker Update

 if(isset($_REQUEST['oldlat']))

  {

$sql = "UPDATE location_info SET 
l_lat = :l_la, 
l_long = :l_lon
WHERE loc_id = :loc_i
";

$stmt = $DBH->prepare($sql);
$stmt->bindParam(':loc_i', $_POST['local_id'], PDO::PARAM_INT); 
$stmt->bindParam(':l_la', $_POST['currentlat'], PDO::PARAM_STR); 
$stmt->bindParam(':l_lon', $_POST['currentlng'], PDO::PARAM_STR);
$stmt->execute();
     		
echo "<meta http-equiv='refresh' content='0;url=index.php?place_g_loc=1&this_proj_all_locs=1&pid=".$_REQUEST['pid']."'>";

exit;
		
}
?>		

<?php
	  
// Show multiple locations
				  
if(!isset($_REQUEST['lid']))
{
	for($i=0; $i< $rows; $i++)
	{ 
    $locale_lat[$i]=$results[$i]['l_lat'];
	$locale_long[$i]=$results[$i]['l_long'];
	$locale_name[$i]=$results[$i]['loc_name'];
	$locale_id[$i]=$results[$i]['loc_id'];
    }
	$count_locale=$rows;
	$center_lat=$center_lat;
	$center_long=$center_long;
} elseif(isset($_REQUEST['lid']))
	{
	$locale_lat[0]=$results['l_lat'];
	$locale_long[0]=$results['l_long'];
	$locale_name[0]=$results['loc_name'];
	$locale_id[0]=$results['loc_id'];
    
	$count_locale=1;
	$center_lat=$center_lat;
	$center_long=$center_long;
	}

			 if($locale_lat!='' and $locale_long!='')

                    {

                      ?>
                        
<!--Shows all locations (alllocs) -->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script type="text/javascript">

window.onload = function () {

	 var locale_lat=new Array();

	 var locale_long=new Array();

	 var locale_name=new Array();

	var locale_id=new Array();

	var markers = new Array();
	
	var totalelem=0;
	
	var centerlat=55
	var centerlong=-94
	var zoom=12
	var minlat=<?php echo $min_max_results['MIN(l_lat)']; ?>;
	var minlong=<?php echo $min_max_results['MIN(l_long)']; ?>;
	var maxlat=<?php echo $min_max_results['MAX(l_lat)']; ?>;
	var maxlong=<?php echo $min_max_results['MAX(l_long)']; ?>;
	var latlongcenter= new google.maps.LatLng(centerlat, centerlong, false);
	var latlongsw = new google.maps.LatLng(minlat, minlong, false);
	var latlongne = new google.maps.LatLng(maxlat, maxlong, false);
	var bounds = new google.maps.LatLngBounds(latlongsw, latlongne);

	totalelem='<?php echo $count_locale; ?>';
	
	 <?php for($i=0;$i<$count_locale;$i++){ ?>

    locale_lat[<?php echo $i; ?>]='<?php echo $locale_lat[$i]; ?>';

	locale_long[<?php echo $i; ?>]='<?php echo $locale_long[$i]; ?>';

	locale_name[<?php echo $i; ?>]='<?php echo $locale_name[$i]; ?>';

	locale_id[<?php echo $i; ?>]='<?php echo $locale_id[$i]; ?>';
	
	markers[<?php echo $i; ?>]='<?php echo $locale_lat[$i]; ?>, <?php echo $locale_long[$i]; ?>';

    <?php } ?>

   var latlng = new google.maps.LatLng(<?php echo $center_lat;?>,<?php echo $center_long; ?>);

    var map = new google.maps.Map(document.getElementById('mapCanvas'), {

       center: latlng,

        zoom: 12,

        mapTypeId: google.maps.MapTypeId.ROADMAP

    });

	 for (i = 0; i <locale_lat.length; i++) {

	var lat = locale_lat[i]

	var long = locale_long[i]

	var localeName = locale_name[i]

	var localeId = locale_id[i]

    var myLatlng = new google.maps.LatLng(lat,long);
	
    var marker = new google.maps.Marker({

        position: myLatlng,

        map: map,

		titlelat:lat,

		titlelong:long,

		titlename:localeName,

		titleid:localeId,

		draggable: true

    });

	marker.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');

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

		infowindow.setContent(windowmsg+'<br/><br/>Location Name='+localeCurrentName);

	// infowindow.setContent(windowmsg);

   infowindow.open(map,this);

});

	
map.fitBounds(bounds);
	 
	 }

};

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

    <input type="submit"  name="loc_submit" class="submit" value=""/>

  </form>

</div>

<?php

 	}  // Locations exist
	?>	
