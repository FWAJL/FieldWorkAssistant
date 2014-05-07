<?php
include("config.php");

$id=$_POST['id'];	

$query=mysql_query("UPDATE boundary SET visible='-1' WHERE id='$id'");

  /*file_put_contents("test.txt", "");
$file = fopen("test.txt","a");
echo fwrite($file,$id.",");
fclose($file);*/
?>