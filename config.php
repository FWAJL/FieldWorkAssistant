<?php

/*
 * To make it easier to change the DB credentials, let's make a nice array
 * You can change the config used by modifying just the variable $db_config_used
 * 
 * Below, we get the value in the selected array based on the key (host, user, pwd, etc...)
 * That way, when we change the credentials, we have to do it only in one place instead of 3.
 */

/*Configuration section*/
$db_config_used = "local_mysql";

$db_config["local_mysql"]["host"] = "localhost";
$db_config["local_mysql"]["user"] = "test_fwa";
$db_config["local_mysql"]["pwd"] = "fwa1_6231One@";
$db_config["local_mysql"]["default_db_name"] = "baiken_fwa";

$db_config["remote_mysql"]["host"] = "";
$db_config["remote_mysql"]["user"] = "";
$db_config["remote_mysql"]["pwd"] = "";
$db_config["remote_mysql"]["default_db_name"] = "";
/*End of Configuration section*/

//get the array with the database config to use
$db = $db_config[$db_config_used];

/*  Original MYSQL method   */
//$con = mysql_connect("localhost","baiken_fwa","fwa1");
$con = mysql_connect($db["host"], $db["user"], $db["pwd"]);

if (!$con) {
    die('Could not connect: ' . mysql_error());
}
//mysql_select_db('baiken_fwa',$con);
mysql_select_db($db["default_db_name"], $con);

/*  MYSQLI method   */
/* Open a connection */
//$mysqli = new mysqli("localhost", "baiken_fwa", "fwa1", "baiken_fwa");
$mysqli = new mysqli($db["host"], $db["user"], $db["pwd"], $db["default_db_name"]);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/*  PDO method   */
try {
    $DBH = new PDO("mysql:host=" . $db["host"] . ";dbname=" . $db["default_db_name"], $db["user"], $db["pwd"]);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}  