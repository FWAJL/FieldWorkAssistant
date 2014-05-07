<?php
include('config.php');
$id=$_POST['id'];
echo $id;

$sql_del_bound_grp_nam1=mysql_query("DELETE FROM boundary_to_group WHERE bound_group_id='$id'") or die(mysql_error()); 
$sql_del_bound_grp_nam2=mysql_query("DELETE FROM bound_groupname_to_group WHERE bound_group_id='$id'") or die(mysql_error());	 	
$sql_del_bound_grp_nam3=mysql_query("DELETE FROM bound_group_to_project WHERE bound_group_id='$id'") or die(mysql_error());
?>