<?php

$con = mysql_connect("localhost","baiken_fwa","fwa1");


if (!$con)

  {

  die('Could not connect: ' . mysql_error());

  }

// mysql_select_db('baiken_fwa',$con);

mysql_select_db('baiken_fwa',$con);

/* Open a connection */
$mysqli = new mysqli("localhost", "baiken_fwa", "fwa1", "baiken_fwa");

/* check connection*/
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 


  # MySQL with PDO_MYSQL  
$user=baiken_fwa;
$pass=fwa1;

try {    
  

  $DBH = new PDO("mysql:host=localhost;dbname=baiken_fwa", $user, $pass);  
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}  
catch(PDOException $e) {  
    echo $e->getMessage();  
}  


?>