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
		
		header("analyte:login.php");
	}

	include('config.php');
	
// Queries	

// Project info	
$STH_project = $DBH->prepare("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");  
$STH_project->execute();
$STH_project->setFetchMode(PDO::FETCH_ASSOC);  
$row_project = $STH_project->fetch();

// Group Name
$STH_groupname = $DBH->prepare("SELECT * FROM anal_groupname_to_group WHERE anal_group_id = '".$_REQUEST['agid']."'");  
$STH_groupname->execute();
$STH_groupname->setFetchMode(PDO::FETCH_ASSOC);  
$row_anal_groupname = $STH_groupname->fetch();



$sql_analyte_group_name=mysql_query("SELECT * FROM anal_groupname_to_group WHERE anal_group_id = '".$_REQUEST['agid']."'");
$row_analyte_group_name=mysql_fetch_assoc($sql_analyte_group_name);

// All Analytes - check
$query = mysql_query("SELECT analyte_to_group.analyte_id, analyte_name FROM analyte_to_group, analyte_info WHERE analyte_to_group.analyte_id=analyte_info.analyte_id AND anal_group_id='".$_REQUEST['agid']."' ORDER BY analyte_name") or die(mysql_error());

//Analytes in group - check
$query1 = mysql_query("SELECT * FROM analyte_to_group WHERE anal_group_id='".$_REQUEST['agid']."'");
$x=mysql_num_rows($query1);

//Analytes Not in Group
$sql_query3=mysql_query("SELECT analyte_to_project.analyte_id, analyte_name FROM analyte_to_project, analyte_info
WHERE analyte_info.analyte_id = analyte_to_project.analyte_id AND project_id='".$_REQUEST['pid']."' AND NOT EXISTS
 (SELECT * FROM analyte_to_group 
 WHERE anal_group_id='".$_REQUEST['agid']."' 
 AND analyte_to_group.analyte_id = analyte_to_project.analyte_id)  ORDER BY analyte_name") or die(mysql_error());
 
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

		mysql_query("UPDATE analyte_info SET active_bool=1 WHERE analyte_id IN (".implode(',', $checked).")");
		mysql_query("UPDATE analyte_info SET active_bool=0 WHERE analyte_id IN (".implode(',', $unchecked).")");
	} else {
		
		if(!isset($_REQUEST['cbox_rem'])) {
			foreach($_REQUEST['id'] as $key => $id) {
				$unchecked[] = $id;
			}

		}

		mysql_query("UPDATE analyte_info SET active_bool=0 WHERE analyte_id IN (".implode(',', $unchecked).")");
	}

}*/

?>

<?php

//Update Analyte Group Name
if($_REQUEST['name_change']=="Submit")
{
	
$sql_chg_grp_nam = "UPDATE  anal_groupname_to_group SET 
anal_group_name = :anal_group_nam
WHERE anal_group_id= '".$_REQUEST['agid']."'
"; 
$stmt = $DBH->prepare($sql_chg_grp_nam);
$stmt->bindParam(':anal_group_nam', $_POST['anal_grp_name'], PDO::PARAM_STR); 
$stmt->execute();	
	
/*$sql_new_analyte_group_name=mysql_query("UPDATE analyte_groupname_to_group SET  
	 analyte_group_name='".$_REQUEST['analyte_grp_name']."' WHERE anal_group_id='".$_REQUEST['agid']."'")
	 or die(mysql_error());
*/	 
//Alert
 

echo "<meta http-equiv='refresh' content='0;url=index.php?list_anal_group_analytes=1&amp;agid=".$_REQUEST['agid']."&amp;pid=".$_REQUEST['pid']."'>";

   exit;

 }
 
//Delete
if($_REQUEST['delete']==="Go") 
{ 

$sql_del_analyte_grp_nam1=mysql_query("DELETE FROM analyte_to_group WHERE anal_group_id='".$_REQUEST['agid']."'") or die(mysql_error()); 
	
$sql_del_analyte_grp_nam2=mysql_query("DELETE FROM anal_groupname_to_group WHERE anal_group_id='".$_REQUEST['agid']."'") or die(mysql_error());	 	
$sql_del_analyte_grp_nam3=mysql_query("DELETE FROM anal_group_to_project WHERE anal_group_id='".$_REQUEST['agid']."'") or die(mysql_error());		
		
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
			mysql_query("DELETE FROM analyte_to_group WHERE
			 analyte_id='".$key."' AND
			 anal_group_id='".$_REQUEST['agid']."'") or die ("Error in query: $sql"); 
			
			}
		}
	}
 
 echo "<meta http-equiv='refresh' content='0;url=index.php?list_anal_group_analytes=1&amp;agid=".$_REQUEST['agid']."&amp;pid=".$_REQUEST['pid']."'>";

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
			mysql_query("INSERT INTO analyte_to_group SET
			analyte_id='".$key."',
			anal_group_id='".$_REQUEST['agid']."'") or die ("Error in query: $sql");
			}
		}
		
 
 echo "<meta http-equiv='refresh' content='0;url=index.php?list_anal_group_analytes=1&amp;agid=".$_REQUEST['agid']."&amp;pid=".$_REQUEST['pid']."'>";

    exit;
	}
}
?>

<body>

<div class="contain">

	<div class="top_bar">
<form name="new_name" action="" method="post">       
<table>
<tr><td colspan="2">Analyte Group</td></tr>
<tr style="width:800px">
	<td style="width:300px"><h2 id="com_name"><a href="index.php?show_project=1&amp;pid=
<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; }?>
"><?php echo $row_project['project_name']."&nbsp; >
&nbsp;" ?></a><?php echo $row_anal_groupname['anal_group_name']; ?></h2>
	</td>
<td>
<input value="" name="anal_grp_name" type="text" style="font-size:11px" size="30" /><label for "analyte_grp_name">
<br>
Change Group Name</label>
</td>
<tr>
<td></td>
<td><input name="name_change" type="submit" value="Submit">
</td>
  </tr>
  <tr style="width:800px">
    <td style="width:500px"><br> <h3>Selected Analytes</h3></td>
<td> <br>
 <h3>Other Analytes

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
        
        <form name="analyte_frm" id="analyte_frm" action="#" style="width: 30px;" >

<table width="473" id="analyte_group_list">
  
<input type="hidden" name="list_anal_group_analytes" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<input type="hidden" name="agid" value="<?php  echo $_REQUEST['agid']; ?>" />
 
 <?php 

 while($row = mysql_fetch_assoc($query))       { ?>		
 <tr id="<?php echo $row['analyte_id'];?>">
                 <td>
				  <?php  if($row['active_bool']==0) { ?>	
<input type="checkbox" class="cbox_rem" name="cbox_rem[<?php  echo $row['analyte_id']; ?>]" value="0">
<input type="hidden" name="id[<?php  echo $row['analyte_id']; ?>]" value="<?php  echo $row['analyte_id']; ?>">
				  <?php 
	}

	
	if($row['active_bool']==1) {
		?>                 
<input type="checkbox" checked="checked" class="cbox_rem" name="cbox_rem[<?php  echo $row['analyte_id']; ?>]" value="1">
<input type="hidden" name="id[<?php  echo $row['analyte_id']; ?>]" value="<?php  echo $row['analyte_id']; ?>">
				 <?php  } ?>
				 </td>
<td width="420" height="25" id="list">
                <h4 class="del_com">
				<?php  echo $row['analyte_name']; ?>
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
<input type="hidden" name="list_anal_group_analytes" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<input type="hidden" name="agid" value="<?php  echo $_REQUEST['agid']; ?>" /> 
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

<form id="other_analytes" action="#" method="post" name="other_analytes">

<table width="286" id="analyte_group_list2">

<?php 
while($row_notin = mysql_fetch_assoc($sql_query3))
{ ?>
      <tr class="cbox">
        <td width="38">
          <input class="cbox_add" type="checkbox" name="cbox_add[<?php  echo $row_notin['analyte_id']; ?>]" >
          <input type="hidden" name="new_id[<?php  echo $row_notin['analyte_id']; ?>]" value="<?php  echo $row_notin['analyte_id']; ?>">
          
</td>
        
<td height="25">
<h4 class="del_com"><?php  echo $row_notin['analyte_name']; ?>
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
<td><input type="hidden" name="list_anal_group_analytes" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<input type="hidden" name="agid" value="<?php  echo $_REQUEST['agid']; ?>" />
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
