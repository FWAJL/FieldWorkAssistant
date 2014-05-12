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

<li><a href="index.php?list_tasks=1&amp;pid=<?php echo $_REQUEST['pid']; ?>">Show/Hide Tasks</a></li>

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
                               <!-- <li><a href="index.php?add_boundary=1&amp;pid=    //php echo $_REQUEST['pid']; ?>" class="plus">Add Boundary</a></li>-->

                                <li><a href="index.php?upload_locations=1&amp;pid=<?php echo $_REQUEST['pid']; ?>" class="plus" >Upload Location List</a></li>

<li><a href="index.php?list_locations=1&amp;pid=<?php echo $_REQUEST['pid']; ?>&amp;tid=<?php echo $_REQUEST['tid']; ?>&amp;page=1">Show/Hide Locations</a></li>
<!--<li><a href="index.php?list_boundaries=1&amp;pid=   ?php echo $_REQUEST['pid']; ?>&amp;tid= ?php echo $_REQUEST['tid']; ?>&amp;page=1">Show/Hide Boundaries</a></li>-->

</ul> 

<!------------------------------------------start Groups--------------------------------------------------------->				   		
<p class="menuheader expandable arrow">&nbsp;&nbsp;Location Groups</p>
 <ul class="categoryitems">

<?php foreach($sql_location_groups as $row) { ?>
<li>
<a href="index.php?lgid=<?php echo $row['loc_group_id']; ?>&amp;list_loc_group_locations=1&amp;pid=<?php echo $_REQUEST['pid'] ?>"><?php echo $row['loc_group_name'];?></a></li> 
<?php 	}  ?>

</ul>               
<!--<p class="menuheader expandable arrow">&nbsp;&nbsp;Boundary Groups</p>
 <ul class="categoryitems">

?php foreach($sql_boundary_groups as $row) { ?>
<li>
<a href="index.php?bgid=  ?php echo $row['bound_group_id']; ?>&amp;list_bound_group_boundaries=1&amp;pid=  ?php echo $_REQUEST['pid'] ?>">  ?php echo $row['bound_group_name'];?></a></li> 
 ?php 	}  ?>

</ul> -->

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
                                
                                <li><a href="index.php?upload_analytes=1&amp;pid=<?php echo $_REQUEST['pid']; ?>" class="plus" >Upload Analyte List</a></li>

							 

							<li><a href="index.php?list_analytes=1&amp;pid=<?php echo $_REQUEST['pid']; ?>&amp;tid=<?php echo $_REQUEST['tid']; ?>&amp;page=1">Show/Hide Analytes</a></li>

</ul> 

<!------------------------------------------start Groups--------------------------------------------------------->				   		
<p class="menuheader expandable arrow">&nbsp;&nbsp;Analyte Groups</p>
 <ul class="categoryitems">

<?php foreach($sql_analyte_groups as $row) { ?>
<li>
<a href="index.php?agid=<?php echo $row['anal_group_id']; ?>&amp;list_anal_group_analytes=1&amp;pid=<?php echo $_REQUEST['pid'] ?>"><?php echo $row['anal_group_name'];?></a></li> 
<?php 	}  ?>
</ul>               
 <!------------------------------------------end -Analytes--------------------------------------------------------->
<div class="line">&nbsp;</div>						
					  <p class="menuheader arrow" >Results</p>
					</div>
				</div>		