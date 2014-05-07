<?php
include "includes/header_custom.html";
?>

<div data-role="page" data-title="Field Work Assistant/Login" data-add-back-btn="true">
	<div data-role="header" data-theme='b' class = "custom_header" data-position="fixed">
		<a data-transition="flip" href="#" data-role="button" data-icon="arrow-l" data-iconpos="left" onclick="changePage('task_page.php',true);" >Back</a>
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
	      <p>Click on one of the buttons below to get a list of	:    </p>
	      <p>* Tools needed for the job</p>
	      <p> * Links to Outside Resources you will need to contact, like rental equipment or a laboratory.</p>
	      <p>* A list of items you will need to purchase.</p>
		</div>
		
		<!-- end of insertion of your data -->
		</div><!-- /content -->
		<div  data-role="footer" data-position="fixed" data-theme="b">
			<div data-role="navbar" data-iconpos="top">
				<ul>
					<li >
						<a href="#page1" data-icon="grid">Tools</a>
					</li>
					<li><a href="#page1" data-icon="grid">Outside Resources</a></li>
					<li><a href="#page2" data-icon="grid">Purchases</a></li>
				</ul>
			</div>
			<!-- /navbar -->
		</div>
		<!-- /footer -->
	</div><!-- /page -->
	</body> </html>
