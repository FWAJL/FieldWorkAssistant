<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/grey.css" rel="stylesheet" type="text/css" />
<link href="paging.css" rel="stylesheet" type="text/css" /> 
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>
// Check all
$(document).ready(function () {
    $(" #allbox_rem").click(function () {
        if ($(" #allbox_rem").is(':checked')) {
            $(".cbox_rem").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $(".cbox_rem").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
</script> 

<script>
// Check all
$(document).ready(function () {
    $(" #allbox_add").click(function () {
        if ($(" #allbox_add").is(':checked')) {
            $(".cbox_add").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $(".cbox_add").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
</script> 
    
<?php 
	
	if(!isset($_SESSION['pm']))
	{
		
		header("location:login.php");
	}

	include('config.php');
	
// Queries	

// Project info	
$STH_project = $DBH->prepare("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");  
$STH_project->execute();
$STH_project->setFetchMode(PDO::FETCH_ASSOC);  
$row_project = $STH_project->fetch();

// Group Name
$sql_loc_group_name=mysql_query("SELECT * FROM loc_groupname_to_group WHERE loc_group_id = '".$_REQUEST['lgid']."'");
$row_loc_group_name=mysql_fetch_assoc($sql_loc_group_name);

// All Locations 
$query = mysql_query("SELECT location_to_group.loc_id, loc_name FROM location_to_group, location_info WHERE location_to_group.loc_id=location_info.loc_id AND loc_group_id='".$_REQUEST['lgid']."' ORDER BY loc_name") or die(mysql_error());

//Locations in group 	
$query1 = mysql_query("SELECT * FROM location_to_group WHERE loc_group_id='".$_REQUEST['lgid']."'");
$x=mysql_num_rows($query1);

//Locations for the project
$query2 = mysql_query("SELECT * FROM location_to_group WHERE loc_group_id='".$_REQUEST['lgid']."'");

//Locations Not in Group
$sql_query3=mysql_query("SELECT location_to_project.loc_id, loc_name FROM location_to_project, location_info
WHERE location_info.loc_id = location_to_project.loc_id AND project_id='".$_REQUEST['pid']."' AND NOT EXISTS
 (SELECT * FROM location_to_group 
 WHERE loc_group_id='".$_REQUEST['lgid']."' 
 AND location_to_group.loc_id = location_to_project.loc_id)  ORDER BY loc_name") or die(mysql_error());
 
?> 	
	

<?php
// Form Handler	
	
// Save
/*if(isset($_REQUEST['save'])){
	
	if(isset($_REQUEST['cbox_rem'])) {
		foreach($_REQUEST['id'] as $key => $id) {
			
			if(isset($_REQUEST['cbox_rem'][$key])) {
				$checked[] = $id;
			} else {
				$unchecked[] = $id;
			}

		}

		mysql_query("UPDATE location_info SET active_bool=1 WHERE loc_id IN (".implode(',', $checked).")");
		mysql_query("UPDATE location_info SET active_bool=0 WHERE loc_id IN (".implode(',', $unchecked).")");
	} else {
		
		if(!isset($_REQUEST['cbox_rem'])) {
			foreach($_REQUEST['id'] as $key => $id) {
				$unchecked[] = $id;
			}

		}

		mysql_query("UPDATE location_info SET active_bool=0 WHERE loc_id IN (".implode(',', $unchecked).")");
	}

}*/

?>

<?php

//Update Location Group Name
if($_REQUEST['name_change']=="Submit")
{
	
$sql_chg_grp_nam = "UPDATE  loc_groupname_to_group SET 
loc_group_name = :loc_group_nam
WHERE loc_group_id= '".$_REQUEST['lgid']."'
"; 
$stmt = $DBH->prepare($sql_chg_grp_nam);
$stmt->bindParam(':loc_group_nam', $_POST['loc_grp_name'], PDO::PARAM_STR); 
$stmt->execute();	
	
/*$sql_new_loc_group_name=mysql_query("UPDATE loc_groupname_to_group SET  
	 loc_group_name='".$_REQUEST['loc_grp_name']."' WHERE loc_group_id='".$_REQUEST['lgid']."'")
	 or die(mysql_error());
*/	 
//Alert
 

echo "<meta http-equiv='refresh' content='0;url=index.php?list_loc_group_locations=1&amp;lgid=".$_REQUEST['lgid']."&amp;pid=".$_REQUEST['pid']."'>";

   exit;

 }
 
//Delete
if($_REQUEST['delete']==="Go") 
{ 

$sql_del_loc_grp_nam1=mysql_query("DELETE FROM location_to_group WHERE loc_group_id='".$_REQUEST['lgid']."'") or die(mysql_error()); 
	
$sql_del_loc_grp_nam2=mysql_query("DELETE FROM loc_groupname_to_group WHERE loc_group_id='".$_REQUEST['lgid']."'") or die(mysql_error());	 	
$sql_del_loc_grp_nam3=mysql_query("DELETE FROM loc_group_to_project WHERE loc_group_id='".$_REQUEST['lgid']."'") or die(mysql_error());		
		
	  echo "<meta http-equiv='refresh' content='0;url=index.php?list_projects=1&amp;pid=".$_REQUEST['pid']."'>";

    exit;
 }

//Remove Selected Locations
if($_REQUEST['remove']==="Go") 
{
if(isset($_REQUEST['cbox_rem'])) 
	{
		foreach($_REQUEST['id'] as $key => $id) 
		{
			if(isset($_REQUEST['cbox_rem'][$key])) 
			{
			mysql_query("DELETE FROM location_to_group WHERE
			 loc_id='".$key."' AND
			 loc_group_id='".$_REQUEST['lgid']."'") or die ("Error in query: $sql"); 
			
			}
		}
	}
 
 echo "<meta http-equiv='refresh' content='0;url=index.php?list_loc_group_locations=1&amp;lgid=".$_REQUEST['lgid']."&amp;pid=".$_REQUEST['pid']."'>";

    exit;
	
}
 
//Add Selected Locations
if($_REQUEST['add']==="Go") 
{

if(isset($_REQUEST['cbox_add'])) 
	{				 

		foreach($_REQUEST['new_id'] as $key => $id) 
		{
			if(isset($_REQUEST['cbox_add'][$key])) 
			{
			mysql_query("INSERT INTO location_to_group SET
			loc_id='".$key."',
			loc_group_id='".$_REQUEST['lgid']."'") or die ("Error in query: $sql");
			}
		}
		
 
 echo "<meta http-equiv='refresh' content='0;url=index.php?list_loc_group_locations=1&amp;lgid=".$_REQUEST['lgid']."&amp;pid=".$_REQUEST['pid']."'>";

    exit;
	}
}
?>

<body>

<div class="contain">

	<div class="top_bar">
<form name="new_name" action="" method="post">       
<table>
<tr><td colspan="2">Location Group</td></tr>
<tr style="width:800px">
	<td style="width:300px"><h2 id="com_name"><a href="index.php?show_project=1&amp;pid=
<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; }?>
"><?php echo $row_project['project_name']."&nbsp; >
&nbsp;" ?></a><?php echo $row_loc_group_name['loc_group_name']; ?></h2>
	</td>
<td>
<input value="" name="loc_grp_name" type="text" style="font-size:11px" size="30" /><label for "loc_grp_name">
<br>
Change Group Name</label>
</td>
<tr>
<td></td>
<td><input name="name_change" type="submit" value="Submit">
</td>
  </tr>
  <tr style="width:800px">
    <td style="width:500px"><br> <h3>Selected Locations</h3></td>
<td> <br>
 <h3>Other Locations

</h3></td>
  </tr>
  <tr>
    <td colspan="2"> <span class="bar"><h5 style="border-bottom: 8px solid #0066CC; margin-top:1px; margin-bottom:1px; "></h5> </span></td>
    
  </tr>
</table>
</form>
        
      

	</div>
    
</div>

<div class="contain">    
    
    <div class="top_bar">
    
   
    
		<div class="left_side">
        
        <form name="loc_frm" id="loc_frm" action="#" style="width: 30px;" >

<table width="473" id="loc_group_list">
  
<input type="hidden" name="list_loc_group_locations" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<input type="hidden" name="lgid" value="<?php  echo $_REQUEST['lgid']; ?>" />
 
 <?php 

 while($row = mysql_fetch_assoc($query))       { ?>		
 <tr id="<?php echo $row['loc_id'];?>">
                 <td>
				  <?php  if($row['active_bool']==0) { ?>	
<input type="checkbox" class="cbox_rem" name="cbox_rem[<?php  echo $row['loc_id']; ?>]" value="0">
<input type="hidden" name="id[<?php  echo $row['loc_id']; ?>]" value="<?php  echo $row['loc_id']; ?>">
				  <?php 
	}

	
	if($row['active_bool']==1) {
		?>                 
<input type="checkbox" checked="checked" class="cbox_rem" name="cbox_rem[<?php  echo $row['loc_id']; ?>]" value="1">
<input type="hidden" name="id[<?php  echo $row['loc_id']; ?>]" value="<?php  echo $row['loc_id']; ?>">
				 <?php  } ?>
				 </td>
<td width="420" height="25" id="list">
                <h4 class="del_com">
				<?php  echo $row['loc_name']; ?>
				</h4>
		    </td>

			
    </tr>
<?php } ?> 
 <tr>
      	<td width="36">
<input type="checkbox" value="on" name="allbox_rem" id="allbox_rem" class="allbox_rem"/>    
      </td>
<td>
Check/Uncheck all
</td>
</tr>
 
<tr>
<td>
<input type="hidden" name="list_loc_group_locations" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<input type="hidden" name="lgid" value="<?php  echo $_REQUEST['lgid']; ?>" /> 
<input type="submit" name="remove" id="remove" value="Go"/></td>
<td>Remove selected from this group.</td>
</tr>

<tr>
<td>
<input type="submit" name="delete" id="delete" value="Go" onClick="return confirm('Are you sure want to delete this Group?');" /></td>
<td>Delete this group. 
</td>
</tr>

<!--<tr>
<td><input type="submit" name="save" id="save" value="Go"/></td>
 <td>Save checked.</td>
</tr> -->

</table>
</form>
</div>

<div class="right_side">

<form id="other_locs" action="#" method="post" name="other_locs">

<table width="286" id="loc_group_list2">

<?php 
while($row_notin = mysql_fetch_assoc($sql_query3))
{ ?>
      <tr class="cbox">
        <td width="38">
          <input class="cbox_add" type="checkbox" name="cbox_add[<?php  echo $row_notin['loc_id']; ?>]" >
          <input type="hidden" name="new_id[<?php  echo $row_notin['loc_id']; ?>]" value="<?php  echo $row_notin['loc_id']; ?>">
          
</td>
        
<td height="25">
<h4 class="del_com"><?php  echo $row_notin['loc_name']; ?>
</h4>
<?php  } ?>
</td>
</tr>
<tr>
<td width="29"><input type="checkbox" value="on" name="allbox_add" id="allbox_add" class="allbox_add"/>
</td>
<td>
Check/Uncheck all
</td>
</tr>
 
<tr>
<td><input type="hidden" name="list_loc_group_locations" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<input type="hidden" name="lgid" value="<?php  echo $_REQUEST['lgid']; ?>" />
<input type="submit" name="add" id="add" value="Go"/></td>
<td>Add selected to group 

</td>
</tr>
    
</table>
     
</form>

</div>
	
</div>
    
</div>
</body>
