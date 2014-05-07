<?php
    include "includes/header.html";
?>

<div data-role="page" data-title="Field Work Assistant/Login" data-add-back-btn="true">

	<div data-role="header" data-theme='b' class = "custom_header" data-position="fixed">
		<a data-transition="flip" href="#" data-role="button" data-icon="arrow-l" data-iconpos="left" onclick="changePage('map.php',true);" >Back</a> 
	    <h1 id="custom_title">Tempe Doggie Dispensers > Inspect Dispensers Map</h1>
        <a href="#" data-role="button" data-icon="refresh" data-iconpos="right"  onclick="changePage('index.php',true);" >Logout</a>        
		<div id="headerlogodiv">
    		<img id="headerImg_next" src="images/header_mid_bg.jpg" />
            <img id="headerlogo" src="images/logo.png"/>
    	</div>
    </div>
    <!-- /header -->
    
	 <div data-role="content" align="center" data-theme="b" class="bg">
         <div class="construction">
          	<img src="images/facility_map_mobile.JPG" width="100%" style="margin-top: 55px;" />
         </div>
            
         <ul data-role="listview" data-theme="b" data-inset="true" id="map_task_list">
		    <li><a href="#">Mark Current Location</a></li>

		</ul>
    </div><!-- /content -->

	<div data-role="footer" class="footer">
		
	</div><!-- /footer -->

</div><!-- /page -->

</body>
</html>