<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<?php 

session_start();

error_reporting(1);

include('config.php');

if(isset($_REQUEST['logout']))

{

session_destroy();

echo "<meta http-equiv='refresh' content='0;url=login.php'>";

}

if(isset($_REQUEST['submit']))

{

$STH_pm_log = $DBH->prepare("SELECT * FROM project_managers WHERE username='".$_REQUEST['username']."' AND password='".$_REQUEST['password']."'");
$STH_pm_log->execute();
$STH_pm_log->setFetchMode(PDO::FETCH_ASSOC);  
$row_pm_log = $STH_pm_log->fetch();
$rows__pm__log_affected = $STH_pm_log->rowCount();


 	if($rows__pm__log_affected>0)

 	{

 		$user=$row_pm_log['pm_id'];

 		$_SESSION['pm']=$user;

		if(isset($_SESSION['pm']))

		{

			echo "<meta http-equiv='refresh' content='0;url=index.php'>";

		}

 	 }  

 	 else

 	 {

   		$mess="<span style='color:red'>Invalid Username or Password</span>";

 	 }

}

if(!isset($_SESSION['pm']))

{

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="css/style.css" rel="stylesheet" type="text/css" />

<title>Field Work Assistant</title>


<script type="text/javascript" src="js/all.js"></script>

<script type="text/javascript" src="js/tinydropdown.js"></script>

<script type="text/javascript" src="js/ddaccordion.js"></script>

<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>

<!-- Drop Down JS -->

<script type="text/javascript" src="js/drop_down.js"></script>

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

				<li><a href=""></a>

					<ul>

						<li></li>

						<li></li>

						<li></li>

					</ul>

				</li>

				<li></li>

                <li class="menu_middle">&nbsp;</li>

				<li></li>

                

                <li>

					<ul>

						<li><a href="#"></a></li>

						<li><a href="#"></a></li>

						<li><a href="#"></a></li>

					</ul>

				</li>

                

				<li><a href=""></a>

					<ul>

						<li><a href="#"></a></li>

						<li><a href="#"></a></li>

						<li><a href="#"></a>

							

							<ul>

								<li><a href="#"></a></li>

								<li><a href="#"></a></li>

								<li><a href="#"></a></li>

							</ul>

							

						</li>

						<li><a href="#"></a></li>

						<li><a href="#"></a></li>

						<li><a href="#"></a></li>

						<li><a href="#"></a></li>

					</ul>

				</li>

				  <li class="menu_middle">&nbsp;</li>

				<li><a href=""></a>

					<ul>

						<li><a href="#"></a></li>

						<li><a href="#"></a></li>

						<li><a href="#"></a></li>

						<li><a href="#"></a></li>

					</ul>

					

				</li>

				<li><a href="#"></a></li>

				<li class="menu_last">&nbsp;</li>

			</ul>

		</div>

	</div>

 <!-- <------------------- Header ---------------------------------------------------------> 

	</head>

	<body>

		<center>

			<?php if(isset($mess)) { echo $mess; } ?>

		<form name="login" action="" method="post" >	

			<div style="margin-top: 8%; line-height: 4; border:solid 6px #013F7A; background-color:#2482DC; border-radius:25px; width: 20%; padding: 10px">

				<p align="right">Username: &nbsp; <input type="text" name="username" id="username" style="border-radius:25px;"></p>

				<p align="right">Password: &nbsp; <input type="password" name="password" id="password" style="border-radius:25px;"></p>

				<p align="right"><input type="submit" name="submit" id="submit" value="Submit"></p>

			</div>

		</form>

		</center>

	</body>

</html>

<?php

}

?>