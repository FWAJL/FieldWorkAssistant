<?php 

error_reporting(1);

	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}


?>

<?php 
// Queries

// User	
$STH_user = $DBH->prepare("SELECT * FROM project_managers");  
$STH_user->execute();
$STH_user->setFetchMode(PDO::FETCH_ASSOC);  
$row_user = $STH_user->fetch();

// Projects
$sql_project = $DBH->prepare("SELECT * FROM project_info");
$sql_project->execute();
$project_result_rows = $sql_project->rowCount();

// Tasks
$sql_task = $DBH->prepare("SELECT * FROM task_info, task_to_project WHERE task_info.task_id=task_to_project.task_id AND project_id='".$_REQUEST['pid']."'");
$sql_task->execute();
$task_result_rows = $sql_task->rowCount();

// Locations
$sql_locations = $DBH->prepare("SELECT * FROM location_info, location_to_project WHERE location_info.loc_id=location_to_project.loc_id AND project_id='".$_REQUEST['pid']."'");
$sql_locations->execute();
$location_result_rows = $sql_locations->rowCount();

// Location Groups
$sql_location_groups = $DBH->prepare("SELECT * FROM groupname_to_group, group_to_project WHERE groupname_to_group.group_id = group_to_project.group_id AND group_to_project.project_id='".$_REQUEST['pid']."'");
$sql_location_groups->execute();
$location_group_rows = $sql_location_groups->rowCount();

// Analytes
$sql_analytes = $DBH->prepare("SELECT * FROM analyte_info, analyte_to_project WHERE analyte_info.analyte_id=analyte_to_project.analyte_id AND project_id='".$_REQUEST['pid']."'");
$sql_analytes->execute();
$analyte_result_rows = $sql_analytes->rowCount();
  
?>
                              
<?php 



$limit=$project_result_rows;

	if(isset($_REQUEST['perpage']))

 	{

$limit=$_REQUEST['perpage'];

 	} 
		
	
	?>
    
    <?php if(isset($_REQUEST['page']))

 	{

$page=$_REQUEST['page'];

 	}
	
	?>

	<!-- CONTENT -->

<div class="project_managers">			

					<h3>User Name: <span><?php echo $row_user['pm_name'];?></span>

						<div align="left">

		      		 		<a href="login.php?logout"  style="color:#73CFFF;">Logout</a>

		      			</div>

					</h3>

					<div class="arrowlistmenu"> 
                    
                                   

<!------------------------------------------start Project--------------------------------------------------------->

                   
						<p class="menuheader expandable arrow">Projects</p>

	
<ul class="categoryitems">

<?php foreach($sql_project as $row) {
if($row['visible']==1) { ?>
<li>
<a href="index.php?pid=<?php echo $row['project_id']; ?>&amp;show_project=1"><?php echo $row['project_name'];?></a></li> 
<?php                  }        

	}  ?>

<li>
<a href="index.php?add_project=1" class="plus">Add New Project</a></li>

							  <li><a href="index.php?list_projects=1&amp;perpage=<?php echo $limit; ?>&amp;page=<?php echo $page; ?>  ">Show/Hide Projects</a></li>



            </ul>    

             <!------------------------------------------End -Project--------------------------------------------------------->

         <div class="line">&nbsp;</div>     
     
 <!------------------------------------------start Tasks--------------------------------------------------------->
<p class="menuheader expandable arrow">Tasks</p>
<ul class="categoryitems">

<?php foreach($sql_task as $row) {
if($row['visible']==1) { ?>
<li>
<a href="index.php?tid=<?php echo $row['task_id']; ?>&amp;edit_task=1&amp;pid=<?php echo $_REQUEST['pid'] ?>"><?php echo $row['task_name'];?></a></li> 
<?php                  }        

	}  ?>

<li>
<a href="index.php?edit_task=1&amp;pid=<?php echo $_REQUEST['pid'] ?>" class="plus">Add New Task</a></li>

<li><a href="index.php?list_tasks=1&amp;pid=<?php echo $_REQUEST['pid'] ?>">Show/Hide Tasks</a></li>

            </ul>    


 <!------------------------------------------end -Tasks--------------------------------------------------------->						
 
 					  <div class="line">&nbsp;</div>                
             <!------------------------------------------start Locationss--------------------------------------------------------->

 <p class="menuheader expandable arrow">Locations</p>
<ul class="categoryitems">

<?php foreach($sql_locations as $row) {
if($row['visible']==1) { ?>
<li>
<a href="index.php?lid=<?php echo $row['loc_id']; ?>&amp;edit_location=1&amp;pid=<?php echo $_REQUEST['pid'] ?>"><?php echo $row['loc_name'];?></a></li> 
<?php                  }        

	}  ?>

								<li><a href="index.php?add_location=1&amp;pid=<?php echo $_REQUEST['pid']; ?>" class="plus" >Add New Location</a></li>
                                
                                <li><a href="index.php?upload_locations=1&amp;pid=<?php echo $_REQUEST['pid']; ?>" class="plus" >Upload Location List</a></li>

							 

							<li><a href="index.php?list_locations=1&amp;pid=<?php echo $_REQUEST['pid']; ?>&amp;tid=<?php echo $_REQUEST['tid']; ?>&amp;page=1">Show/Hide Locations</a></li>

</ul> 

<!------------------------------------------start Groups--------------------------------------------------------->				   		
<p class="menuheader expandable arrow">&nbsp;&nbsp;Location Groups</p>
 <ul class="categoryitems">

<?php foreach($sql_location_groups as $row) { ?>
<li>
<a href="index.php?gid=<?php echo $row['group_id']; ?>&amp;list_group_locations=1&amp;pid=<?php echo $_REQUEST['pid'] ?>"><?php echo $row['group_name'];?></a></li> 
<?php 	}  ?>

</ul>               


 <!------------------------------------------end -Locationss--------------------------------------------------------->						
 
<div class="line">&nbsp;</div>

<!------------------------------------------start Analytes--------------------------------------------------------->

 <p class="menuheader expandable arrow">Analytes</p>
<ul class="categoryitems">

<?php foreach($sql_analytes as $row) {
if($row['visible']==1) { ?>
<li>
<a href="index.php?aid=<?php echo $row['analyte_id']; ?>&amp;edit_analyte=1&amp;pid=<?php echo $_REQUEST['pid'] ?>"><?php echo $row['analyte_name'];?></a></li> 
<?php                  }        

	}  ?>

								<li><a href="index.php?add_analytes=1&amp;pid=<?php echo $_REQUEST['pid']; ?>" class="plus" >Add New Analyte(s)</a></li>
                                
                                <li><a href="index.php?upload_analytes=1&amp;pid=<?php echo $_REQUEST['pid']; ?>" class="plus" >Upload Location List</a></li>

							 

							<li><a href="index.php?list_analytes=1&amp;pid=<?php echo $_REQUEST['pid']; ?>&amp;tid=<?php echo $_REQUEST['tid']; ?>&amp;page=1">Show/Hide Analytes</a></li>

</ul> 

<!------------------------------------------start Groups--------------------------------------------------------->				   		
<p class="menuheader expandable arrow">&nbsp;&nbsp;Analyte Groups</p>
 <ul class="categoryitems">

<?php foreach($sql_analyte_groups as $row) { ?>
<li>
<a href="index.php?agid=<?php echo $row['group_id']; ?>&amp;list_analyte_group_locations=1&amp;pid=<?php echo $_REQUEST['pid'] ?>"><?php echo $row['group_name'];?></a></li> 
<?php 	}  ?>

</ul>               


 <!------------------------------------------end -Analytes--------------------------------------------------------->
 
<div class="line">&nbsp;</div>						

					  <p class="menuheader arrow" >Results</p>

					</div>

				</div>		

	

