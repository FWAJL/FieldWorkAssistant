<?php

error_reporting(1);

	session_start();

	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}

	include('config.php');
	
	

	$countid=0;	

	$incre=0;

	include('location:header.php');


	if(isset($_REQUEST['pid'])) {  $pid=$_REQUEST['pid']; }

	if(isset($_REQUEST['lid'])) {  $lid=$_REQUEST['lid']; }
$_SESSION['pid']=$_REQUEST['pid'];


if(isset($_REQUEST['del_file']))

	{

		 if(!@unlink($_REQUEST['del_file']))

		 {

				 $project_file=$_REQUEST['del_file1'];

				 $project_id1=$_REQUEST['project_id1'];

				 $delete_file_database=mysql_query("DELETE FROM project_documents WHERE project_id='".$project_id1."'AND project_document='".$project_file."'");



		 }

		 else {

			 $project_file=$_REQUEST['del_file1'];

				 $project_id1=$_REQUEST['project_id1'];

				 $delete_file_database=mysql_query("DELETE FROM project_documents WHERE project_id='".$project_id1."'AND project_document='".$project_file."'");

		 }

	}

	if(isset($_REQUEST['del_permitFile']))

	{

		 if(!@unlink($_REQUEST['del_permitFile']))

		 {

		 	echo "sorry! file doesnot exists";


				 $project_file=$_REQUEST['del_permitFile'];

				 $project_id1=$_REQUEST['project_id1'];

				 $delete_file_database=mysql_query("UPDATE project_info SET permit_doc='' WHERE project_id='".$project_id1."'");

		 }

		 else {

			 	 $project_file=$_REQUEST['del_permitFile'];

				 $project_id1=$_REQUEST['project_id1'];

				 $delete_file_database=mysql_query("UPDATE project_info SET permit_doc='' WHERE project_id='".$project_id1."'");

		 }

	}

if(isset($_REQUEST['del_peo']))

{

   	if(isset($_REQUEST['peo_id']))

	{

		if($_REQUEST['peo_id']!='')

		{ 

    		$delete_peo=mysql_query("DELETE FROM people WHERE people_id='".$_REQUEST['peo_id']."'");

			$delete_peo1=mysql_query("DELETE FROM role_to_people WHERE people_id='".$_REQUEST['peo_id']."'");

	    	$delete_peo2=mysql_query("DELETE FROM people_to_place WHERE people_id='".$_REQUEST['peo_id']."'");

		}

	}

}

if(isset($_REQUEST['pro_update']))

{

	

	    $select_locale=mysql_query("SELECT location_id FROM sample_locations_to_permit WHERE permit_id='".$_REQUEST['pid']."'");

		while($get_locale=mysql_fetch_assoc($select_locale))

		{

			$localeid[$countid]=$get_locale['location_id'];

			$countid++;

		}

		 for($i=0; $i<$countid; $i++)

		 { 

		   	$sql=mysql_query("SELECT sl_type_id FROM sample_location_type_to_sample_location WHERE location_id='".$localeid[$i]."'");

			while($row=mysql_fetch_assoc($sql))

		  	{

		 		 $sl_type_id[$incre]=$row['sl_type_id'];

			 	 $incre++;

		  	}	 

		 }

		

}


if(isset($_REQUEST['vis_location_edit']))

{

 $var=$_REQUEST['visible'];

 $var2=-1;

 $var1=$var*$var2;

 $r=mysql_query("UPDATE location_info SET visible='".$var1."' WHERE loc_id='".$_REQUEST['lid']."'");

}

 if(isset($_REQUEST['location_edit']))

 {

 $var=$_REQUEST['visible'];

 $var2=-1;

 $var1=$var*$var2;



 $r=mysql_query("UPDATE location_info SET visible='".$var1."' WHERE loc_id='".$_REQUEST['lid']."'");



 }

if(isset($_REQUEST['vis_permit_edit']))
// This cod has been removed.
 {

 

 $var=$_REQUEST['visible'];

 $var2=-1;

 $var1=$var*$var2;


 $r=mysql_query("UPDATE project_info SET visible='".$var1."' WHERE project_id='".$_REQUEST['pid']."'");



 }

if(isset($_REQUEST['vis_facility_edit']))

 {

 

 $var=$_REQUEST['visible'];

 $var2=-1;

 $var1=$var*$var2;

 $r=mysql_query("UPDATE facility_info SET visible='".$var1."' WHERE facility_id='".$_REQUEST['id']."'");

  if($r)

 {

 	    $incr=0;

 		$select_permit=mysql_query("SELECT permit_id FROM permit_to_facility WHERE facility_id='".$_REQUEST['id']."'");

 	    while($result=mysql_fetch_assoc($select_permit))

		{


			$permit_id[$incr]=$result['permit_id'];

			$visible=$_REQUEST['visible'];

			

			if($visible==1)

 			{

					$update_permit_status=mysql_query("UPDATE project_info SET visible=-1 WHERE project_id='".$permit_id[$incr]."'");

					$update_facility_activebool=mysql_query("UPDATE facility_info SET active_bool=0 WHERE facility_id='".$_REQUEST['id']."'");

					$incr++;

			}

			if($visible==-1)

 			{

					$update_permit_status=mysql_query("UPDATE project_info SET visible=1 WHERE project_id='".$permit_id[$incr]."'");

					$update_facility_activebool=mysql_query("UPDATE facility_info SET active_bool=1 WHERE facility_id='".$_REQUEST['id']."'");

					$incr++;

			}	

		}

	  	

		

 }

  

 }	

 

if(isset($_REQUEST['vis_com_edit']))

{

 	$var=$_REQUEST['visible'];

 	$var2=-1;

 	$var1=$var*$var2;

 	$r=mysql_query("UPDATE company_info SET visible='".$var1."' WHERE company_id='".$cid."'");

}	

if(isset($_REQUEST['del_multipleloc']))

{

 	 foreach ($_REQUEST['checkbox_loc'] as $term)

 	 { 



 		$select_locationType=mysql_query("SELECT sl_type_id FROM sample_locationtype_to_locationinfo WHERE loc_id='".$term."'");

	 $get_locationType=mysql_fetch_assoc($select_locationType);

	 $count_locationtype=mysql_query("SELECT count(loc_id) FROM sample_locationtype_to_locationinfo WHERE sl_type_id='".$get_locationType['sl_type_id']."'");	

     $get_location_type=mysql_fetch_array($count_locationtype);





  	 $result = mysql_query("DELETE FROM location_info WHERE loc_id='".$term."'");

	 $result = mysql_query("DELETE FROM location_map_info WHERE loc_id='".$term."'");

     $result = mysql_query("DELETE FROM sample_locationtype_to_locationinfo WHERE loc_id='".$term."'");

	 $result = mysql_query("DELETE FROM sample_locationtype_to_permit WHERE loc_id='".$term."'");

     

     if($get_location_type['count(loc_id)']==1)

	 {

	 	$delete_location_type=mysql_query("DELETE FROM sample_locationtype_to_permit WHERE sl_type_id='".$get_locationType['sl_type_id']."'");

	 }



  	 }

}



if(isset($_REQUEST['del_multiplelocales']))

{

  foreach ($_REQUEST['checkbox_locales'] as $term)

  {

  	 $select_locationType=mysql_query("SELECT sl_type_id FROM sample_locationtype_to_locationinfo WHERE loc_id='".$term."'");

	 $get_locationType=mysql_fetch_assoc($select_locationType);

	 $count_locationtype=mysql_query("SELECT count(loc_id) FROM sample_locationtype_to_locationinfo WHERE sl_type_id='".$get_locationType['sl_type_id']."'");	

     $get_location_type=mysql_fetch_array($count_locationtype);





  	 $result = mysql_query("DELETE FROM location_info WHERE loc_id='".$term."'");

	  $result = mysql_query("DELETE FROM location_map_info WHERE loc_id='".$term."'");

     $result = mysql_query("DELETE FROM sample_locationtype_to_locationinfo WHERE loc_id='".$term."'");

	 $result = mysql_query("DELETE FROM sample_locationtype_to_permit WHERE loc_id='".$term."'");

     

     if($get_location_type['count(loc_id)']==1)

	 {

	 	$delete_location_type=mysql_query("DELETE FROM sample_locationtype_to_permit WHERE sl_type_id='".$get_locationType['sl_type_id']."'");

	 }

  }

}


if(isset($_REQUEST['vis_loc']))

{

 $var=$_REQUEST['visible'];

 $var2=-1;

 $var1=$var*$var2;

 $r=mysql_query("UPDATE location_info SET visible='".$var1."' WHERE loc_id='".$_REQUEST['lid']."'");

}	

if(isset($_REQUEST['vis_pro']))

{

 $var=$_REQUEST['visible'];

 $var2=-1;

 $var1=$var*$var2;

 $r=mysql_query("UPDATE project_info SET visible='".$var1."' WHERE project_id='".$_REQUEST['pid']."'");

}	

if(isset($_REQUEST['vis_tsk']))

{

 $var=$_REQUEST['visible'];

 $var2=-1;

 $var1=$var*$var2;

$r = "UPDATE task_info SET 
visible = :visibl
WHERE task_id= '".$_REQUEST['tid']."'
";

$stmt = $DBH->prepare($r);

$stmt->bindParam(':visibl', $var1, PDO::PARAM_INT);  
$stmt->execute();

}

if(isset($_REQUEST['vis_anal']))

{

 $var=$_REQUEST['visible'];

 $var2=-1;

 $var1=$var*$var2;

$r = "UPDATE analyte_info SET 
visible = :visibl
WHERE analyte_id= '".$_REQUEST['aid']."'
";

$stmt = $DBH->prepare($r);

$stmt->bindParam(':visibl', $var1, PDO::PARAM_INT);  
$stmt->execute();

}

if(isset($_REQUEST['submit_loctype_add']))

	{

		$Insert=mysql_query("INSERT INTO sample_location_types SET sl_type='".$_REQUEST['localetypeName']."'");

		$last_id=mysql_insert_id();

		$Insert=mysql_query("INSERT INTO sample_locationtype_to_permit SET sl_type_id='".$last_id."', facility_id='".$fid."'");

	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="css/style.css" rel="stylesheet" type="text/css" />



<title>Field Work Assistant</title>



<script type="text/javascript" src="js/all.js"></script>



<script type="text/javascript" src="js/tinydropdown.js"></script>

<script type="text/javascript" src="js/ddaccordion.js"></script>

<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>



<!-- Drop Down JS -->

<script type="text/javascript" src="js/drop_down.js"></script>

<script type="text/javascript">

function openWin(location_id,imagename)

{

	

myWindow=window.open('uploadfiles/location_images/'+location_id+'/'+imagename,'','width=700,height=500,location=0');



myWindow.focus();

}



function validate_peo()

{ 

   

	var flag=true;

    var error='';

	var nam=document.getElementById('name').value;

	var email=document.getElementById("email").value;

    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	var phoneno = /^(?:\(\d{3}\)|\d{3}-)\d{3}-\d{4}$/;    

   // var isvalid = emailRegexStr.test(email);

	var cell=document.getElementById("m_phone").value;

	if(nam=='')

	{

		alert("Please enter the name");

		return false;

	}

	if(cell=='' && email=='')

	{

		alert("Warning: either the cell phone number or email is needed for all features to work.");

		return true;

	}

	if(cell)

	{

	if(!cell.match(phoneno))  

        {  

        alert("Please enter the correct phone number.");  

        return false;  

        }  

	}

	

	if(email)

	{

	if (!filter.test(email)) 

{

alert('Please enter the correct email address.');

return false;

}



	}

    

	

	 if(flag==false)

        {

            alert(error);

            return flag;

        }

}

 

/*--------------------------------------------------------------function created by reeta on 16.04.2013----------------*/

function check_addProject()

  { 

    var countpro='';

	var conf='';

	var add_pro='';

	var empty='';

	var cid='';

	var pid='';

	 countpro=document.getElementById('num_pro').value;

	if(countpro==0)

	{  

	 // conf=confirm("Is this Company also a Project Name?"); 

	

	  if(conf==false)

	  {

	    cid=document.getElementById('cid').value;

		window.location.href = 'index.php?add_pro=1&pid=&cid='+cid+'&empty=1';

		return false;

	    }

	  if(conf==true)

	  {

	     cid=document.getElementById('cid').value;

	     window.location.href = 'index.php?add_pro=1&pid=&cid='+cid+'&countpro=1';

		 return false;

	  }

  	}

	if(countpro!=0)

	{

	

		cid=document.getElementById('cid').value;

		window.location.href = 'index.php?add_pro=1&pid=&cid='+cid+'&empty=1';

		return false;

	}

  }

  

  /*--------------------------------------------------End here.--------------------------------------------------------------------*/

function check_addfacility()

  { 

    var countfac='';

	var conf='';

	var addfac='';

	var empty='';

	var cid='';

	var fid='';

	

    countfac=document.getElementById('num_fac').value;

	if(countfac==0)

	{  

	  conf=confirm("Is this Company also a Facility?"); 

	

	  if(conf==false)

	  {

	    cid=document.getElementById('cid').value;

		window.location.href = 'index.php?add_fac=1&fid=&cid='+cid+'&empty=1';

		return false;

	    }

	  if(conf==true)

	  {

	     cid=document.getElementById('cid').value;

	     window.location.href = 'index.php?add_fac=1&fid=&cid='+cid+'&com_fac=1';

		 return false;

	  }

  	}

	if(countfac!=0)

	{

	

		cid=document.getElementById('cid').value;

		window.location.href = 'index.php?add_fac=1&fid=&cid='+cid+'&empty=1';

		return false;

	}

  }


function assignment_validation()

{

	var flag=true;

    var error='';

	var people=document.getElementById('people').value; 	

	var company=document.getElementById('company').value; 	

	var facility=document.getElementById('facility').value; 

	var permit=document.getElementById('permit').value;

 	

	if(people=='')

	{

		alert("Please select people");

		return false;

	}	

	if(company=='')

	{

		alert("Please select company");

		return false;

	}if(facility=='')

	{

		alert("Please select facility");

		return false;

	}if(permit=='')

	{

		alert("Please select permit");

		return false;

	}

	

	 if(flag==false)

     {

            alert(error);

            return flag;

     }

 }

;

function checkAll(){

	

	$('input:checkbox.checkall').attr('checked','checked');

    return false;

	

	  }

function locale_submit(getid)

{

	document.getElementById('text').innerHTML ="<input type='hidden' name='localetypeid' id='localetypeid' value='"+getid+"' />";

	// document.getElementById('localetypeid').value = getid;

	 document.localetype.submit(); 

}

ddaccordion.init({

	headerclass: "expandable", //Shared CSS class name of headers group that are expandable

	contentclass: "categoryitems", //Shared CSS class name of contents group

	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"

	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover

	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 

	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content

	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)

	animatedefault: true, //Should contents open by default be animated into view?

	persiststate: true, //persist state of opened contents within browser session?

	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]

	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)

	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"

	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized

		//do nothing

	},

	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed

		//do nothing

	}

})





</script>



</head>


<body>
	<!-- HEADER -->

	<?php include('header.php'); ?>

	<!-- NAV -->

	<!-- CONTENT -->

	<script type="text/javascript">

		var dropdown=new TINY.dropdown.init("dropdown", {id:'menu', active:'menuhover'});

	</script>

<input type="hidden" name="pid" id="pid" value="<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; } ?>">
	

	<div id="content">

		<div class="content_wrapper">

			<div class="content_left">

				<?php

include('left_menu1.php');

				 ?>

			</div>

            

			<div class="content_right">

			

				<?php

				if(isset($_REQUEST['add_analytes']))

				{

				include('add_analytes.php');

				} 
				
				elseif(isset($_REQUEST['add_location']))

				{

				include('add_location.php');

				} 
				
				elseif(isset($_REQUEST['add_task']))

				{

				 include('add_task.php');

				 exit;
				 
				}
				
					elseif(isset($_REQUEST['add_people']))

				{

				 include('add_people.php');

				}
				
					elseif(isset($_REQUEST['add_project']))

				{

				include('add_project.php');

				}
				elseif(isset($_REQUEST['add_boundary']))
				{
				
				include('add_boundary.php');

				}
				
				elseif(isset($_REQUEST['del_loc']))

				{

				  include('list_locations.php');

				  exit;

				}

				elseif(isset($_REQUEST['asst_reasst']))

				{

				 include('assignment.php');

				 exit;

				}

				elseif(isset($_REQUEST['doc_lib']))

				{

				 include('doc_library.php');

				 exit;

				}
				
					elseif(isset($_REQUEST['form_create']))

				{

				 include('form_create.php');

				 exit;

				}
				
						elseif(isset($_REQUEST['form_edit']))

				{

				 include('form_edit.php');

				 exit;

				}

				elseif(isset($_REQUEST['show_people']))

				{

				 include('show_people.php');

				 exit;

				}

				elseif(isset($_REQUEST['edit_project']))

				{

				 include('edit_project.php');

				}
				
				elseif(isset($_REQUEST['edit_task_locations']))

				{

				 include('edit_task_locations.php');

				}
				
				elseif(isset($_REQUEST['ppl']))

				{

				 include('show_people_list.php');

				}

				elseif(isset($_REQUEST['people']))

				{

				?>

				 <iframe src="Iframe.php" width="990px" height="550px" frameborder="0" id="IframeID"></iframe>

				<?php }


				elseif(isset($_REQUEST['place_g_loc']))

				{

				 include('place_g_loc.php');

				 exit;

				}
				
					elseif(isset($_REQUEST['place_g_fac']))

				{

				 include('place_g_fac.php');

				 exit;
				 
				}

				
				elseif(isset($_REQUEST['list_analytes']))

				{

				 include('list_analytes.php');

				}
				
				elseif(isset($_REQUEST['list_anal_group_analytes']))

				{

					 include('list_anal_group_analytes.php');

				}
				
				elseif(isset($_REQUEST['list_loc_group_locations']))

				{

					 include('list_loc_group_locations.php');

				}
				
				elseif(isset($_REQUEST['list_locations']))

				{

				 include('list_locations.php');

				}
elseif(isset($_REQUEST['list_boundaries']))

				{

				 include('list_boundaries.php');

				}
				
				elseif(isset($_REQUEST['list_bound_group_boundaries']))

				{

					 include('list_bound_group_boundaries.php');

				}
				elseif(isset($_REQUEST['sel_boundary']))

				{

				 include('sel_boundary.php');

				}
				elseif(isset($_REQUEST['list_people']))

				{

				 include('list_people.php');

				 exit;

				}
				
				elseif(isset($_REQUEST['list_projects']))

				{

				 include('list_projects.php');

				 exit;

				}
				elseif(isset($_REQUEST['show_boundary']))

				{

				 include('show_boundary.php');

				 exit;

				}
								elseif(isset($_REQUEST['show_boundaries']))

				{

				 include('show_boundaries.php');

				 exit;

				}
				elseif(isset($_REQUEST['list_tasks']))

				{

				 include('list_tasks.php');

				 exit;

				}

				elseif(isset($_REQUEST['editfid']))

				{

				 include('facility_edit.php');

				} 

			

				elseif(isset($_REQUEST['imageid']))

				{

				include('more_image.php');

				} 


				elseif(isset($_REQUEST['edit_location']))

				{

				 include('edit_location.php');

				 exit;

				}
				
				elseif(isset($_REQUEST['edit_task']))

				{

				 include('edit_task.php');

				 exit;

				}

				elseif(isset($_REQUEST['show_project']))

				{

				 
				 include('show_project.php');

				 exit;

				}


				elseif(isset($_REQUEST['imageid']))

				{

				 include('more_image.php');

				}

				 elseif(isset($_REQUEST['people_edit']))

				{

				 include('show_people.php'); //people_edit

			
				}
				
					elseif(isset($_REQUEST['upload_analytes']))

				{

				 include('upload_analytes.php');

				 exit;

				}	
				
				
	elseif(isset($_REQUEST['load_boundaries']))

				{

				 include('load_boundaries.php');

				 exit;
				}
				elseif(isset($_REQUEST['edit_people']))
				{
				 include('edit_people.php');
				}
        			else
				{
				?>
				<!-- CONTENT -->
					<h2>Please Click on the Left Menu </h2>
					<br class="spacer" />
				<?php
				}
				?>
            </div>
		</div>
	</div>	
	<!-- CONTENT -->
	<!-- FOOTER -->

	<br style="clear:both">
</body>
</html>