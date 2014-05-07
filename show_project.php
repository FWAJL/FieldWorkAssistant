<?php
	
	if(!isset($_SESSION['pm'])){
		header("location:login.php");
	}

	include('config.php');
	
	if(isset($_REQUEST['pid']))
	{
	
		$count=0;
		?>
<style type="text/css">
span.dropt:hover {
	text-decoration: none;
	background: #ffffff;
	z-index: 6;
}
span.dropt span {
	position: absolute;
	left: -9999px;
	margin: 20px 0 0 0px;
	padding: 3px 3px 3px 3px;
	border-style:solid;
	border-color:black;
	border-width:1px;
	z-index: 6;
}
span.dropt:hover span {
	left: 2%;
	background: #ffffff;
}
span.dropt span {
	position: absolute;
	left: -9999px;
	margin: 4px 0 0 0px;
	padding: 3px 3px 3px 3px;
	border-style:solid;
	border-color:black;
	border-width:1px;
}
span.dropt:hover span {
	margin: 20px 0 0 384px;
	background: #ffffff;
	z-index:6;
}
</style>
<!-- CONTENT -->
<?php
		$sql="SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'";
		$results=  mysql_query($sql) or die(mysql_error());
		$count_project=mysql_num_rows($results);
		$row=mysql_fetch_array($results);
		{
			?>
<h2 id="com_name"> 
<a> <?php  echo $row['project_name']; ?></a>  
<a style="font-size:18px;" href="index.php?edit_project=1&amp;pid=<?php  echo $pid; ?>">Edit</a> </h2>
<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>
<div class="group" id="headerdive">
  <table width="100%">
    <tr>
      <td width="30%"><p id="com_name">Project Name:</p></td>
      <td width="70%"><h4 id="com_name1"><?php  echo $row['project_name']; ?></h4>
        </a></td>
    </tr>
    <?php  if($row['project_descr']!=="") { ?>
   <tr>
      <td width="30%"><p id="com_name">Project Description:</p></td>
         <td width="70%"><h4 id="com_name1"><?php  echo $row['project_descr']; ?></h4>
<?php
 } ?>
  </tr>   
  <tr>
      <td width="30%"><p id="com_name">Project Documents:</p></td>
     <td width="70%" align="left"><?php 
			$existing_file_project=mysql_query("SELECT project_document FROM project_documents WHERE project_id='".$_REQUEST['pid']."'");
			while($get_existing_file=mysql_fetch_assoc($existing_file_project)){
				$project_docs[$count]=$get_existing_file['project_document'];
				$count++;
			}

			
			if(isset($project_docs)){
				for($i=0;$i<$count;$i++)   {
					
					if($project_docs[$i]!=''){
						?>
        <a title="Download" href="<?php  echo 'uploadfiles/project_files/'.$_REQUEST['pid'].'/'.$project_docs[$i]; ?>" style="text-decoration: none; float:left;"><?php 
						echo $project_docs[$i];
						
						if($i>=0) echo ",&nbsp;";
						?></a>
        <?php
					}

				}

			}

			?>   
  </table>
  <br class="spacer" />
</div>
<div class="group" id="headerdive">
  <table width="100%" id="fac_comp" class="fac_comp">
    <tr>
      <td colspan="2" align="left"><p id="com_name">Facility Information</p></td>
    </tr>
<?php  if($row['facility_nam']!=="") { ?>
    <tr>
      <td width="30%"><p id="com_name">Name:</p></td>
      <td width="70%" style="padding-left: 5px" align="left"><h4 id="com_name1"><?php  echo $row['facility_nam']; ?></h4></td>
    </tr>
    <?php
 } ?> 
<?php  if($row['facility_address']!=="") { ?>
    <tr>
      <td width="30%"><p id="com_name">Address:</p></td>
      <td width="70%" style="padding-left: 5px" align="left"><h4 id="com_name1"><?php  echo $row['facility_address']; ?></h4></td>
    </tr>
<?php
 } ?> 
 <?php  if($row['facility_lat']!=="") { ?>
    <tr>
      <td width="30%"><p id="com_name" align="left">Latitude:</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['facility_lat']; ?></h4></td>
    </tr>
<?php
 } ?> <?php  if($row['facility_long']!=="") { ?>
    <tr>
      <td width="30%"><p id="com_name">Longitude:</p></td>
     <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['facility_long']; ?></h4></td>
    </tr>
<?php
 } ?> <?php  if($row['facility_contact_nam']!=="") { ?>
  <tr>
      <td width="30%"><p id="com_name" align="left">Contact Name:</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['facility_contact_nam']; ?></h4></td>
    </tr>
<?php
 } ?> <?php  if($row['facility_contact_cell']!=="") { ?>
    <tr>
      <td width="30%"><p id="com_name" align="left">Phone (M):</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['facility_contact_cell']; ?></h4></td>
    </tr>
<?php
 } ?> <?php  if($row['facility_contact_email']!=="") { ?>
        <tr>
      <td width="30%"><p id="com_name" align="left">Email:</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['facility_contact_email']; ?></h4></td>
    </tr>
<?php
 } ?> <?php  if($row['facility_id_num']!=="") { ?>
    <tr>
      <td width="30%"><p id="com_name" align="left">ID Number:</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['facility_id_num']; ?></h4></td>
    </tr>
    </tr>
<?php
 } ?> <?php  if($row['facility_sector']!=="") { ?>
    <tr>
      <td width="30%"><p id="com_name" align="left">Sector:</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['facility_sector']; ?></h4></td>
    </tr>
<?php
 } ?> 
<?php  if($row['facility_sic']!=="0") { ?>
   <tr>
      <td width="30%"><p id="com_name" align="left">SIC Code:</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['facility_sic']; ?></h4></td>
    </tr>
<?php
 } ?> 
  </table>
</div>
<table width = "100%">
 <tr>
      <td colspan="2" align="left"><p id="com_name">Company Information</p></td>
    </tr>
<?php  if($row['company_nam']!=="") { ?>
  <tr>
      <td width="30%"><p id="com_name">Name:</p></td>
      <td width="70%" style="padding-left: 5px" align="left"><h4 id="com_name1"><?php  echo $row['company_nam']; ?></h4></td>
    </tr>
<?php
 } ?> <?php  if($row['company_address']!=="") { ?>
  <tr>
      <td width="30%"><p id="com_name">Address:</p></td>
        <td width="70%" style="padding-left: 5px" align="left"><h4 id="com_name1"><?php  echo $row['company_address']; ?></h4></td>
    </tr>
<?php
 } ?> <?php  if($row['company_contact_nam']!=="") { ?>
   <tr>
      <td width="30%"><p id="com_name" align="left">Contact Name:</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['company_contact_nam']; ?></h4></td>
    </tr>
<?php
 } ?> <?php  if($row['company_contact_cell']!=="") { ?>
   <tr>
      <td width="30%"><p id="com_name" align="left">Phone (M):</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['company_contact_cell']; ?></h4></td>
    </tr>
<?php
 } ?> <?php  if($row['company_contact_email']!=="") { ?>
   <tr>
      <td width="30%"><p id="com_name" align="left">Email:</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['company_contact_email']; ?></h4></td>
    </tr>
<?php
 } ?> <?php  if($row['company_id_num']!=="") { ?>
   <tr>
      <td width="30%"><p id="com_name" align="left">ID Number:</p></td>
      <td width="70%"  style="padding-left: 5px"  align="left"><h4 id="com_name1"><?php  echo $row['company_id_num']; ?></h4></td>
    </tr>
<?php
 } ?>
</table>
<br class="spacer" />
</div>
<?php
 } ?>
<br class="spacer" />
<!-- CONTENT --> 
<!-- FOOTER -->
<?php
 } else { ?>
<!-- CONTENT -->
<h2>Please Click on the Left Menu </h2>
<br class="spacer" />
<!-- CONTENT --> 
<!-- FOOTER --> 
<!-- FOOTER -->
<?php
 } ?>

