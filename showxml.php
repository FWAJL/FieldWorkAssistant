<?php
$id=$_GET['id'];
$dom = new DOMDocument("1.0");
$node = $dom->createElement("string");
$parentnode = $dom->appendChild($node);
require('config.php');
$query =("SELECT * FROM boundary WHERE project_id='$id'"); 
$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}
else
{
header("Content-type: text/xml");
while ($row = @mysql_fetch_assoc($result)){
  $node = $dom->createElement("marker");
  $info = $parentnode->appendChild($node);
  $info->setAttribute("position", convert_uudecode($row['position']));

  }
echo $dom->saveXML();
}
?>