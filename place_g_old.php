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

    $x=0;
    $count_id=0;
	$count_locale=0;
	$count_id_lat=0;
    $latitude=0;
    $logitude=0;
    $address[0]='';


$sql=mysql_query("SELECT * FROM  facility_to_company WHERE project_id='".$_REQUEST['pid']."'");

							  	 while($row=mysql_fetch_array($sql))

							  	{  

							     

					 $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$row['facility_id']."' and active_bool=1"); 

						while($get_fac=mysql_fetch_assoc($select_fac))

                             {

                if($get_fac['address']!='')

                {    

                     $address[$count_id]=$get_fac['address'];

					$facility_nam[$count_id]=$get_fac['facility_nam'];

					 if($get_fac['state']!='')

                    {

                        $address[$count_id].=",&nbsp;";

                    }

                if($get_fac['facility_id']!='')

                { 

				 $facility_id[$count_id]=$get_fac['facility_id'];  

				

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

		} 


if(isset($_REQUEST['fid']))

			{

	    	$select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$fid_decode."'"); 

			 while($get_fac=mysql_fetch_assoc($select_fac))

            {

                if($get_fac['address']!='')

                {    

                      $address[$count_id]=$get_fac['address'];

				      $facility_nam[$count_id]=$get_fac['facility_nam'];

					
                    if($get_fac['state']!='')

                    {

                        $address[$count_id].=",&nbsp;";

                    }

                if($get_fac['facility_id']!='')

                { 

				 $facility_id[$count_id]=$get_fac['facility_id'];  

				

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

			} 

else

			{

				$sql=mysql_query("SELECT * FROM  facility_to_company WHERE project_id='".$_REQUEST['pid']."'");

							  	 while($row=mysql_fetch_array($sql))

							  	{  

							 

			 $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$row['facility_id']."' and active_bool=1"); 

		   

            while($get_fac=mysql_fetch_assoc($select_fac))

            {

                if($get_fac['address']!='')

                {    

                      $address[$count_id]=$get_fac['address'];

				    $facility_nam[$count_id]=$get_fac['facility_nam'];

                    if($get_fac['state']!='')

                    {

                        $address[$count_id].=",&nbsp;";

                    }

                if($get_fac['facility_id']!='')

                { 

				 $facility_id[$count_id]=$get_fac['facility_id'];  

				

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

			}

			}



// This code was for "show_facilites, and was needed to accomodate the address or, if not accurate, lat/long
?>
<div> <?php				if(!isset($_REQUEST['comfId']))

				{

				if(isset($_REQUEST['show_loc']))

				{

					

					$sql=mysql_query("SELECT * FROM  sample_locationtype_to_permit WHERE facility_id='".$fid_decode."'");

							  	 while($row=mysql_fetch_array($sql))

							  	{  

							  

							 	  $sql1=mysql_query("SELECT * FROM   location_info  WHERE loc_id='".$row['loc_id']."' AND active_bool=1");

							  	  while($get_loc=mysql_fetch_assoc($sql1))

                               {

				               $locale_id[$count_locale]=$get_loc['loc_id'];

							 

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						   

						  if($get_loc['l_lat']=='0' and $get_loc['l_long']=='0')

						  {

							  $select_loc=mysql_query("SELECT * FROM  location_map_info WHERE loc_id='".$get_loc['loc_id']."'"); 

							 while($get_loc=mysql_fetch_assoc($select_loc))

                               {

							   $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						    $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$get_loc['facility_id']."'"); 

						   $get_fac=mysql_fetch_assoc($select_fac);

						   $locale_fac[$count_locale]=$get_fac['address'];

						  $locale_fac_name[$count_locale]=$get_fac['facility_nam'];

							  }

						  }

						  $count_locale++;

                       }

					 

				  }

								

				}

				if(isset($_REQUEST['show_loc_direct']))

				{

					 $id=0;

					$sql=mysql_query("SELECT * FROM  facility_to_company WHERE project_id='".$_REQUEST['pid']."'");

							  	 while($row_pid=mysql_fetch_array($sql))

							  	{  

							        $fac_id[$id]= $row_pid['facility_id'];

								   $id++;

							 	  

								}

								for($i=0; $i<$id; $i++)

								{

									

					 $sql=mysql_query("SELECT * FROM  sample_locationtype_to_permit WHERE facility_id='".$fac_id[$i]."'");

							  	 while($row=mysql_fetch_array($sql))

							  	{  

							    

							 	  $sql1=mysql_query("SELECT * FROM   location_info  WHERE loc_id='".$row['loc_id']."' AND active_bool=1");

							  	  while($get_loc=mysql_fetch_assoc($sql1))

                               {

				               $locale_id[$count_locale]=$get_loc['loc_id'];

							 

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						   

						  if($get_loc['l_lat']=='0' and $get_loc['l_long']=='0')

						  {

							  $select_loc=mysql_query("SELECT * FROM  location_map_info WHERE loc_id='".$get_loc['loc_id']."'"); 

							 while($get_loc=mysql_fetch_assoc($select_loc))

                               {

							   $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						    $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$get_loc['facility_id']."'"); 

						   $get_fac=mysql_fetch_assoc($select_fac);

						   $locale_fac[$count_locale]=$get_fac['address'];

						  $locale_fac_name[$count_locale]=$get_fac['facility_nam'];

							  }

						  }

						  $count_locale++;

                       }

					 

				  }

				}

								

				}

				if(isset($_REQUEST['localeMap']))

				{

					

		  $sql1=mysql_query("SELECT * FROM   location_info  WHERE sl_type_id='".$_REQUEST['localetypeid']."' and facility_id='".$fid_decode."' and active_bool='1'");

							  	  while($get_loc=mysql_fetch_assoc($sql1))

                               {

				              $locale_id[$count_locale]=$get_loc['loc_id'];

					       $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						  

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						   if($get_loc['l_lat']=='0' and $get_loc['l_long']=='0')

						  {

							  $select_loc=mysql_query("SELECT * FROM  location_map_info WHERE loc_id='".$get_loc['loc_id']."'"); 

							 while($get_loc=mysql_fetch_assoc($select_loc))

                               {

							   $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						    $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$get_loc['facility_id']."'"); 

						   $get_fac=mysql_fetch_assoc($select_fac);

						   $locale_fac[$count_locale]=$get_fac['address'];

						  $locale_fac_name[$count_locale]=$get_fac['facility_nam'];

							  }

						  }

						  $count_locale++;

                      

					 

				  }

								

				}

				

				if(isset($_REQUEST['loc_rem']))

				{

					

					if(isset($_REQUEST['fid']))

					{

						if($_REQUEST['fid']=='')

						{ 

							

				$sql=mysql_query("SELECT * FROM  sample_locationtype_to_permit WHERE project_id='".$_REQUEST['pid']."'");

							  while($row=mysql_fetch_array($sql))

							  {

							$sql1=mysql_query("SELECT * FROM   location_info  WHERE sl_type_id='".$_REQUEST['localetypeid']."' and loc_id='".$row['loc_id']."' and active_bool='1'");

						

						  while($get_loc=mysql_fetch_assoc($sql1))

                               {

				             $locale_id[$count_locale]=$get_loc['loc_id'];

					       $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						  

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						   if($get_loc['l_lat']=='0' and $get_loc['l_long']=='0')

						  {

							  $select_loc=mysql_query("SELECT * FROM  location_map_info WHERE loc_id='".$get_loc['loc_id']."'"); 

							 while($get_loc=mysql_fetch_assoc($select_loc))

                               {

							   $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						    $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$get_loc['facility_id']."'"); 

						   $get_fac=mysql_fetch_assoc($select_fac);

						   $locale_fac[$count_locale]=$get_fac['address'];

						  $locale_fac_name[$count_locale]=$get_fac['facility_nam'];

							  }

						  }

						  $count_locale++;

                      

					 

				     }

							  }

						}

						else

						{

							

		 $sql1=mysql_query("SELECT * FROM   location_info  WHERE sl_type_id='".$_REQUEST['localetypeid']."' and facility_id='".$fid_decode."' and active_bool='1'");

					

							  	  while($get_loc=mysql_fetch_assoc($sql1))

                               {

				             $locale_id[$count_locale]=$get_loc['loc_id'];

					       $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						  

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						   if($get_loc['l_lat']=='0' and $get_loc['l_long']=='0')

						  {

							  $select_loc=mysql_query("SELECT * FROM  location_map_info WHERE loc_id='".$get_loc['loc_id']."'"); 

							 while($get_loc=mysql_fetch_assoc($select_loc))

                               {

							   $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						    $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$get_loc['facility_id']."'"); 

						   $get_fac=mysql_fetch_assoc($select_fac);

						   $locale_fac[$count_locale]=$get_fac['address'];

						  $locale_fac_name[$count_locale]=$get_fac['facility_nam'];

							  }

						  }

						  $count_locale++;

                      

					 

				  }

					}

					}

								

				}

				  if(isset($_REQUEST['singleloc']))

				  {

					

				 $select_loc=mysql_query("SELECT * FROM location_info WHERE loc_id='".$lid_decode."'");    

                while($get_loc=mysql_fetch_assoc($select_loc))

                {

				           if(!$get_loc['l_lat']=='0' and !$get_loc['l_long']=='0')

						   {

							  

							  $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						      $locale_long[$count_locale]=$get_loc['l_long'];

						  

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						  $count_locale++;

                       }

					   else

					   {

						  

						   $select_loc=mysql_query("SELECT * FROM  location_map_info WHERE loc_id='".$lid_decode."'"); 

						   $get_loc=mysql_fetch_assoc($select_loc);

						     $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						      $locale_long[$count_locale]=$get_loc['l_long'];

						  

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						 

				

				       $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$get_loc['facility_id']."'"); 

						 $get_fac=mysql_fetch_assoc($select_fac);

						   $locale_fac[$count_locale]=$get_fac['address'];

						  $locale_fac_name[$count_locale]=$get_fac['facility_nam'];

						   $count_locale++;  

						  

						   }

			     	}

					 

				  }

				  if(isset($_REQUEST['flagIn']))

				  {

					  if(!$_REQUEST['lid']=='')

					  {

					  

				 $select_loc=mysql_query("SELECT * FROM location_info WHERE loc_id='".$lid_decode."'");    

                while($get_loc=mysql_fetch_assoc($select_loc))

                {

				           if(!$get_loc['l_lat']=='0' and !$get_loc['l_long']=='0')

						   {

							 $locale_id[$count_locale]=$get_loc['loc_id'];

					          $locale_lat[$count_locale]=$get_loc['l_lat'];

						      $locale_long[$count_locale]=$get_loc['l_long'];

						  

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						  $count_locale++;

                       }

					   else

					   {

						   $select_loc=mysql_query("SELECT * FROM  location_map_info WHERE loc_id='".$lid_decode."'"); 

						   $get_loc=mysql_fetch_assoc($select_loc);

						     $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						      $locale_long[$count_locale]=$get_loc['l_long'];

						  

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						 

				

				    $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$get_loc['facility_id']."'"); 

						 $get_fac=mysql_fetch_assoc($select_fac);

						   $locale_fac[$count_locale]=$get_fac['address'];

						  $locale_fac_name[$count_locale]=$get_fac['facility_nam'];

						   $count_locale++;  

						  

						   }

			     	}

				   }

				  }

				  if(isset($_REQUEST['dir_del_loc']))

				{

				

				$sql=mysql_query("SELECT * FROM  sample_locationtype_to_permit WHERE project_id='".$_REQUEST['pid']."'");

							  	 while($row=mysql_fetch_array($sql))

							  	{ 

		  $sql1=mysql_query("SELECT * FROM   location_info  WHERE sl_type_id='".$_REQUEST['localetypeid']."' and loc_id='".$row['loc_id']."' and active_bool='1' ");

							  	  while($get_loc=mysql_fetch_assoc($sql1))

                               {

								 

				             $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						  

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						   if($get_loc['l_lat']=='0' and $get_loc['l_long']=='0')

						  {

							

							  $select_loc=mysql_query("SELECT * FROM  location_map_info WHERE loc_id='".$get_loc['loc_id']."'"); 

							 while($get_loc=mysql_fetch_assoc($select_loc))

                               {

							   $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						    $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$get_loc['facility_id']."'"); 

						   $get_fac=mysql_fetch_assoc($select_fac);

						   $locale_fac[$count_locale]=$get_fac['address'];

						  $locale_fac_name[$count_locale]=$get_fac['facility_nam'];

							  }

						  }

						  $count_locale++;

					}

					 

				  }

								

				}

				  if(isset($_REQUEST['remember']))

				{

					

					$sql=mysql_query("SELECT * FROM  sample_locationtype_to_permit WHERE facility_id='".$fid_decode."'");

							  	 while($row=mysql_fetch_array($sql))

							  	{  

							  

							 	  $sql1=mysql_query("SELECT * FROM   location_info  WHERE loc_id='".$row['loc_id']."' AND active_bool=1");

							  	  while($get_loc=mysql_fetch_assoc($sql1))

                               {

				

					       $locale_id[$count_locale]=$get_loc['loc_id'];

						    $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						  

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						   if($get_loc['l_lat']=='0' and $get_loc['l_long']=='0')

						  {

							  $select_loc=mysql_query("SELECT * FROM  location_map_info WHERE loc_id='".$get_loc['loc_id']."'"); 

							 while($get_loc=mysql_fetch_assoc($select_loc))

                               {

							   $locale_id[$count_locale]=$get_loc['loc_id'];

					         $locale_lat[$count_locale]=$get_loc['l_lat'];

						    $locale_long[$count_locale]=$get_loc['l_long'];

						   $locale_name[$count_locale]=$get_loc['loc_name'];

						    $select_fac=mysql_query("SELECT * FROM facility_info WHERE  facility_id='".$get_loc['facility_id']."'"); 

						   $get_fac=mysql_fetch_assoc($select_fac);

						   $locale_fac[$count_locale]=$get_fac['address'];

						  $locale_fac_name[$count_locale]=$get_fac['facility_nam'];

							  }

						  }

						   

						  $count_locale++;

                       }

					 

				  }

								

				}

				 

                /*$select_loc=mysql_query("SELECT * FROM location_info WHERE active_bool=1");    

                while($get_loc=mysql_fetch_assoc($select_loc))

                {

				

					      $locale_lat[$count_locale]=$get_loc['l_lat'];

						   $locale_long[$count_locale]=$get_loc['l_long'];

						  

						echo  $locale_name[$count_locale]=$get_loc['loc_name'];

						  $count_locale++;

                       }*/

					 

			 if($locale_lat!='' and $locale_long!='')

                    {

						

                      ?>

                    

			

                

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">

window.onload = function () {

	 var locale_lat=new Array();

	 var locale_long=new Array();

	 var locale_name=new Array();

	var locale_id=new Array();

	var locale_fac=new Array();

	var locale_fac_name=new Array();

	 var totalelem=0;

	totalelem='<?php echo $count_locale; ?>';

    

	 <?php for($i=0;$i<$count_locale;$i++){ ?>

    locale_lat[<?php echo $i; ?>]='<?php echo $locale_lat[$i]; ?>';

	locale_long[<?php echo $i; ?>]='<?php echo $locale_long[$i]; ?>';

	locale_name[<?php echo $i; ?>]='<?php echo $locale_name[$i]; ?>';

	locale_id[<?php echo $i; ?>]='<?php echo $locale_id[$i]; ?>';

	locale_fac[<?php echo $i; ?>]='<?php echo $locale_fac[$i]; ?>';

	locale_fac_name[<?php echo $i; ?>]='<?php echo $locale_fac_name[$i]; ?>';

   

    <?php } ?>

   var latlng = new google.maps.LatLng(<?php echo $locale_lat[$count_locale-1];?>,<?php echo $locale_long[$count_locale-1];?>);

  

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

	var localeFac = locale_fac[i]

	var localeFacName = locale_fac_name[i]

    var myLatlng = new google.maps.LatLng(lat,long);

   

    var marker = new google.maps.Marker({

        position: myLatlng,

        map: map,

		titlelat:lat,

		titlelong:long,

		titlename:localeName,

		titleid:localeId,

		titleFac:localeFac,

		FacName:localeFacName,

		draggable: true

    });

	 

	if(localeFacName=='')

	{

	marker.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');

	}

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

	

	var fac_msg='Facility Address='+this.titleFac+'<br/><br/>Facility Name='+this.FacName;

	

	var localeCurrentName=this.titlename;

	if(!this.FacName=='')

	{

	 infowindow.setContent(fac_msg+'<br/><br/>Locales Name='+localeCurrentName);

	}

	else

	{

		infowindow.setContent(windowmsg+'<br/><br/>Locales Name='+localeCurrentName);

		}

	// infowindow.setContent(windowmsg);

   infowindow.open(map,this);

});

	

	 }

};

</script>

<?php

					

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

//

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

        }?>

<h2>


<!--Breadcrumb -->

<h2 id="com_name"> 

<?php if(isset($_REQUEST['comfId'])){?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp; Hi"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a style="font-size:18px;" 

 href="#">Map</a>

<?php } else if(!isset($_REQUEST['lid'])){?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a href="index.php?del_locales=1&pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $cid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>" ><?php echo " &nbsp show all location &nbsp; >&nbsp;"; ?></a><a style="font-size:18px;" href="#">Map</a>

<?php }?>

<?php if(isset($_REQUEST['lid'])) {?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a href="">

  <?php if(isset($row5['sl_type'])) { echo $row5['sl_type']."&nbsp >"; } ?>

  </a> <a href="index.php?upload_locationsale=1&amp;lid=<?php if(isset($_REQUEST['lid'])) {  echo $lid_encode; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) {  echo $pid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row['loc_name'])) { echo $row['loc_name']." &nbsp;>&nbsp;"; } ?>

  </a> <a style="font-size:18px;" 

 href="#">Map</a> </h2>

 

 <?php }?>

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

    <input type="hidden" name="local_id" id="local_id"/>

   

    <input type="hidden" name="oldlat" id="oldlat">

    <input type="hidden" name="oldlng" id="oldlng">

    <input type="hidden" name="currentlat" id="currentlat">

    <input type="hidden" name="currentlng" id="currentlng"/>

   

    <input type="submit"  class="submit" value=""/>

  </form>

</div>

<?php



  if(isset($_REQUEST['title']))

  {

$sql=mysql_query("SELECT facility_id FROM facility_info WHERE address='".$_REQUEST['title']."'");

$row = mysql_fetch_array($sql);

$row['facility_id'];

$update=mysql_query("UPDATE  facility_info SET address = '".$_REQUEST['addre']."',lat = '".$_REQUEST['marker_lat']."' ,long_fac= '".$_REQUEST['marker_lng']."' WHERE facility_id = '".$row['facility_id']."'");

 if($update==true)

 {

echo "<meta http-equiv='refresh' content='0'>";	 

}

  

 }

 

 if(isset($_REQUEST['oldlat']))

  {

$update=mysql_query("UPDATE  location_info SET l_lat = '".$_REQUEST['currentlat']."',l_long= '".$_REQUEST['currentlng']."' WHERE loc_id = '".$_REQUEST['local_id']."'");

 if($update==true)

 {

//echo "<meta http-equiv='refresh' content='0'>";	 

}

 }

/* if(!isset($_REQUEST['addre']))

  {

	  echo '<div style="color:red;position: absolute;"><h1>Please choose right location!</h1></div>';

	}*/

 

   ?>
			<?php	}

			else

			{

				

	?>

    <script

src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">

</script>



<script>

alert('Marker(s) cannot be displayed on map because none of the locales are selected.');

function initialize()

{

var mapOpt = {

  center:new google.maps.LatLng(46.04440378292747, -94.62455749511719 ),

  zoom:20,

  mapTypeId:google.maps.MapTypeId.ROADMAP

  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapOpt);

}



google.maps.event.addDomListener(window, 'load', initialize);

</script>

<?php

					

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

            

       // }

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

        }?>

<h2>



<h2 id="com_name"> 

<?php if(isset($_REQUEST['comfId'])){?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a style="font-size:18px;" 

 href="#">Map</a>

<?php } else if(!isset($_REQUEST['lid'])){?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a href="index.php?del_locales=1&pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $cid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>" ><?php echo " &nbsp show all location &nbsp; >&nbsp;"; ?></a><a style="font-size:18px;" href="#">Map</a>

<?php }?>

<?php if(isset($_REQUEST['lid'])) {?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a href="">

  <?php if(isset($row5['sl_type'])) { echo $row5['sl_type']."&nbsp >"; } ?>

  </a> <a href="index.php?upload_locationsale=1&amp;lid=<?php if(isset($_REQUEST['lid'])) {  echo $lid_encode; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) {  echo $pid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row['loc_name'])) { echo $row['loc_name']." &nbsp;>&nbsp;"; } ?>

  </a> <a style="font-size:18px;" 

 href="#">Map</a> </h2>

 

 <?php }?>

<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>

<div id="googleMap"></div>

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

		

		<?php	} ?>

</div>			

	<?php		}

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



//  Another segemnt dedicated to "list_facilites"
 ?>
 <div>
 <?php
 
 
if(isset($_REQUEST['comfId']))

{

if($address[0]!='')

{

 

?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 

<script type="text/javascript">

var geocoder = new google.maps.Geocoder();

var addre='';

var latlong='';

var totalelem=0;

function geocodePosition(pos) {

	

	geocoder.geocode({

    latLng: pos

  }, function(responses) {

	  

    if (responses && responses.length > 0) {

      updateMarkerAddress(responses[0].formatted_address,this.id);

	 

    } else {

      updateMarkerAddress('Cannot determine address at this location.');

    }

  });

}



function updateMarkerStatus(str) {



 var sta= document.getElementById('markerStatus').innerHTML = str;



 }

function updateMarkerPosition(latLng,id) {

	var lat=latLng.lat();

    var lng=latLng.lng();

	document.getElementById('marker_lat').value=lat;

	document.getElementById('marker_lng').value=lng;

	/*document.getElementById('marker').value = [

    latLng.lat(),

    latLng.lng()

  ].join(', ');*/



}

function updateMarkerAddress(str,id) {



	document.getElementById('address1').value = str;

	document.getElementById('Status').innerHTML = str;

 	//setTimeout(function(){document.getElementById('addresss['+id+']').value =document.getElementById('address1').value;},2000);

}





function initialize() {

	

     var y=0;

	totalelem='<?php echo $count_id; ?>';

//alert(totalelem);

	<?php for($i=0;$i<$count_id;$i++){ ?>

    addre='<?php echo $address[$i]; ?>'; 

   

	//document.getElementById('addre123').value = addre;

    

    //alert(address);

    

    geocoder.geocode({'address':addre}, function(results) {

    y++;

    	    // alert(y);

             latlong+=results[0].geometry.location;

           //  alert(latlong);

             if(y==totalelem)

             {

             	initContinued(latlong,totalelem);

             }	

          });

    //latlong1=document.getElementById('latlong').value;

	//alert(latlong);

    <?php } ?>	

}





function initContinued(adder,totalelem)

{  

//alert(adder);

//alert(totalelem)

	var lat='';

	lat+=adder;

	totalElem=totalelem;

	var k=0;

	var count=0;

	var getIndexofclosebrac='';

	var getIndexofopenbrac='';

	var getIndexofcomma='';

	var elemArray = new Array();

	var latArray= new Array();

	var finalElemlat= new Array();

	var finalElemlong= new Array();

	var startPosition=0;

	var indexElem=0;

	var counter=0;

	var locations=new Array();

	for(k=0;k<totalElem;k++)

	{

		//alert(lat);

        getIndexofclosebrac=lat.indexOf(')');

        getIndexofopenbrac=lat.indexOf('(')+1;

        getIndexofcomma=lat.indexOf(',');

        elemArray+=lat.substring(getIndexofopenbrac,getIndexofclosebrac);

        getIndexofclosebrac=getIndexofclosebrac+1;	

        getLength=lat.length;

        getIndexofclosebrac=getIndexofclosebrac-1;

        //alert(getIndexofclosebrac);

        latArray[k]=lat.substring(getIndexofopenbrac,getIndexofclosebrac);

       // alert(latArray);

        getIndexofclosebrac=getIndexofclosebrac+1;

        lat=lat.substring(getIndexofclosebrac,getLength);

       // alert(lat);

	}

	for(k=0;k<totalElem;k++)

	{

		//alert(latArray[k]);

		indexElem=latArray[k].indexOf(',');

		//alert(indexElem);

			startPosition=0;

		//alert(counter);

		finalElemlat[counter]=latArray[k].substring(startPosition,indexElem);

		//counter++;

		//alert(counter);

		//alert(finalElem);

 		startPosition=indexElem+1;

 		indexElem=latArray[k].length;

		finalElemlong[counter]=latArray[k].substring(startPosition,indexElem);

		counter++;

		//alert(counter);

		//alert(finalElemlong);



	}

    var avgLat=0;

    var avgLong=0;

    var address=new Array();

	var facility_name=new Array();

     <?php for($i=0;$i<$count_id;$i++){ ?>

    address[<?php echo $i; ?>]='<?php echo $address[$i]; ?>';

	facility_name[<?php echo $i; ?>]='<?php echo $facility_nam[$i]; ?>';

   

    <?php } ?>

   

    for(k=0;k<totalElem;k++)

	{

			

		avgLat=avgLat+parseFloat(finalElemlat[k]);

 		avgLong=avgLong+parseFloat(finalElemlong[k]);

	//alert(avgLong);

	}

	//alert(totalElem);

    avgLat=avgLat/totalElem;

   

	avgLong=avgLong/totalElem;

 

   //alert(window.location);

    locations = [

    <?php for($i=0;$i<$count_id;$i++){ ?>

        

      [address[<?php echo $i; ?>],finalElemlat[<?php echo $i; ?>],finalElemlong[<?php echo $i; ?>],facility_name[<?php echo $i; ?>],<?php echo $i."]"; if($i!=$count_id-1){echo ",";}else{ echo "";}?>

          <?php }?>

      ];

  

   <?php /*?>   <?php 

      for($i=0;$i<$count_id;$i++){

      	 ?>

      	       

document.getElementById('hiddentxt').innerHTML += "<input type='hidden' name='marker[<?php echo $i; ?>]' id='marker[<?php echo $i; ?>]' /><br />"; document.getElementById('hiddentxt').innerHTML += "<input type='hidden' name='addresss[<?php echo $i; ?>]' id='addresss[<?php echo $i; ?>]'/><br />";

			  

			  

      	<?php } ?><?php */?>

   

   

     var infowindow = new google.maps.InfoWindow({

          content:"Hello World"

          });

          

     var latLng = new google.maps.LatLng(avgLat,avgLong);

	

     var map = new google.maps.Map(document.getElementById('mapCanvas'), {

         zoom:16, 

	     center: latLng,

         mapTypeId: google.maps.MapTypeId.ROADMAP

  });

 /*  for (i = 0; i < locations.length; i++) {  

	

            var lat = latLng.lat() + (0.1 * i);

            var lng = latLng.lng() + (0.1 * i);

			var loc = new google.maps.LatLng(lat,lng);



          marker = new google.maps.Marker({

          position: loc,

          draggable: true,

          map: map,

          title: locations[i][0],

          id:i

		  

      });*/

	  

 

  for (i = 0; i < locations.length; i++) {  

        

          marker = new google.maps.Marker({

          position: new google.maps.LatLng(locations[i][1], locations[i][2]),

          draggable: true,

          map: map,

          title: locations[i][0],

		  facility_name:locations[i][3],

		  id:i

         

      });

	  var latLng = marker.getPosition(); // returns LatLng object

map.setCenter(latLng); // setCenter takes a LatLng object 



 google.maps.event.addListener(marker, 'click', function() {  

//alert(this.title);

 infowindow.setContent('Facility Address='+this.title+'<br/><br/>Facility Name='+this.facility_name);

  infowindow.open(map,this);

  });



  google.maps.event.addListener(marker, 'dragstart', function() { 

  updateMarkerAddress('Dragging...',this.id);

  });

  google.maps.event.addListener(marker, 'drag', function() {

   updateMarkerStatus('Dragging...');

    updateMarkerPosition(this.getPosition(),this.id);

 });

  google.maps.event.addListener(marker, 'dragend', function() {

	   var markerTitle =this.title;

    document.getElementById('title').value=markerTitle;

    updateMarkerStatus('Drag ended');

    geocodePosition(this.getPosition(),this);

  });



}

}

google.maps.event.addDomListener(window, 'load', initialize);

</script>



<?php



    if(isset($_REQUEST['lid']))

        { 

		

            $sql=mysql_query("SELECT * FROM location_info WHERE loc_id='".$lid_decode."'");

            $count_location=mysql_num_rows($sql);

            

            $row=mysql_fetch_array($sql);

			

			?>

           

            <?php if(isset($row['sl_type_id']))

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

<h2>



<h2 id="com_name"> 

<?php if(isset($_REQUEST['comfId'])){?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a style="font-size:18px;" 

 href="#">Map</a>

<?php } else if(!isset($_REQUEST['lid'])){?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a href="index.php?del_locales=1&pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $cid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>" ><?php echo " &nbsp show all location &nbsp; >&nbsp;"; ?></a><a style="font-size:18px;" href="#">Map</a>

<?php }?>

<?php if(isset($_REQUEST['lid'])) {?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a href="">

  <?php if(isset($row5['sl_type'])) { echo $row5['sl_type']."&nbsp >"; } ?>

  </a> <a href="index.php?upload_locationsale=1&amp;lid=<?php if(isset($_REQUEST['lid'])) {  echo $lid_encode; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) {  echo $pid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row['loc_name'])) { echo $row['loc_name']." &nbsp;>&nbsp;"; } ?>

  </a> <a style="font-size:18px;" 

 href="#">Map</a> </h2>

 

 <?php }?>

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

<?php



  if(isset($_REQUEST['title']))

  {

$sql=mysql_query("SELECT facility_id FROM facility_info WHERE address='".$_REQUEST['title']."'");

$row = mysql_fetch_array($sql);

$row['facility_id'];

$update=mysql_query("UPDATE  facility_info SET address = '".$_REQUEST['addre']."',lat = '".$_REQUEST['marker_lat']."' ,long_fac= '".$_REQUEST['marker_lng']."' WHERE facility_id = '".$row['facility_id']."'");

 if($update==true)

 {

echo "<meta http-equiv='refresh' content='0'>";	 

}

  

 }

 

 if(isset($_REQUEST['oldlat']))

  {

$sql=mysql_query("SELECT loc_id FROM location_info WHERE l_lat='".$_REQUEST['oldlat']."' AND l_long='".$_REQUEST['oldlng']."'");

$row = mysql_fetch_array($sql);

$row['loc_id'];

$update=mysql_query("UPDATE  location_info SET l_lat = '".$_REQUEST['currentlat']."',l_long= '".$_REQUEST['currentlng']."' WHERE loc_id = '".$row['loc_id']."'");

 if($update==true)

 {

echo "<meta http-equiv='refresh' content='0'>";	 

}

  

 }

 

/* if(!isset($_REQUEST['addre']))

  {

	  echo '<div style="color:red;position: absolute;"><h1>Please choose right location!</h1></div>';

	}*/

 

   ?>

<?php 

 

}

elseif($lat[0]!='')

{

	 echo '<div style="color:red;font-size: 15px;">Please choose right location!</div>';

}

else

	{?>

         <script

src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">

</script>



<script>

alert('Marker(s) cannot be displayed on map  because none of the facilities are selected.');

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

<?php 

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

  <h2 id="com_name"> 

<?php if(isset($_REQUEST['comfId'])){?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a style="font-size:18px;" 

 href="#">Map</a>

<?php } else if(!isset($_REQUEST['lid'])){?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a href="index.php?del_locales=1&pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $cid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>" ><?php echo " &nbsp show all location &nbsp; >&nbsp;"; ?></a><a style="font-size:18px;" href="#">Map</a>

<?php }?>

<?php if(isset($_REQUEST['lid'])) {?>

<a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a>  <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a><a href="">

  <?php if(isset($row5['sl_type'])) { echo $row5['sl_type']."&nbsp >"; } ?>

  </a> <a href="index.php?upload_locationsale=1&amp;lid=<?php if(isset($_REQUEST['lid'])) {  echo $lid_encode; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) {  echo $pid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row['loc_name'])) { echo $row['loc_name']." &nbsp;>&nbsp;"; } ?>

  </a> <a style="font-size:18px;" 

 href="#">Map</a> </h2>

 

 <?php }?>

<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>	

<div id="googleMapFac"></div>	

<div id="infoPanel"> <b class='markerFontStatus'>Marker status: Please Select Marker One By One</b>

  <div id="Status" class="markerFontStatus"></div>

  <div id="markerStatus" class="markerFontStatus"><i></i></div>

  <!--<b>Current position:</b>-->

  <div id="info"></div>

  <!-- <b>Closest matching address:</b>-->

  <form action="" method="post">

    

    <input type="submit"  class="submit" value=""/>

  </form>

</div>

  

	<?php } ?>

</div>
<?php }

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

<h2>

<h2 id="com_name"> <a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " >

  <?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?>

  </a> <a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" >

  <?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?>

  </a> <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?>

  </a> <a href="">

  <?php if(isset($row5['sl_type'])) { echo $row5['sl_type']."&nbsp >"; } ?>

  </a> <a href="index.php?upload_locationsale=1&amp;lid=<?php if(isset($_REQUEST['lid'])) {  echo $lid_encode; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) {  echo $pid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">

  <?php if(isset($row['loc_name'])) { echo $row['loc_name']." &nbsp;- &nbsp;"; } ?>

  </a> <a style="font-size:18px;" href="index.php?place_g=1&amp;lid=<?php if(isset($_REQUEST['lid'])) { echo $lid_encode; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">Map</a> </h2>

<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>

<div id="map_addresses" class="map"> </div>

<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->

<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script> 

<script type="text/javascript" src="js/jquery.gmap.js"></script> 

<script type="text/javascript" charset="utf-8">

$(function()

{

   var phparray = <?php echo json_encode($address); ?>;    

   

   $('#map').gMap();

   

   $('#map_controls').gMap(

   {

        latitude: -2.206,

        longitude: -79.897,

        maptype: 'TERRAIN', // 'HYBRID', 'SATELLITE', 'ROADMAP' or 'TERRAIN'

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


