<!DOCTYPE html>

<html> 

<head> 

  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 

  <title>Google Maps Multiple Markers</title> 

  <script src="http://maps.google.com/maps/api/js?sensor=false" 

          type="text/javascript"></script>

</head> 

<body>

<?php include('config.php');



$count_id=0;

 $select_loc=mysql_query("SELECT * FROM location_info WHERE active_bool=1");    

                while($get_loc=mysql_fetch_assoc($select_loc))

                {

                    if($get_loc['l_lat']!='' and $get_loc['l_long']!='')

                    {    

                       // $address[$count_id]=$get_loc['address'];

                        $lat[$count_id]=$get_loc['l_lat'];

                       // echo $lat[$count_id];

					    $lon[$count_id]=$get_loc['l_long'];









?>

  <div id="map" style="width: 500px; height: 400px;"></div>



  <script type="text/javascript">

   

  var locations=new Array();

     

     locations = [

    <?php for($i=0;$i<$count_id;$i++){ ?>

        

      [address[<?php echo $i; ?>],finalElemlat[<?php echo $i; ?>],finalElemlong[<?php echo $i; ?>],<?php echo $i."]"; if($i!=$count_id-1){echo ",";}else{ echo "";}?>

          <?php }?>

      ];



    var map = new google.maps.Map(document.getElementById('map'), {

      zoom: 10,

      center: new google.maps.LatLng(<?php echo $lat[$count_id];?>,<?php echo $lon[$count_id];?>),

      mapTypeId: google.maps.MapTypeId.ROADMAP

    });



    var infowindow = new google.maps.InfoWindow();



    var marker, i;



    for (i = 0; i < locations.length; i++) {  

      marker = new google.maps.Marker({

        position: new google.maps.LatLng(locations[i][1], locations[i][2]),

        map: map

      });



      google.maps.event.addListener(marker, 'click', (function(marker, i) {

        return function() {

          infowindow.setContent(locations[i][0]);

          infowindow.open(map, marker);

        }

      })(marker, i));

    }

	

 </script>

<?php  $count_id++;

        }

                }?>

</body>

</html>