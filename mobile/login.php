<?php
include "includes/header.html";
?>

<div data-role="page" data-title="Field Work Assistant/Login" data-add-back-btn="true" data-position="fixed">
	<div data-role="header" data-theme='b' class = "custom_header">
		<a data-transition="flip" href="#" data-role="button" data-icon="home" data-iconpos="left" onclick="changePage('index.php',true);" >Home</a>
		<h1 id="custom_title">Login</h1>
		<div id="headerlogodiv">
			<img id="headerImg_next" src="images/header_mid_bg.jpg" />
			<img id="headerlogo" src="images/logo.png"/>
		</div>
	</div>
	<!-- /header -->
	<div data-role="content" align="center" data-theme="c" class="bg">
		<div data-role="fieldcontain" class="login_area ui-corner-all" align="center">
			<fieldset class="ui-grid-a">
				<div class="ui-block-a" id="user_lbl">
					<label for="text" id="lbl_login_uname">User Nam: </label>
				</div>
				<div class="ui-block-b" id="username">
					<input type="text" id="txt_uname" name="user_name" value="ens" />
				</div>
			</fieldset>
			<fieldset class="ui-grid-a">
				<div class="ui-block-a" id="pwd_lbl">
					<label for="text" id="lbl_pwd">Password: </label>
				</div>
				<div class="ui-block-b" id="password">
					<input type="password" id="txt_pwd" name="password" value="12345"  />
				</div>
			</fieldset>
			<fieldset class="ui-grid-b" id="submit_btn">
				<div class="ui-block-a"></div>
				<div class="ui-block-b">
					<a href="authentic_user.php" data-role="button" data-theme="b"><span id="login_text">Login</span></a>
				</div>
				<div class="ui-block-c"></div>
			</fieldset>
		</div>
	</div><!-- /content -->
	<div data-role="footer" class="footer"></div><!-- /footer -->
</div><!-- /page -->
</body> </html>