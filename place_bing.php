<?php 



    if(!isset($_SESSION['pm']))

    {

        header("location:login.php");

    }



// $cities_in_country[0]="219 Wardell Road, Dulwich Hill NSW 2203, Australia";

// $cities_in_country[1]="45 Anglo Road, Campsie NSW 2194, Australia";

// $cities_in_country[2]="LOT 11 Pile Street, Bardwell Valley NSW 2207, Australia";

// $cities_in_country[3]="114 Silver Street, Marrickville NSW 2204, Australia";

// $cities_in_country[4]="Perimeter Road, Sydney Airport (SYD), Mascot NSW 2020, Australia";



    

?>



<?php include('config.php');



    $x=0;

    $count_com=0;

    $count_id=0;

	$count_id_lat=0;

    $count_loc=0;

    $latitude=0;

    $logitude=0;

    $address[0]='';

    $lat[0]='';

    $lon[0]='';



 		if(isset($_REQUEST['cid']))

        {

               $sql2=mysql_query("SELECT * FROM company_info WHERE company_id='".$cid_decode."'");

                $row1=mysql_fetch_array($sql2);

        }

        if(isset($_REQUEST['fid']))

        { 

             $sql3=mysql_query("SELECT * FROM facility_info WHERE facility_id='".$fid_decode."'");

             $row3=mysql_fetch_array($sql3);

        }

        if(isset($_REQUEST['pid']))

        {

            $sql4=mysql_query("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");

            $row4=mysql_fetch_array($sql4);

        }

            

            $select_fac=mysql_query("SELECT * FROM facility_info WHERE active_bool=1");    

            while($get_fac=mysql_fetch_assoc($select_fac))

            {

                if($get_fac['address']!='')

                {    

                    $address[$count_id]=$get_fac['address'];

                    if($get_fac['state']!='')

                    {

                        $address[$count_id].=",&nbsp;";

                    }

                

                    if($get_fac['state']!='')

                    {    

                        $address[$count_id].=$get_fac['state'];

                        if($get_fac['county']!='')

                        {

                            $address[$count_id].=",&nbsp;";

                        }

                

                        if($get_fac['county']!='')

                        {    

                            $address[$count_id].=$get_fac['county'];

                        }

                      }

					$count_id++;

                }

				

                if($get_fac['lat']!='')

                            {

                                $lat[$count_id_lat]=$get_fac['lat'];

                    

                                if($get_fac['long_fac']!='')

                                {

                                    $lon[$count_id_lat]=$get_fac['long_fac'];

                                    $count_id_lat++;

                                }

                            }        

            }

                



                $select_loc=mysql_query("SELECT * FROM location_info WHERE active_bool=1");    

                while($get_loc=mysql_fetch_assoc($select_loc))

                {

                    if($get_loc['l_lat']!='' and $get_loc['l_long']!='')

                    {    

                        $address[$count_id]=$get_loc['address'];

                        $lat[$count_id]=$get_loc['l_lat'];

                        $lon[$count_id]=$get_loc['l_long'];

                        $count_id++;

                    }

                }

                

             

              if(isset($count_id_lat))

            {

                for($i=0;$i<$count_id_lat;$i++)

                {

                    $latitude=$lat[$i]+$latitude;

                    $logitude=$lon[$i]+$logitude;

                

                }

            }

        

            if($count_id!=0)

            {

                $avg_lat=$latitude/$count_id;

                $avg_log=$logitude/$count_id;

            }

 // print_r($address);


// print_r($lat);

// print_r($lon);

?>

<h2><h2 id="com_name"><a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " ><?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?></a><a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" ><?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?></a><a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>"><?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?></a><a href=""><?php if(isset($row5['sl_type'])) { echo $row5['sl_type']."&nbsp >"; } ?> </a><a href="index.php?upload_locationsale=1&amp;lid=<?php if(isset($_REQUEST['lid'])) {  echo $lid_encode; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) {  echo $pid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>"><?php if(isset($row['loc_name'])) { echo $row['loc_name']." &nbsp;- &nbsp;"; } ?></a> <a style="font-size:18px;" href="index.php?place_g=1&amp;lid=<?php if(isset($_REQUEST['lid'])) { echo $lid_encode; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">Map</a></h2>

 <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>

<?php 

if($address[0]!='' and $lat[0]!='' and $lon[0]!='')

{

?>

<script charset="UTF-8" type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>

<script>

    var pinInfoBox;  //the pop up info box

    var infoboxLayer = new Microsoft.Maps.EntityCollection();

    var pinLayer = new Microsoft.Maps.EntityCollection();

    var apiKey = "YourKey";



    function GetMap() {

    	

		var lati=<?php echo json_encode($lat); ?>;

    	var longi=<?php echo json_encode($lon); ?>;

    	var address=<?php print_r(json_encode($address)); ?>;

    	var avg_lat=<?php echo $avg_lat; ?>;

    	var avg_log=<?php echo $avg_log; ?>;

        var mapOptions = {

         credentials: "Your Bing Maps Key",

         center: new Microsoft.Maps.Location(avg_lat,avg_log),

         mapTypeId: Microsoft.Maps.MapTypeId.birdseye,

         zoom: 3,

         showScalebar: false

         }



         var map = new Microsoft.Maps.Map(document.getElementById("map"), mapOptions);



        // Create the info box for the pushpin

        pinInfobox = new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(0, 0), { visible: false });

        infoboxLayer.push(pinInfobox);





        for (var i = 0 ; i <3; i++){

            //add pushpins

            var latLon = new Microsoft.Maps.Location(lati[i],longi[i]);

            var pin = new Microsoft.Maps.Pushpin(latLon);

            pin.Title = name;//usually title of the infobox

            pin.Description =address[i]; //information you want to display in the infobox

            pinLayer.push(pin); //add pushpin to pinLayer

            Microsoft.Maps.Events.addHandler(pin, 'click', displayInfobox);

        }



        map.entities.push(pinLayer);

        map.entities.push(infoboxLayer);



    }



    function displayInfobox(e) {

        pinInfobox.setOptions({title: e.target.Title, description: e.target.Description, visible:true, offset: new Microsoft.Maps.Point(0,25)});

        pinInfobox.setLocation(e.target.getLocation());

    }



    function hideInfobox(e) {

        pinInfobox.setOptions({ visible: false });

    }

</script>



<style>

    #map { position: absolute; top: 20; left: 10;  width:150%; margin-left:282; margin-top:138px; height: 500px; border:#555555 2px solid;}

</style>



<body onload="GetMap()">

    <div id="map">

    </div>

</body>



 <?php 

 }

if($address[0]!='' and $lat[0]=='' and $lon[0]=='')

      {

   	

    if(isset($_REQUEST['lid']))

        {     

            $sql=mysql_query("SELECT * FROM location_info WHERE loc_id='".$lid_decode."'");

            $count_location=mysql_num_rows($sql);

            if($count_location<1)

            {

                echo "<meta http-equiv='refresh' content='0;url=login.php?logout'>";

            }

            $row=mysql_fetch_array($sql);

            if(isset($row['sl_type_id']))

            {

                $sl_typeid=$row['sl_type_id'];

                $locationtype=mysql_query("SELECT sl_type FROM sample_location_types WHERE sl_type_id='".$sl_typeid."'");

                $get_locationtype=mysql_fetch_assoc($locationtype);

            }

            if(isset($row['sl_type_id']))

            {

                 $sql5=mysql_query("SELECT sl_type FROM sample_location_types WHERE sl_type_id='".$row['sl_type_id']."'");

                $row5=mysql_fetch_assoc($sql5);

                $loc_desc=substr($row['loc_desc'],0,140);

            }  

            

        }

          if(isset($_REQUEST['cid']))

          {

               $sql2=mysql_query("SELECT * FROM company_info WHERE company_id='".$cid_decode."'");

                $row1=mysql_fetch_array($sql2);

          }

          if(isset($_REQUEST['fid']))

          { 

             $sql3=mysql_query("SELECT * FROM facility_info WHERE facility_id='".$fid_decode."'");

             $row3=mysql_fetch_array($sql3);

          }

          if(isset($_REQUEST['pid']))

          {

            $sql4=mysql_query("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");

            $row4=mysql_fetch_array($sql4);

          }

?>



    <link href='http://fonts.googleapis.com/css?family=Lato:bolditalic' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/example.css" />



<div id="map_addresses" class="map">

   

</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>

<script type="text/javascript" src="js/jquery.gmap.js"></script>

<script type="text/javascript" charset="utf-8">

$(function()

{

   var phparray = <?php echo json_encode($address); ?>;    

   var geocoder = new google.maps.Geocoder(); 

   $('#map').gMap();

   

   $('#map_controls').gMap(

   {

        latitude: -2.206,

        longitude: -79.897,

        maptype: 'SATELLITE', // 'HYBRID', 'SATELLITE', 'ROADMAP' or 'TERRAIN'

        zoom: 8,

        controls: {

            panControl: true,

            zoomControl: false,

            mapTypeControl: true,

            scaleControl: false,

            streetViewControl: false,

            overviewMapControl: false

        }

   });

   // $.each(phparray, function (i, elem) {

 // alert(elem);

// 

   // var address2=elem;

   // alert(address2);



    // geocoder.geocode( { 'address': address2}, function(results) {

            // alert(results[0].geometry.location);

            // map.setCenter(results[0].geometry.location);



    // });





    // });

   

   $.each(phparray, function (i, elem) {

   $('#map_addresses').gMap({

        address: elem,

        zoom: 8,

        markers:[

                        

            {

                address: elem,

                html: "_address"

            }

        ]

    });

    geocoder.geocode( { 'address': elem}, function(results) {

            alert(results[0].geometry.location);

       });

   

    });



    $("#map_extended").gMap({

        controls: false,

        scrollwheel: true,

        maptype: 'TERRAIN',

        markers: [

            {

                latitude: 47.670553,

                longitude: 9.588479,

                icon: {

                    image: "images/gmap_pin_orange.png",

                    iconsize: [26, 46],

                    iconanchor: [12,46]

                }

            },

            {

                latitude: 47.65197522925437,

                longitude: 9.47845458984375

            },

            {

                latitude: 47.594996,

                longitude: 9.600708,

                icon: {

                    image: "images/gmap_pin_grey.png",

                    iconsize: [26, 46],

                    iconanchor: [12,46]

                }

            }

        ],

        icon: {

            image: "images/gmap_pin.png", 

            iconsize: [26, 46],

            iconanchor: [12, 46]

        },

        latitude: 47.58969,

        longitude: 9.473413,

        zoom: 10

    });

});

</script>



<?php 

      }

 ?>