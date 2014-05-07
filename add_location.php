<?php

if(!isset($_SESSION['pm']))

{

  header("location:login.php");

}

include('config.php');


if(isset($_POST['submit']))

{

		 $sql=mysql_query("INSERT INTO location_info SET  
		loc_name='".$_REQUEST['l_name']."', 
	 l_lat='".$_REQUEST['loc_lat']."', 
	 l_long='".$_REQUEST['loc_long']."', 
	 loc_desc='".$_REQUEST['l_descr']."'")
	 or die(mysql_error());

	  $lastinserted=mysql_insert_id();

 $in=mysql_query("INSERT INTO location_to_project SET loc_id='".$lastinserted."',project_id='".$_REQUEST['pid']."'");


	  echo "<meta http-equiv='refresh' content='0;url=index.php?list_locations=1&amp;lid=".$lastinserted."&amp;pid=".$_REQUEST['pid']."'>";

    exit;

	}
	
?>

<?php 

$sql4=mysql_query("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");

		  $row4=mysql_fetch_array($sql4);

	   ?>

<h2 id="com_name"> 

 <a href="index.php?show_project=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; }?>" > 

  <?php if(isset($row4['project_id'])) { echo $row4['project_name']."&nbsp; > &nbsp;"; } ?></a>
 
  
  Add New Location</h2>


<style type="text/css">

	.edit_com{

			   width:186px;

			   height:30px;

			   box-shadow:0px 0px 2px 0px;

			 }

	

	</style>

<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>

<br />

<br />


<form name="add_location" action="" method="post" style='display:inline;'>

        

  <table  style="line-height:40px" width="50%">

    <tr>

      <td></td>

      <td align="right"><input type="hidden" name="lid" id="lid" value="1" /></td>

    </tr>

    <tr>

      <td id="doc_lib">Location Name:</td>

      <td align="right"><input type="text"  name="l_name" id="l_name" class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib"> Lat:</td>

      <td align="right"><input type="text"  name="loc_lat" id="loc_lat" class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib"> Long:</td>

      <td align="right"><input type="text"  name="loc_long" id="loc_long" class="edit_com" /></td>

    </tr>
    
        <tr>

      <td id="doc_lib"> Description:</td>

      <td align="right"><input type="text"  name="l_descr" id="l_descr" class="edit_com" /></td>

    </tr>

               <tr><td align="right"> <input type="hidden" name="prid" id="prid"  style="width:200px; height:45px;"  value="<?php echo $pid; ?>" class="edit_com"/></td><td></td></tr>
    
    <tr>

      <td></td>

      <td align="right"><input type="hidden" name="add_loc" id="add_loc" value="1" />

      <input  type="hidden" id="lat" name="lat" value="" />

        <input   type="hidden"  id="long" name="long" value="" />

        </td>

    </tr>

    <tr>

      <td></td>

      <td align="right"><input type="submit" name="submit"  id="submit" value="Add New Location" /></td>

    </tr>

  </table>

</form>

