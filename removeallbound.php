<?php
include('config.php');
$id=$_POST['id'];
//$boundid=$_POST['key'];

 mysql_query("DELETE FROM boundary_to_group WHERE bound_group_id='$id'"); 

?>