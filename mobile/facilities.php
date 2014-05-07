<?php
include "includes/header_custom.html";
?>

<div data-role="page" data-title="Field Work Assistant/Login" data-add-back-btn="true">
	<div data-role="header" data-theme='b' class = "custom_header" data-position="fixed">
		<a data-transition="flip" href="#" data-role="button" data-icon="arrow-l" data-iconpos="left" onclick="changePage('map.php',true);" >Back</a>
		<h1 id="custom_title">Tempe Doggie Dispensers > Inspect Dispensers</h1>
		<a href="#" data-role="button" data-icon="refresh" data-iconpos="right"  onclick="changePage('index.php',true);" >Logout</a>
		<div id="headerlogodiv">
			<img id="headerImg_next" src="images/header_mid_bg.jpg" />
			<img id="headerlogo" src="images/logo.png"/>
		</div>
	</div>
	<!-- /header -->
	<div data-role="content" align="center" data-theme="c" class="bg">
		<!-- start inserting your data here -->
		<br />
		<br />
		<br />
		<br />
		<div data-role="fieldcontain" id="facilities-list">
			<fieldset data-role="controlgroup">
				<input type="radio" name="radio-1" id="radio-a">
				<label for="radio-a">Rio Salado Park</label>
				<input type="radio" name="radio-1" id="radio-b">
				<label for="radio-b">Mitchel Park</label>
				<input type="radio" name="radio-1" id="radio-c">
				<label for="radio-c">Jaycee Park</label>
				<input type="radio" name="radio-1" id="radio-d">
				<label for="radio-d">Papago Park</label>
			</fieldset>
			<input type="text" name="new_facility" id="new_facility" value="" placeholder="Enter new Facility to add..." />
			
			<h3><a class="add_facility" href="javascript:;">[ADD]</a></h3>
		</div>
		
		<!-- end of insertion of your data -->
		</div><!-- /content -->
		<div  data-role="footer" data-position="fixed" data-theme="b">
			<div data-role="navbar" data-iconpos="top">
				<ul>
					<li >
						<a href="#page1" data-icon="grid">Facility Map</a>
					</li>
					<li>
						<a href="#page2" data-icon="check">Mark Facilty</a>
					</li>
					<li>
						<a href="#page3" data-icon="arrow-u" class="ui-btn-active ui-state-persist">Directions</a>
					</li>
				</ul>
			</div>
			<!-- /navbar -->
		</div>
		<!-- /footer -->
	</div><!-- /page -->
	</body> </html>
