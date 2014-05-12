<?php
$project=$_GET['proj'];
$dom = new DOMDocument("1.0");
$node = $dom->createElement("string");
$parentnode = $dom->appendChild($node);
include("config.php");
$query =("SELECT * FROM project_info WHERE project_name='$project'"); 
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
  $info->setAttribute("lat", $row['facility_lat']);
  $info->setAttribute("lng", $row['facility_long']);

  }
echo $dom->saveXML();
}
?>