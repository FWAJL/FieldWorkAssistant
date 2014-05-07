<?php

if (!isset($_SESSION['pm'])) {
    
    header("location:login.php");
    
}

include('config.php');


if (isset($_REQUEST['submit'])) {
	
    $s = mysql_query("UPDATE location_info SET 
	 loc_name='".$_REQUEST['l_name']."', 
	 l_lat='".$_REQUEST['loc_lat']."', 
	 l_long='".$_REQUEST['loc_long']."', 
	 loc_desc='".$_REQUEST['l_descr']."' 
	 WHERE 
	 loc_id='".$_REQUEST['lid']. "'") or die(mysql_error());
    
    echo "<meta http-equiv='refresh' content='0;url=index.php?edit_location=1&amp;pid=" . $_REQUEST['pid'] . "&amp;lid=" . $_REQUEST['lid'] . "'>";
    
    exit;
    
}

if (isset($_REQUEST['delete'])) {
    $s = mysql_query("DELETE FROM location_info WHERE
	loc_id='".$_REQUEST['lid']."'") or die(mysql_error());
    
	$s1 = mysql_query("DELETE FROM location_to_project WHERE
	loc_id='". $_REQUEST['lid']. "'") or die(mysql_error());
    
	echo "<meta http-equiv='refresh' content='0;url=index.php?pid=" . $_REQUEST['pid'] . "&amp;show_project=1'>";
    // Once I have results, add code to delete associated results.
    exit;
}
?>

	<!-- CONTENT -->
    
 		<?php
    
    $sql = mysql_query("SELECT * FROM location_info WHERE loc_id='" . $_REQUEST['lid'] . "'");
    $row = mysql_fetch_assoc($sql);
    $sql1 = mysql_query("SELECT * FROM project_info WHERE project_id='" . $_REQUEST['pid'] . "'");
    $row1 = mysql_fetch_assoc($sql1);
    
?>	

<h2 id="com_name"> 
	<a href="index.php?show_project=1&amp;pid=<?php
    if (isset($_REQUEST['pid'])) {
        echo $_REQUEST['pid'];
    }
?>" > 

  <?php if (isset($row1['project_name'])) {
        echo $row1['project_name'] . "&nbsp; > &nbsp;";
    } ?>
    </a>
        
        <?php echo $row['loc_name'] . " &nbsp;- &nbsp;"; ?></h2>
        
		<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5> 

 <link href="css/style.css" rel="stylesheet" type="text/css" />	
 
<form name="edit_location" action="" method="get" onsubmit="return valid();" style='display:inline;'>

			    <table  style="line-height:50px" width="70%">
	<tr>
        <td id="doc_lib"> Location Name: </td>
        <td align="right">
        <input type="text"  name="l_name" id="l_name" class="edit_com" value="<?php echo $row['loc_name']; ?>"/>
        </td>

    </tr>

 	<tr>
        <td id="doc_lib"> Location Description:</td>
         <td align="right">
         <input type="text"  name="l_descr" id="l_descr" class="edit_com" value="<?php if (isset($row['loc_desc'])) { echo $row['loc_desc']; } ?>"/>
         </td>
      </tr>
    
    <tr>
      <td id="doc_lib">Latitude:</td>
      <td align="right"><input type="text"  name="loc_lat" id="loc_lat" class="edit_com" value="<?php
    echo $row['l_lat'];
?>"/></td>
    </tr>

    <tr>
      <td id="doc_lib">Longitude:</td>
      <td align="right">
      <input type="text"  name="loc_long" id="loc_long" class="edit_com" value="<?php echo $row['l_long']; ?>"/>
      </td>
    </tr>
			  <tr>
                 <td colspan="2" align="right">
              	<input type="hidden" name="lid" id="lid"  style="width:200px; height:45px;"  value="<?php echo $_REQUEST['lid']; ?>" class="edit_com"/>
				<input type="hidden" name="pid" id="pid"  style="width:200px; height:45px;"  value="<?php echo $_REQUEST['pid']; ?>" class="edit_com"/>
			  	<input type="hidden" name="edit_location" id="edit_location" value="1" />
			  	<input type="submit" name="submit" id="submit" value="Update Location" />
                <input name="delete" type="submit" value="Delete" onclick="return confirm('Are you sure want to delete this Location?  All information and associated Resuls will be deleted.');"/>
			  	 </td>
                 </tr>
               </table>	
			  </form>	

		<!-- CONTENT -->

	<!-- FOOTER -->
