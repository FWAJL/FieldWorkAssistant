<?php
    include "includes/header.html";
?>

<div data-role="page" data-title="Field Work Assistant/Login" data-add-back-btn="true">

	<div data-role="header" data-theme='b' class = "custom_header" data-position="fixed">
		<a data-transition="flip" href="#" data-role="button" data-icon="arrow-l" data-iconpos="left" onclick="changePage('authentic_user.php',true);" >Back</a> 
	    <h1 id="custom_title">My Tasks</h1>
        <a href="#" data-role="button" data-icon="refresh" data-iconpos="right"  onclick="changePage('index.php',true);" >Logout</a>        
    	<div id="headerlogodiv">
			<img id="headerImg_next" src="images/header_mid_bg.jpg" />
			<img id="headerlogo" src="images/logo.png"/>
		</div>
    </div>
    <!-- /header -->
    
    <div data-role="content" align="center" data-theme="b" class="bg">
            <div data-role="fieldcontain" class="userifo_area ui-corner-all" align="center">
    			
    			<fieldset class="ui-grid-a">
               		<div class="ui-block-a" id="user_lbl"><label for="text" id="lbl_uname">Name: </label></div>
               		<div class="ui-block-b" id="user"><label for="text" id="uname_text"> Tyrone </label></div>
            	</fieldset>
            	
    			<fieldset class="ui-grid-a">
               		<div class="ui-block-a" id="date_block"><label for="text" id="lbl_date">Date: </label></div>
               		<div class="ui-block-b" id="date_txt_block"><label for="text" id="txt_date"> <?php echo date("l, F d, Y" ,time());  ?></label></div>
            	</fieldset>
            </div>
            
             <div id="tasks_list" align="center" >
	            <ul data-role="listview" data-theme="b" data-inset="true" id="tasks">
				    <li><a href="#" onclick="changePage('task_page.php',false);">
					        <img src="images/tasks.png" title="sample"/>
					        <h3>Tempe Doggie Dispensers > Inspect Dispensers</h3>
					        <p>Start: July 05, 2013</p><p>Deadline: August 13, 2014</p>
					    </a>
				    </li>
				    <li><a href="#" onclick="changePage('task_page.php',false);">
					        <img src="images/tasks.png" title="sample"/>
					        <h3>Task 2</h3>
		        <p>Start: July 05, 2013</p><p>Deadline: August 13, 2014</p>
					    </a>
					</li>
					
				    <li><a href="#" onclick="changePage('task_page.php',false);">
					        <img src="images/tasks.png" title="sample"/>
					        <h3>Task 3</h3>
				        <p>Start: July 05, 2013</p><p>Deadline: August 13, 2014</p>
					    </a>
					</li>
				</ul>
            </div>
	</div><!-- /content -->
        
	<div data-role="footer" class="footer">
		
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>