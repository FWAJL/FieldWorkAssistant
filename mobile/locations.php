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
		<div data-role="fieldcontain" id="locations-list">
			<ul data-role="listview" data-inset="true" data-divider-theme="d">
				<li data-role="list-divider" class="divider_txt">
					<a href="#" STYLE="text-decoration:none; color:black;">Rio Salado Park</a>
				</li>
				<li>
					<fieldset data-role="controlgroup">
						<input type="radio" name="radio-1" id="radio-a">
						<label for="radio-a">Mill/Rio Salado</label>
						<input type="radio" name="radio-1" id="radio-b">
						<label for="radio-b">RSP1</label>
						<input type="radio" name="radio-1" id="radio-c">
						<label for="radio-c">RSP2</label>
					</fieldset>
					<input type="text" name="new_facility" id="new_facility" value="" placeholder="Enter new Location to add..." />
					<h3><a class="add_facility" href="javascript:;">[ADD]</a></h3>
				</li>
				<li data-role="list-divider" class="divider_txt">
					<a href="#" STYLE="text-decoration:none; color:black;">Mitchel Park</a>
				</li>
				<li>
					<fieldset data-role="controlgroup">
						<input type="radio" name="radio-1" id="radio-a">
						<label for="radio-a">Dog Run</label>
						<input type="radio" name="radio-1" id="radio-b">
						<label for="radio-b">MP1</label>
					</fieldset>
					<input type="text" name="new_facility" id="new_facility" value="" placeholder="Enter new Location to add..." />
					<h3><a class="add_facility" href="javascript:;">[ADD]</a></h3>
				</li>
				<li data-role="list-divider" class="divider_txt">
					<a href="#" STYLE="text-decoration:none; color:black;">Jaycee Park</a>
				</li>
				<li>
					<fieldset data-role="controlgroup">
						<input type="radio" name="radio-1" id="radio-a">
						<label for="radio-a">Dog Run</label>
					</fieldset>
					<input type="text" name="new_facility" id="new_facility" value="" placeholder="Enter new Location to add..." />
					<h3><a class="add_facility" href="javascript:;">[ADD]</a></h3>
				</li>
				<li data-role="list-divider" class="divider_txt">
					<a href="#" STYLE="text-decoration:none; color:black;">Papago Park</a>
				</li>
				<li>
					<input type="text" name="new_facility" id="new_facility" value="" placeholder="Enter new Location to add..." />
					<h3><a class="add_facility" href="javascript:;">[ADD]</a></h3>
				</li>
			</ul>
		</div>
		<!-- end of insertion of your data -->
	</div><!-- /content -->
	<div  data-role="footer" data-position="fixed" data-theme="b">
		<div data-role="navbar" data-iconpos="top">
			<ul>
				<li >
					<a href="#page1" data-icon="grid">Location Map</a>
				</li>
				<li>
					<a href="#page2" data-icon="check">Mark Location</a>
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