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
                  <h3> Outside Reource Type (e.g. Lab): <?php echo $row['or_name']; ?>  </h3>

			      <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5> 

              <form name="edit_project" action="" method="get" onsubmit="return valid();" style='display:inline;'>

			    <table  style="line-height:50px" width="70%">
		



    <tr>

      <td id="doc_lib">Company Name:</td>

      <td align="right"><input type="text"  name="f_nam" id="f_nam" class="edit_com" value="<?php echo $row['facility_nam'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Company Address:</td>

      <td align="right"><input type="text"  name="f_address" id="f_address" class="edit_com" value="<?php echo $row['facility_address'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Contact Name:</td>

      <td align="right"><input type="text"  name="f_contact_nam" id="f_contact_nam" class="edit_com" value="<?php echo $row['facility_contact_nam'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Phone:</td>

      <td align="right"><input type="text"  name="f_contact_cell" id="f_contact_cell" class="edit_com" value="<?php echo $row['facility_contact_cell'];?>"/></td>

    </tr>

    <tr>

      <td id="doc_lib">Email:</td>

      <td align="right"><input type="text"  name="f_email" id="f_email" class="edit_com" value="<?php echo $row['facility_contact_email'];?>"/></td>

    </tr>
  

    </tr>

			  <tr> <td colspan="2" align="right">

<input type="hidden" name="edit_project" id="edit_project" value="1" />
<input type="hidden" name="pid" id="pid" value="<?php echo $_REQUEST['pid'] ?>" />
<input type="submit" name="submit" id="submit" value="Update" />
<input name="delete" type="submit" value="Delete" onclick="return confirm('Are you sure want to delete this Project?  All information and associated Tasks, including completed Tasks, will be deleted.');"/>               
			  	 </td></tr>

               </table>	

			  </form>	

			<br class="spacer" />

		<!-- CONTENT -->
	<!-- FOOTER -->
