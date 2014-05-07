<?php
include('config.php');
$id=$_POST['id'];	
$file = fopen("test.txt","a");
echo fwrite($file,$id.",");
fclose($file);
?>