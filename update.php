<?php
$lat=$_POST["lat"];
$lng=$_POST["lng"];
$pid=$_POST["pid"];
echo $lat;
echo $lng;
echo $pid;
include("config.php");

$result=mysql_query("UPDATE project_info SET facility_lat =$lat, facility_long =$lng WHERE project_id ='$pid'");
if($result)
{
echo "success";
}
?>