<?php
$lat=mysql_real_escape_string(convert_uuencode($_POST["lat"]));
//$lat=str_rot13($_POST["lat"]);
//$lat=mysql_real_escape_string($_POST["lat"]);
$place=$_POST["placename"];
$pid=$_POST['pid'];
echo $pid;
include('config.php');
$result=mysql_query("insert into boundary(position,bound_name,project_id) values('$lat','$place','$pid')");
 $lastinserted=mysql_insert_id();

 $in=mysql_query("INSERT INTO boundary_to_project(bound_id,project_id) VALUES('$lastinserted','$pid')");
 if($result)
{

 
echo "success";
}
?>