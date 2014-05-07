<?php
	if(!isset($_SESSION['pm']))
	{
		header("location:login.php");
	}
	include('config.php');

	if(isset($_REQUEST['submit']))
	{
		

// The following code will convert the address to a Lat/Long (so we only map the Lat/Long)

/* $address=$_REQUEST['f_address'];
$region="USA";
$address = str_replace(" ", "+", $address);

$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
$json = json_decode($json);

$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
echo $lat;
echo $long; */



// Delete the "add_project.php" file with an if_then like in edit_task.php


	 $s=mysql_query("UPDATE project_info SET 
	project_name='".$_REQUEST['p_name']."', 
	 project_descr='".$_REQUEST['p_descr']."', 
	 facility_nam='".$_REQUEST['f_nam']."', 
	 facility_address='".$_REQUEST['f_address']."', 
	 facility_lat='".$_REQUEST['f_lat']."', 
	 facility_long='".$_REQUEST['f_long']."',
	 facility_contact_nam='".$_REQUEST['f_contact_nam']."',
	 facility_contact_cell='".$_REQUEST['f_contact_cell']."',
	 facility_contact_email='".$_REQUEST['f_email']."', 
	 facility_id_num='".$_REQUEST['f_id_num']."', 
	 facility_sector='".$_REQUEST['f_sector']."', 
	 facility_sic='".$_REQUEST['f_sic']."', 
	 company_nam='".$_REQUEST['c_nam']."', 
	 company_contact_nam='".$_REQUEST['c_contact_nam']."', 
	 company_contact_cell='".$_REQUEST['c_cell']."', 
	 company_contact_email='".$_REQUEST['c_email']."', 
	 company_address='".$_REQUEST['c_address']."', 
	 company_id_num='".$_REQUEST['c_id_num']."'
	 WHERE project_id='".$_REQUEST['pid']."'") or die(mysql_error());
	 
	echo "<meta http-equiv='refresh' content='0;url=index.php?show_project=1&amp;pid=".$_REQUEST['pid']."'>";

    exit; 

	}
	
	if(isset($_REQUEST['delete']))

	{

// Project Locations

$s=mysql_query("DELETE FROM project_info WHERE project_id='".$_REQUEST['pid']."'") or die(mysql_error());


	 $s=mysql_query("DELETE FROM project_info WHERE project_id='".$_REQUEST['pid']."'") or die(mysql_error());


	echo "<meta http-equiv='refresh' content='0;url=index.php?list_projects=1'>";

/* Once I have tasks, add code to delete associated tasks.
http://www.codesynthesis.com/~boris/blog/2012/04/12/explicit-sql-delete-vs-on-delete-cascade/  */

    exit; 
	}
?>

<link href="css/style.css" rel="stylesheet" type="text/css" />	
     
 <?php
$sql=mysql_query("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");

			  $row=mysql_fetch_assoc($sql);

			 ?>	
<h3> Project Name: <?php echo $row['project_name']; ?>  </h3>

			      <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5> 

              <form name="edit_project" action="" method="get" onsubmit="return valid();" style='display:inline;'>

			    <table  style="line-height:50px" width="70%">
			<tr>

        <td id="doc_lib">Project Name: </td>

        <td align="right"><input type="text"  name="p_name" id="p_name" class="edit_com" value="<?php echo $row['project_name']; ?>"/></td>
      </tr>
 <tr>
        <td id="doc_lib"> Project Description:</td>
         <td align="right"><input type="text"  name="p_descr" id="p_descr" class="edit_com" value="<?php if(isset($row['project_descr'])){ echo $row['project_descr']; }?>"/></td>

      </tr>

<tr><td colspan="2"><h5 style="border-bottom: 8px solid #0066CC; margin-top:1px; margin-bottom:1px; "></h5></td></tr>
    <tr>
      <td colspan="2" id="doc_lib">Company and Faciility Information below.</td>

    </tr>

    <tr>

      <td id="doc_lib">Facility Name:</td>

      <td align="right"><input type="text"  name="f_nam" id="f_nam" class="edit_com" value="<?php echo $row['facility_nam'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility Address:</td>

      <td align="right"><input type="text"  name="f_address" id="f_address" class="edit_com" value="<?php echo $row['facility_address'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility Latitude:</td>

      <td align="right"><input type="text"  name="f_lat" id="f_lat" class="edit_com" value="<?php echo $row['facility_lat'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility Longitude:</td>

      <td align="right"><input type="text"  name="f_long" id="f_long" class="edit_com" value="<?php echo $row['facility_long'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility - Contact Name:</td>

      <td align="right"><input type="text"  name="f_contact_nam" id="f_contact_nam" class="edit_com" value="<?php echo $row['facility_contact_nam'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility - Phone (Mobile):</td>

      <td align="right"><input type="text"  name="f_contact_cell" id="f_contact_cell" class="edit_com" value="<?php echo $row['facility_contact_cell'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility Email:</td>

      <td align="right"><input type="text"  name="f_email" id="f_email" class="edit_com" value="<?php echo $row['facility_contact_email'];?>"/></td>

    </tr>
    
     <tr>

      <td id="doc_lib">Facility ID Number:</td>

      <td align="right"><input type="text"  name="f_id_num" id="f_id_num" class="edit_com" value="<?php echo $row['facility_id_num'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility - Sector:</td>

      <td align="right"><input type="text"  name="f_sector" id="f_sector" class="edit_com" value="<?php echo $row['facility_sector'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility - SIC Code:</td>

      <td align="right"><input type="text"  name="f_sic" id="f_sic" class="edit_com" value="<?php echo $row['facility_sic'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Company Name:</td>

      <td align="right"><input type="text"  name="c_nam" id="c_nam" class="edit_com" value="<?php echo $row['company_nam'];?>"/></td>

    </tr>
    
        <tr>

      <td id="doc_lib">Company - Contanct Name:</td>

      <td align="right"><input type="text"  name="c_contact_nam" id="c_contact_nam" class="edit_com" value="<?php echo $row['company_contact_nam'];?>"/></td>

    </tr>
    
        <tr>

      <td id="doc_lib">Company - Phone (Mobile):</td>

      <td align="right"><input type="text"  name="c_cell" id="c_cell" class="edit_com" value="<?php echo $row['company_contact_cell'];?>"/></td>

    </tr>
    
        <tr>

      <td id="doc_lib">Company Email:</td>

      <td align="right"><input type="text"  name="c_email" id="c_email" class="edit_com" value="<?php echo $row['company_contact_email'];?>"/></td>

    </tr>
    
        <tr>

      <td id="doc_lib">Company Address:</td>

      <td align="right"><input type="text"  name="c_address" id="c_address" class="edit_com" value="<?php echo $row['company_address'];?>"/></td>

    </tr>
    
        <tr>

      <td id="doc_lib">Company ID Number:</td>

      <td align="right"><input type="text"  name="c_id_num" id="c_id_num" class="edit_com" value="<?php echo $row['company_id_num'];?>"/></td>

    </tr>

			  <tr> <td colspan="2" align="right">

<input type="hidden" name="edit_project" id="edit_project" value="1" />
<input type="hidden" name="pid" id="pid" value="<?php echo $_REQUEST['pid'] ?>" />
<input type="submit" name="submit" id="submit" value="Update Project" />
<input name="delete" type="submit" value="Delete" onclick="return confirm('Are you sure want to delete this Project?  All information and associated Tasks, including completed Tasks, will be deleted.');"/>               
			  	 </td></tr>

               </table>	

			  </form>	

			<br class="spacer" />

		<!-- CONTENT -->
	<!-- FOOTER -->
