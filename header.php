<!-- HEADER -->
	<div id="header">
    
		<div class="header_wrapper">

<a href="index.php"><img src="images/logo.png" width="365" height="74" alt="LOGO" /></a>

		</div>

	</div>

<!-- HEADER -->
    
<!-- NAV -->

<div id="nav">
<div class="nav_wrapper">
 <ul class="menu" id="menu">
  <!-- Field Personnel -->
  <li><a href="">Field Personnel</a>
   <ul>
    <li><a href="index.php?list_people=1?<?php if(isset($_REQUEST['pid'])) { echo "&amp;pid=".$_REQUEST['pid']; } if(isset($_REQUEST['tid'])) { echo "&amp;tid=".$_REQUEST['tid']; }  ?>">View/Assign Personnel</a></li>
	<li><a href="index.php?add_people=1">Add Personnel</a></li>
    </ul>
	</li>
    
<!-- Map -->
<li class="mapmenu"><a>Map</a>
<?php if($_REQUEST['list_projects']==1) { 
	 echo '<ul>
    	<li><a href="index.php?place_g_fac=1&all_proj=1">All Projects</a></li>
		<li><a href="index.php?place_g_fac=1&sel_projs=1">Selected Projects</a></li>
    	</ul>';
	} 
	elseif($_REQUEST['list_locations']==1) { 
    echo '<ul>
    	<li><a href="index.php?place_g_loc=1&this_proj_all_locs=1&pid='.$_REQUEST['pid'].'">All Locations</a></li>
		<li><a href="index.php?place_g_loc=1&this_proj_sel_locs=1&pid='.$_REQUEST['pid'].'">Selected Locations</a></li>
    </ul>';
     }
	 
	 elseif($_REQUEST['list_boundaries']==1) { 
    echo '<ul>
    	    	<li><a href="index.php?show_boundary=1&all_proj=1&pid='.$_REQUEST['pid'].'">All Boundaries</a></li>
    	    	<li><a href="index.php?show_boundarys=1&sel_boundary=1&pid='.$_REQUEST['pid'].'">Selected Boundaries</a></li>
    </ul>';
     } 

	 elseif($_REQUEST['lgid']>=1) { 
    echo '<ul>
    	<li><a href="index.php?place_g_loc=1&group_locs=1&lgid='.$_REQUEST['lgid'].'">Group Locations</a></li>
	    </ul>';
     }
	 elseif($_REQUEST['lid']>=1) { 
    echo '<ul>
    	<li><a href="index.php?place_g_loc=1&sel_loc=1&lid='.$_REQUEST['lid'].'">This Location</a></li>
	    </ul>';
     }
	 elseif($_REQUEST['pid']>=1 && !isset($_REQUEST['edit_task']) && !isset($_REQUEST['list_tasks'])) { 
    echo '<ul>
    	<li><a href="index.php?place_g_fac=1&sel_proj=1&pid='.$_REQUEST['pid'].'">This Project</a></li>
		<li><a href="index.php?place_g_loc=1&this_proj_all_locs=1&pid='.$_REQUEST['pid'].'">All Locations for this Project</a></li>
    </ul>';
     }	
if(isset($_REQUEST['place_g_fac']))

				{
include("place_g_fac.php");
				print "<script>";
				print "</script>";
        			exit;
				 
				}	 
	 ?>
    
</li>

<li><a href="#">Analytes</a>
	<ul>
		<li><a href="#">Groundwater</a>
        	<ul>
				<li><a href="#">Create my custom list</a></li>
				<li><a href="#">Use a standard list</a></li>
			</ul>
		</li>

		<li><a href="#">Wastewater</a>
        	<ul>
				<li><a href="#">Create my custom list</a></li>
				<li><a href="#">Use a standard list</a></li>
			</ul>
		</li>
        
        <li><a href="#">Air</a>
        	<ul>
				<li><a href="#">Create my custom list</a></li>
				<li><a href="#">Use a standard list</a></li>
			</ul>
		</li>
        
        <li><a href="#">Soil</a>
        	<ul>
				<li><a href="#">Create my custom list</a></li>
				<li><a href="#">Use a standard list</a></li>
			</ul>
		</li>

	</ul>
</li>


                

<!--                <li><a href="#">Work Flow</a>

					<ul>

						<li><a href="#">Create New Workflow</a></li>

						<li><a href="#">Review Workflow</a></li>

						<li><a href="#">Request Template</a></li>

					</ul>

				</li> -->

                

				<li><a href="#">Outside Resources</a>

<ul>
<li><a href="#">Lab</a></li>
<li><a href="#">Equipment Rental</a></li>
<li><a href="#">Contractor</a></li>
<li><a href="#">Driller</a>
<ul>

								<li><a href="#">Fred's Drilling</a></li>

								<li><a href="#">Superior drilling</a></li>

								<li><a href="#">drilling company</a></li>

							</ul>

							

						</li>

						<li><a href="#">Waste Disposal</a></li>

						<li><a href="#">Training</a></li>

						<li><a href="#">Agency</a></li>

						<li><a href="#">Add New Outside Resource</a></li>

					</ul>

				</li>

	<!--			  <li class="menu_middle">&nbsp;</li> -->

				<li><a href="#">Forms</a>

					<ul>

						<li><a href="#">Create a New Survey</a>
                        	
                          
                        
                        </li>

					  <li><a href="index.php?form_edit=1">View/Edit Existing Survey</a></li>

				  </ul>

					

	  </li>

                <!--------------------------------------------------Changed by reeta date:15/04/2013 code start here--------------->

				<!--<li><a href="#">Lookup</a></li>-->

                <li><a href="#">Documents</a>					

                    <ul>

                         <li><a href="index.php?doc_lib=1&amp;pid=<?php if(isset($pid)) { echo $pid; } ?>">Project Documents</a></li> 



						

					</ul>

				</li>

                <!--------------------------------------------------Changed by reeta date:15/04/2013 code end here--------------->

				<li class="menu_last">&nbsp;</li>

			</ul>

		</div>

	</div>

	