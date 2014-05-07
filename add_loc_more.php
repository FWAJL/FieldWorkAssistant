<?php



	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}

include('config.php');



if(isset($_POST['submit']))

{

 

$target_path = "uploadfiles/";



$target_path = $target_path . basename( $_FILES['own_img']['name']); 

$r_img=$_FILES['own_img']['name'];

if(move_uploaded_file($_FILES['own_img']['tmp_name'], $target_path)) 

{

if (($_FILES["own_img"]["type"] == "image/jpg")|| ($_FILES["own_img"]["type"] == "image/jpeg")|| ($_FILES["own_img"]["type"] == "image/png"))

{

    

	  

	 $insert=mysql_query("insert into location_images set loc_id='".$_POST['loc_name']."' , caption='".$_POST['caption']."' , image_name='".$r_img."'");

      

	$mess="location has been Added successfully."; 

	} 

	else

	{

    $mess="please upload only image"; 

    }

}

}

?> 	 

	 

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="css/style.css" rel="stylesheet" type="text/css" />



<title>Field Worlk Assistant</title>



<script type="text/javascript" src="js/all.js"></script>



<script type="text/javascript" src="js/tinydropdown.js"></script>

<script type="text/javascript" src="js/ddaccordion.js"></script>



<script type="text/javascript">



ddaccordion.init({

	headerclass: "expandable", //Shared CSS class name of headers group that are expandable

	contentclass: "categoryitems", //Shared CSS class name of contents group

	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"

	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover

	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 

	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content

	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)

	animatedefault: false, //Should contents open by default be animated into view?

	persiststate: true, //persist state of opened contents within browser session?

	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]

	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)

	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"

	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized

		//do nothing

	},

	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed

		//do nothing

	}

})





</script>

</head>



<body>

	<!-- HEADER -->

	<?php include('header.php'); ?>

	<!-- NAV -->

	<!-- CONTENT -->

	<div id="content">

		<div class="content_wrapper">

			<div class="content_left">

				<?php include('left_menu.php'); ?>

			</div>

			<div class="content_right">

			<div class="group">

				

				  <form action="add_loc_more.php" method="POST" enctype="multipart/form-data">

				  <?php

					 if(isset($mess))

					 {

					  echo "<center><b style='color:green' >".$mess."</b></center>";

					 }

					 

				?>

			    <table  style="line-height:40px" width="50%">

			  <tr><td>Locale name:</td><td align="right">

                            

                                                          <select  name="loc_name" id="loc_name" style="width:188px; height:28px;" >

                                                           <option value="0">--Select--</option>

                                                          <?php 

							  $sql=mysql_query("SELECT * FROM location_info");

							  while($row=mysql_fetch_array($sql))

							  {

							?>	

                                                           

						                                    <option value="<?php echo $row['loc_id'];?>"><?php echo $row['loc_name'];?></option>

						              <?php } ?>                       

                                                          </select>

                                

              </td></tr>

                                                         

             

              <tr><td>Caption:</td><td align="right"><input type="text" name="caption" id="caption"/></td></tr>

              

			   

			  <tr><td>Locale picture:</td><td align="right"><input type="file" name="own_img" id="own_img"/></td></tr>

			 

			 <tr><td>  </td><td align="right"> <input type="submit" name="submit" id="submit" value="ADD" style="background:slategray; height:29px; width:80px; border-radius: 8px 8px 8px 8px; border:0px;"/></td> </tr>

			 

			

             

               </table>	

			  </form>	

			 			

			<br class="spacer" />

				</div>

				

				 

				

				

			

			 

			<br class="spacer" />

			</div>

		</div>

	</div>	

	

	

	<!-- CONTENT -->

	

	<!-- FOOTER -->

	<br style="clear:both">

	

	<div id="footer">

	<?php include('footer.php'); ?>

	</div>

	<!-- FOOTER -->

<script type="text/javascript">

var dropdown=new TINY.dropdown.init("dropdown", {id:'menu', active:'menuhover'});

</script>

</body>

</html>

