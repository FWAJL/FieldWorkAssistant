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
var check_id_arr=[];
function check(id)
{
check_id_arr.push(id);
console.log(check_id_arr);
}
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

//Delete group
function del()
{
	$.ajax({
type:"POST",
url:"delete.php",
data:'id='+'<?php echo $_REQUEST['bgid'];?>',
success:function(){
}
});
}

//Remove Selected Items
function removeselected()
{
	$.ajax({
type:"POST",
url:"removeselected.php",
data:'id='+'<?php echo $_REQUEST['bgid'];?>'+'&key='+check_id_arr,
success:function(){
}   
 });
  
        if ($(" #allbox_rem").is(':checked')) {
	$.ajax({
type:"POST",
url:"removeallbound.php",
data:'id='+'<?php echo $_REQUEST['bgid'];?>',
success:function(){
}   
 });
}
}
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
$sql_bound_group_name=mysql_query("SELECT * FROM bound_groupname_to_group WHERE bound_group_id = '".$_REQUEST['bgid']."'");
$row_bound_group_name=mysql_fetch_assoc($sql_bound_group_name);
// All Locations 
$query = mysql_query("SELECT boundary_to_group.bound_id, bound_name FROM boundary_to_group, boundary WHERE boundary_to_group.bound_id=boundary.id AND bound_group_id='".$_REQUEST['bgid']."' ORDER BY bound_name") or die(mysql_error());

//Locations in group 	
$query1 = mysql_query("SELECT * FROM boundary_to_group WHERE bound_group_id='".$_REQUEST['bgid']."'");
$x=mysql_num_rows($query1);

//Locations for the project
$query2 = mysql_query("SELECT * FROM boundary_to_group WHERE bound_group_id='".$_REQUEST['bgid']."'");

//Locations Not in Group
$sql_query3=mysql_query("SELECT boundary_to_project.bound_id, boundary.bound_name FROM boundary_to_project, boundary WHERE boundary.id = boundary_to_project.bound_id AND boundary.project_id='".$_REQUEST['pid']."' AND boundary_to_project.project_id='".$_REQUEST['pid']."' AND NOT EXISTS (SELECT * FROM boundary_to_group WHERE bound_group_id='".$_REQUEST['bgid']."' AND boundary_to_group.bound_id = boundary_to_project.bound_id)  ORDER BY bound_name") or die(mysql_error());

?> 	

<?php
//Update Location Group Name
if($_REQUEST['name_change']=="Submit")
{

$sql_chg_grp_nam = "UPDATE  bound_groupname_to_group SET 
bound_group_name = :bound_group_nam
WHERE bound_group_id= '".$_REQUEST['bgid']."'
"; 
$stmt = $DBH->prepare($sql_chg_grp_nam);
$stmt->bindParam(':bound_group_nam', $_POST['bound_grp_name'], PDO::PARAM_STR); 
$stmt->execute();	
echo "<meta http-equiv='refresh' content='0;url=index.php?list_bound_group_locations=1&amp;bgid=".$_REQUEST['bgid']."&amp;pid=".$_REQUEST['pid']."'>";

   exit;
 }

//Delete

//Add Selected Locations
if($_REQUEST['add']==="Go") 
{
if(isset($_REQUEST['cbox_add'])) 
	{				 

		foreach($_REQUEST['new_id'] as $key => $id) 
		{
			if(isset($_REQUEST['cbox_add'][$key])) 
			{
			mysql_query("INSERT INTO boundary_to_group SET
			bound_id='".$key."',
			bound_group_id='".$_REQUEST['bgid']."'") or die ("Error in query: $sql");
			}
		}
		 echo "<meta http-equiv='refresh' content='0;url=index.php?list_bound_group_boundaries=1&amp;bgid=".$_REQUEST['bgid']."&amp;pid=".$_REQUEST['pid']."'>";
    exit;
	}
}
?>

<body>

<div class="contain">

	<div class="top_bar">
<form name="new_name" action="" method="post">       
<table>
<tr><td colspan="2">Boundary Group</td></tr>
<tr style="width:800px">
	<td style="width:300px"><h2 id="com_name"><a href="index.php?show_project=1&amp;pid=
<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; }?>
"><?php echo $row_project['project_name']."&nbsp; >
&nbsp;" ?></a><?php echo $row_bound_group_name['bound_group_name']; ?></h2>
	</td>
<td>
<input value="" name="bound_grp_name" type="text" style="font-size:11px" size="30" /><label for "bound_grp_name">
<br>
Change Group Name</label>
</td>
<tr>
<td></td>
<td><input name="name_change" type="submit" value="Submit">
</td>
  </tr>
  <tr style="width:800px">
    <td style="width:500px"><br> <h3>Selected Boundaries</h3></td>
<td> <br>
 <h3>Other Boundaries

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
        
        <form name="bound_frm" id="bound_frm" action="#" style="width: 30px;" >

<table width="473" id="bound_group_list">
  <input type="hidden" name="list_bound_group_locations" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<input type="hidden" name="bgid" value="<?php  echo $_REQUEST['bgid']; ?>" />
 
 <?php 

 while($row = mysql_fetch_assoc($query))       { ?>		
 <tr id="<?php echo $row['bound_id'];?>">
                 <td>
				  <?php  if($row['active_bool']==0) { ?>	
<input type="checkbox" class="cbox_rem" name="cbox_rem[<?php  echo $row['bound_id']; ?>]" value="0" onclick="check(<?php  echo $row['bound_id']; ?>)">
<input type="hidden" name="id[<?php  echo $row['bound_id']; ?>]" value="<?php  echo $row['bound_id']; ?>">
				  <?php 
	}

	if($row['active_bool']==1) {
		?>                 
<input type="checkbox" checked="checked" class="cbox_rem" name="cbox_rem[<?php  echo $row['bound_id']; ?>]" value="1" onclick="check(<?php  echo $row['bound_id']; ?>)">
<input type="hidden" name="id[<?php  echo $row['bound_id']; ?>]" value="<?php  echo $row['bound_id']; ?>">
				 <?php  } ?>
				 </td>
<td width="420" height="25" id="list">
                <h4 class="del_com">
				<?php  echo $row['bound_name']; ?>
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
<input type="hidden" name="list_bound_group_locations" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<input type="hidden" name="bgid" value="<?php  echo $_REQUEST['bgid']; ?>" /> 
<input type="submit" name="remove" id="remove" value="Go" onclick="removeselected()"/></td>
<td>Remove selected from this group.</td>
</tr>
<tr>
<td>
<input type="submit" name="delete" id="delete" value="Go" onClick="del();" /></td>
<td>Delete this group. 
</td>
</tr>
</table>
</form>
</div>

<div class="right_side">
<form id="other_bounds" action="#" method="post" name="other_bounds">
<table width="286" id="bound_group_list2">
<?php 
while($row_notin = mysql_fetch_assoc($sql_query3))
{ ?>
      <tr class="cbox">
        <td width="38">
          <input class="cbox_add" type="checkbox" name="cbox_add[<?php  echo $row_notin['bound_id']; ?>]" >
          <input type="hidden" name="new_id[<?php  echo $row_notin['bound_id']; ?>]" value="<?php  echo $row_notin['bound_id']; ?>">     
</td>     
<td height="25">
<h4 class="del_com"><?php  echo $row_notin['bound_name']; ?>
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
<td><input type="hidden" name="list_bound_group_boundaries" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<input type="hidden" name="bgid" value="<?php  echo $_REQUEST['bgid']; ?>" />
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