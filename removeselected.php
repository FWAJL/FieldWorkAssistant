<?php
include('config.php');
$id=$_POST['id'];
$boundid=$_POST['key'];

//foreach($boundid as $bound_id){
 //    echo $bound_id;
 $id_arr=explode(",",$boundid);
 $length=count($id_arr);
 for($i=0;$i<$length;$i++)
 {
	  mysql_query("DELETE FROM boundary_to_group WHERE bound_id='$id_arr[$i]' AND bound_group_id='$id'"); 
}
  
?>