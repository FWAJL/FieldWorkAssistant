<?php

if(!isset($_SESSION['pm']))

{

  header("location:login.php");
  
}

require_once('../Connections/New_db.php');

$proj_id="$pid";

$proj_enc="$pid";


if(isset($_REQUEST['pid']))

		{
			
	include('config.php');		


			$sql4=mysql_query("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");

			$row4=mysql_fetch_array($sql4);

		}


if(isset($_POST['submit']))

{

$target_path = "uploadfiles/upload_analyte/";

$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	
	?>
      <script type="text/javascript">
    alert("The file <?php echo $_FILES['uploadedfile']['name']; ?> was uploaded.  analytes were added to <?php if(isset($row4['project_name'])) { echo $row4['project_name'].""; } ?>");
  </script>
	
    <?php
} else{
    echo "There was an error uploading the file, please try again!";
	
	 exit;
	
}	

//<!-- Original number of rows --> 	
mysql_select_db($database_New_db, $New_db);
$query_Recordset1 = "SELECT * FROM analyte_info";
$Recordset1 = mysql_query($query_Recordset1, $New_db) or die(mysql_error());
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
//<!-- Original number of rows --> 
	
	mysql_query('
LOAD DATA LOCAL INFILE "'.$target_path.'"
REPLACE INTO TABLE analyte_info 
FIELDS TERMINATED BY "," 
 (analyte_name)
;')
or die('Error Loading Data File.<br>' . mysql_error());
	

//<!-- Last inserted -->

 $sql1=mysql_query("SELECT * FROM  `analyte_info` WHERE  `analyte_id` = (SELECT MAX(  `analyte_id` ) FROM  `analyte_info` )");
 
 $row1=mysql_fetch_array($sql1);
 
 //<!-- Last inserted -->
 
 

//<!-- New number of rows -->

mysql_select_db($database_New_db, $New_db);
$query_Recordset2 = "SELECT * FROM analyte_info";
$Recordset2 = mysql_query($query_Recordset2, $New_db) or die(mysql_error());
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

//<!-- New number of rows --> 
	
	
$num_rows=$totalRows_Recordset2-$totalRows_Recordset1;
   
  for ($x=$row1['analyte_id']-$num_rows+1; $x<=$row1['analyte_id']; $x++)
   {

 $in=mysql_query("INSERT INTO analyte_to_project SET analyte_id='$x',project_id='".$proj_id."'");

   } 	
echo "<meta http-equiv='refresh' content='0;url=index.php?show_project=1&amp;pid=".$_REQUEST['pid']."'>";

 exit;   

	}
	
?>

<style type="text/css">

	.edit_com{

			   width:186px;

			   height:30px;

			   box-shadow:0px 0px 2px 0px;

			 }

	

	</style>

       
       <h2 id="com_name">
        
        <a href="index.php?show_project=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid; }?>" > 

  <?php if(isset($row4['project_name'])) { echo $row4['project_name'].""; } ?></a>


        </h2>
       
<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; ">Needs to be coded for analytes</h5>

<br />



<br />


<form enctype="multipart/form-data" action="" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" name="submit" id="submit" value="Upload File" />
</form>

