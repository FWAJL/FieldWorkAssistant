<?php
    include "includes/header.html";
?>

<div data-role="page" data-title="Field Work Assistant/Login" data-add-back-btn="true">

	<div data-role="header" data-theme='b' class = "custom_header" data-position="fixed">
		<a data-transition="flip" href="#" data-role="button" data-icon="arrow-l" data-iconpos="left" onclick="changePage('task_page.php',true);" >Back</a> 
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
          	<?php

$rid=5;

echo '
<iframe src="https://docs.google.com/forms/d/1AiaZ5tVAKokBDfWoN2RfTkpUVlLYgl7Jad3-gbcCNsg/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
';

?>
         </div>
            

    </div><!-- /content -->

	<div data-role="footer" class="footer">
		
	</div><!-- /footer -->

</div><!-- /page -->

</body>
</html>