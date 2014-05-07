<?php
include('config.php');
$query =("SELECT * FROM boundary"); 
$result = mysql_query($query);
while($row=mysql_fetch_array($result))
{
$id=$row['id'];
$file = fopen("test.txt","a");
echo fwrite($file,$id.",");
fclose($file);
}
?>