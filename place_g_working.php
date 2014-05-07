<style>
#mapCanvas {
	width: 988px;
	height: 500px;
	float: left;
}

#googleMap{
	width: 988px;
	height: 500px;
	float: left;
	}

	#googleMapFac{
	width: 988px;
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

  $center_lat=0;
  $center_long=0;

// Get Lat/Long for all Projects (Facilites)

$sql_allprojects_lat_long = $DBH->prepare("SELECT facility_id_num, facility_nam, facility_lat, facility_long FROM project_info WHERE facility_lat!=0 AND facility_long!=0");
$sql_allprojects_lat_long->execute();
$all_project_results = $sql_allprojects_lat_long->fetchAll();
$allfacility_lat_long_rows = $sql_allprojects_lat_long->rowCount();

if($allfacility_lat_long_rows > 0) 
{
	// Center map on all Projects (Facilities)
  $latsum=0;
  $longsum=0;
  foreach($all_project_results as $row) 
  { 
	$latsum= $row['facility_lat']+$latsum;
    $longsum= $row['facility_long']+$longsum;
   }
  $center_lat=$latsum/$allfacility_lat_long_rows;
  $center_long=$longsum/$allfacility_lat_long_rows;
}

// Get Lat/Long for active Projects (Facilites)
$sql_activeprojects_lat_long = $DBH->prepare("SELECT facility_id_num, facility_nam, facility_lat, facility_long FROM project_info WHERE active_bool=1");
$sql_activeprojects_lat_long->execute();
$active_facility_lat_long_rows = $sql_activeprojects_lat_long->rowCount();

if($active_facility_lat_long_rows > 0) 
{  
	// Center map on all active Projects (Facilites)
  $latsum=0;
  $longsum=0;
  foreach($sql_activeprojects_lat_long as $row) 
  { 
  if(isset($row['facility_lat']) && isset($row['facility_long'])) 
  	{
	$center_lat= $row['facility_lat']+$latsum;
    $longsum= $row['facility_long']+$longsum;
	}
   }
  $center_lat=$latsum/$active_facility_lat_long_rows;
  $center_long=$longsum/$active_facility_lat_long_rows; 
}


// Get Lat/Long for the selected Project (Facility)
$sql_activeprojects_lat_long = $DBH->prepare("SELECT facility_id_num, facility_nam, facility_lat, facility_long FROM project_info WHERE project_id = '".$_REQUEST['pid']."'");
$sql_activeprojects_lat_long->execute();


// Get Lat/Long for Task Group Locations
$sql_group_lat_long = $DBH->prepare("SELECT * FROM location_to_task, location_info WHERE location_to_task.loc_id = location_info.loc_id AND task_id = '".$_REQUEST['tid']."'");
$sql_group_lat_long->execute();
$group_lat_long_rows = $sql_group_lat_long->rowCount();
if($group_lat_long_rows > 0) 
{    	
	// Center map on all active Projects (Facilites)
  $latsum=0;
  $longsum=0;
  foreach($sql_group_lat_long as $row) 
  { 
  if(isset($row['l_lat']) && isset($row['l_long'])) 
  	{
	$latsum= $row['l_lat']+$latsum;
    $longsum= $row['l_long']+$longsum;
	}
   }
  $center_lat=$latsum/$group_lat_long_rows;
  $center_long=$longsum/$group_lat_long_rows; 
}


// Get Lat/Long for all locations for a chosen Project
$sql_proj_locs_lat_long = $DBH->prepare("SELECT * FROM location_to_project, location_info WHERE location_to_project.loc_id = location_info.loc_id AND project_id = '".$_REQUEST['pid']."'");
$sql_proj_locs_lat_long->execute();
$proj_locs_lat_long_rows = $sql_proj_locs_lat_long->rowCount();
if($proj_locs_lat_long_rows > 0) 
{    	
	// Center map on all Project Locations
  $latsum=0;
  $longsum=0;
  foreach($sql_proj_locs_lat_long as $row) 
  { 
  if(isset($row['l_lat']) && isset($row['l_long'])) 
  	{
	$latsum= $row['l_lat']+$latsum;
    $longsum= $row['l_long']+$longsum;
	}
   }
  $center_lat=$latsum/$proj_locs_lat_long_rows;
  $center_long=$longsum/$proj_locs_lat_long_rows; 
}

// Get Lat/Long for all seelcted locations for a chosen Project
$sql_act_proj_locs_lat_long = $DBH->prepare("SELECT * FROM location_to_project, location_info WHERE location_info.active_bool=1 AND location_to_project.loc_id = location_info.loc_id AND project_id = '".$_REQUEST['pid']."'");
$sql_act_proj_locs_lat_long->execute();
$act_proj_locs_lat_long_rows = $sql_act_proj_locs_lat_long->rowCount();
if($act_proj_locs_lat_long_rows > 0) 
{    
	
	// Center map on all active Project Locations
  $latsum=0;
  $longsum=0;
  foreach($sql_act_proj_locs_lat_long as $row) 
  { 
  if(isset($row['l_lat']) && isset($row['l_long'])) 
  	{
	$latsum= $row['l_lat']+$latsum;
    $longsum= $row['l_long']+$longsum;
	}
   }
  $center_lat=$latsum/$proj_locs_lat_long_rows;
  $center_long=$longsum/$proj_locs_lat_long_rows; 
}


// Get Lat/Long for the Location
$sql_loc_lat_long = $DBH->prepare("SELECT loc_desc, l_long, l_lat, loc_name, loc_id FROM location_info WHERE loc_id= '".$_REQUEST['lid']."'");
$sql_loc_lat_long->execute();
	
// End Queries

    $x=0;
    $count_id=0;
	$count_locale=0;
	$count_id_lat=0;
    $latitude=0;
    $logitude=0;
    $address[0]='';
	
//All Project (faciilties)

/*if(!isset($_REQUEST['pid']))
{ */


// }

?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">

window.onload = function () {

	 var locale_lat=new Array();

	 var locale_long=new Array();

	 var locale_name=new Array();

	var locale_id=new Array();

	 var totalelem=0;

	totalelem='<?php echo $allfacility_lat_long_rows; ?>';

    
<?php echo "here."; ?>
	 <?php for($i=0; $i< $allfacility_lat_long_rows; $i++){ ?>

    locale_lat[<?php echo $i; ?>]='<?php echo $all_project_results[$i][facility_lat]; ?>';

	locale_long[<?php echo $i; ?>]='<?php echo $all_project_results[$i][facility_long]; ?>';

	locale_name[<?php echo $i; ?>]='<?php echo $all_project_results[$i][facility_nam]; ?>';

	locale_id[<?php echo $i; ?>]='<?php echo $all_project_results[$i][facility_id_num]; ?>';

    <?php } ?>

   var latlng = new google.maps.LatLng(<?php echo $center_lat;?>,<?php echo $center_long;?>);

  

    var map = new google.maps.Map(document.getElementById('mapCanvas'), {

       center: latlng,

        zoom: 22,

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

		//var FacAddress =this.titleFac;

		//var FacilityName =this.FacName;

		

		//alert(FacAddress);

		//alert(FacilityName);

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

	

	var fac_msg='Facility Address= Still Coding This.';

	

	var localeCurrentName=this.titlename;

	if(!this.FacName=='')

	{

	 infowindow.setContent(fac_msg+'<br/><br/>Locales Name= Still Coding');

	}

	else

	{

		infowindow.setContent(windowmsg+'<br/><br/>Locales Name= Oops');

		}

	// infowindow.setContent(windowmsg);

   infowindow.open(map,this);

});

	

	 }

};

</script>	


<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>

<div id="mapCanvas"></div>

<div id="hiddentxt"></div>



<input type="hidden" name="avg_lat" id="avg_lat" value="<?php if(isset($avg_lat)) { echo $avg_lat; } ?>" />

<input type="hidden" name="avg_log" id="avg_log" value="<?php if(isset($avg_log)) { echo $avg_log; } ?>" />

<!-- <input type="text"  name="latlongnew" id="latlongnew"/>-->

<div id="infoPanel"> <b class='markerFontStatus'>Marker status: Please Select Marker One By One</b>

  <div id="Status" class="markerFontStatus"></div>

  <div id="markerStatus" class="markerFontStatus"><i></i></div>

  <!--<b>Current position:</b>-->

  <div id="info"></div>

  <!-- <b>Closest matching address:</b>-->

  <form action="" method="post">

    <input type="hidden" name="addre" id="address1">

    <input type="hidden" name="marker_lat" id="marker_lat">

    <input type="hidden" name="marker_lng" id="marker_lng">

    <input type="hidden" name="title" id="title"/>

   

    <input type="hidden" name="oldlat" id="oldlat">

    <input type="hidden" name="oldlng" id="oldlng">

    <input type="hidden" name="currentlat" id="currentlat">

    <input type="hidden" name="currentlng" id="currentlng"/>

   

    <input type="submit"  class="submit" value=""/>

  </form>

</div>

<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">

</script>



<script>


function initialize()

{

var mapOpt = {

  center:new google.maps.LatLng(46.04440378292747, -94.62455749511719 ),

  zoom:16,

  mapTypeId:google.maps.MapTypeId.ROADMAP

  };

var map=new google.maps.Map(document.getElementById("googleMapFac"),mapOpt);

}



google.maps.event.addDomListener(window, 'load', initialize);

</script>