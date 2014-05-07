<?php

if(!isset($_SESSION['pm']))

{

  header("location:login.php");

}

// Queries

include('config.php');

// Current PM INFO

// Project	
$STH_project = $DBH->prepare("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");  
$STH_project->execute();
$STH_project->setFetchMode(PDO::FETCH_ASSOC);  
$row_project = $STH_project->fetch();

?>

<?php

if(isset($_REQUEST['submit'])) 
{ 
 
$analytes = explode("\n", $_POST["multi_analytes"]);
  foreach($analytes as $key => $value)
	{

$STH_analyte_info = "INSERT INTO analyte_info
(analyte_name)
VALUES
('{$value}')";
$stmt1 = $DBH->prepare($STH_analyte_info);
$stmt1->execute();

$insertId = $DBH->lastInsertId();

$STH_analyte_project = "INSERT INTO analyte_to_project
(analyte_id, 
project_id)
VALUES
(:id,
:pid)
";
$stmt2 = $DBH->prepare($STH_analyte_project);
$stmt2->bindParam(':id', $insertId, PDO::PARAM_INT); 
$stmt2->bindParam(':pid', $_REQUEST['pid'], PDO::PARAM_INT);
$stmt2->execute();

	}


} ?>

<!--
	  echo "<meta http-equiv='refresh' content='0;url=index.php?loc_display=1&amp;lid=".$lastinserted."&amp;pid=".$_REQUEST['pid']."'>";

    exit; -->




<h2 id="com_name"> 

 <a href="index.php?show_project=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; }?>" > 

  <?php if(isset($row_project['project_id'])) { echo $row_project['project_name']."&nbsp; > &nbsp;"; } ?>
 </a>
 
  
  Add New Analyte(s)</h2>


<style type="text/css">

	.edit_com{

			   width:186px;

			   height:30px;

			   box-shadow:0px 0px 2px 0px;

			 }

	

	</style>

<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>

<br />

<br />


<form name="add_location" action="" method="post" style='display:inline;'>


  <table  style="line-height:40px" width="50%">

    <tr>

      <td>
      
      <textarea name="multi_analytes" cols="100" rows="7"></textarea></td>


    </tr>

   
    <tr>


      <td><input type="submit" name="submit"  id="submit" value="Add New Analytes" /></td>

    </tr>

  </table>
 </form> 
<span>
<p>Enter one or more analytes in the box above.</p>
<p>To separate analytes, use &quot;Return&quot; after each analyte.</p>
<p>Like this:</p></span>

<div>VOCs<br />
BTEX<br />
Conductivity
</div>