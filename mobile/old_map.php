<?php
    include "includes/header.html";
?>

<div data-role="page" data-title="Field Work Assistant/Login" data-add-back-btn="true">

	<div data-role="header" data-theme='b' class = "custom_header" data-position="fixed">
		<a data-transition="flip" href="#" data-role="button" data-icon="arrow-l" data-iconpos="left" onclick="changePage('task_page.php',true);" >Back</a> 
	    <h1 id="custom_title">Tempe Doggie Dispensers &gt; Inspect Dispensers</h1>
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
				<div class="ui-block-a" id="user_lbl">
					<label for="text" id="lbl_uname">Name: </label>
				</div>
				<div class="ui-block-b" id="user">
					<label for="text" id="uname_text"> Tyrone </label>
				</div>
			</fieldset>
			<fieldset class="ui-grid-a">
				<div class="ui-block-a" id="date_block">
					<label for="text" id="lbl_date">Date: </label>
				</div>
				<div class="ui-block-b" id="date_txt_block">
					<label for="text" id="txt_date"> <?php echo date("l, F d, Y" ,time());  ?></label>
				</div>
			</fieldset>
		</div>
		<div class="btn_grid">
			<a href="#" data-role="button" style="margin-left:5px; margin-right:5px"  data-iconpos="right" onclick="changePage('find_yourself.php',false);" >Where am I?<img style="float: right; margin-right: -25px" src="images/next.png"></a>
			<fieldset class="ui-grid-a">
				<div class="ui-block-a" id="btn_01">
					<a href="#" data-role="button" data-iconpos="right" onclick="changePage('facilities_map.php',false);" >Facility Map</a>
				</div>
				<div class="ui-block-b" id="btn_02">
					<a href="#" data-role="button" data-iconpos="right" onclick="changePage('locations_map.php',false);">Location Map</a>
				</div>
			</fieldset>
			<fieldset class="ui-grid-a">
				<div class="ui-block-a" id="btn_03">
					<a href="#" data-role="button" data-iconpos="right" onclick="changePage('facilities.php',false);">Facility List</a>
				</div>
				<div class="ui-block-b" id="btn_04">
					<a href="#" data-role="button" data-iconpos="right" onclick="changePage('locations.php',false);">Location List</a>
				</div>
			</fieldset>
			<!--
			<fieldset class="ui-grid-a">
			<div class="ui-block-a" id="btn_05"><a href="#" data-role="button" data-iconpos="right" onclick="changePage('#',false);" >Mark Facility</a></div>
			<div class="ui-block-b" id="btn_06"><a href="#" data-role="button" data-iconpos="right" onclick="changePage('#',false);">Mark Location</a></div>
			</fieldset>
			-->
		</div>
	</div><!-- /content -->

	<div data-role="footer" class="footer">
		
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>