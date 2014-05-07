<?php
    include "includes/header.html";
?>

<div data-role="page" data-title="Field Work Assistant/Login" data-add-back-btn="true">

	<div data-role="header" data-theme='b' class = "custom_header" data-position="fixed">
		<a data-transition="flip" href="#" data-role="button" data-icon="arrow-l" data-iconpos="left" onclick="changePage('tasks_list.php',true);" >Back</a> 
	    <h1 id="custom_title">Tempe Doggie Dispensers > Inspect Dispensers</h1>
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
            
             <div id="auth_btns" align="center" >

<!--
1) If there is only one form, go straight to form.php
2) php generated list of forms.
  -->
             
	            <a href="form.php?form_id=1" data-role="button" data-iconpos="right" onclick="changePage('#',false);" >Form 1<img style="float: right; margin-right: -25px" src="images/next.png"></a>
	            <a href="form.php" data-role="button" data-iconpos="right" onclick="changePage('map.php',false);">Form 2<img style="float: right; margin-right: -25px" src="images/next.png"></a>
                <a href="form.php" data-role="button" data-iconpos="right" onclick="changePage('location_list.php',false);" >Form 3<img style="float: right; margin-right: -25px" src="images/next.png"></a>
	            <a href="form.php" data-role="button" data-iconpos="right" onclick="changePage('form.php',false);" >Water Levels<img style="float: right; margin-right: -25px" src="images/next.png"></a>
	            <a href="form.php" data-role="button" data-iconpos="right" onclick="changePage('#',false);">Groundwater Samples<img style="float: right; margin-right: -25px" src="images/next.png"></a>
            </div>
	</div><!-- /content -->

            
        </div><!-- /content -->

	<div data-role="footer" class="footer">
		
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>