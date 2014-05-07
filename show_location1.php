<?php

	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}

	include('config.php');

	if(isset($lid))

	{


 ?>

<script type="text/javascript" src="js/pop.js"></script>

<style type="text/css">

   

      div#container {

        width: 580px;

		height:200px;

        margin: 10px auto 0 auto;

        padding: 20px;

        background:green;

        border: 1px solid #1a1a1a;

      }

        #popBox {

		position: absolute;

		z-index: 2;

		background: #cccccc;

		width: 600px;

		padding: 0.3em;

		border: 1px solid gray;

	}

span.dropt:hover {text-decoration: none; background: #ffffff; z-index: 6; }

span.dropt span {position: absolute; left: -9999px;

  margin: 20px 0 0 0px; padding: 3px 3px 3px 3px;

  border-style:solid; border-color:black; border-width:1px; z-index: 6;}

span.dropt:hover span {left: 2%; background: #ffffff;} 

span.dropt span {position: absolute; left: -9999px;

  margin: 4px 0 0 0px; padding: 3px 3px 3px 3px; 

  border-style:solid; border-color:black; border-width:1px;}

span.dropt:hover span {margin: 20px 0 0 300px; background: #ffffff; z-index:6;} 

      

    </style>

    <script type="text/javascript" src="pop.js"></script>

    <script type="text/javascript">

    
    function showBox(text, obj, e) {

				    if(text.length>140)

				    {

					obj.onmouseout = hideBox;

					obj.onmousemove = moveBox;

					node = document.createElement('div');

					node.style.left = e.layerX + 'px';

					node.style.top = e.layerY + 'px';

					node.id = 'popBox';

					node.innerHTML = text;

					obj.appendChild(node);

					}

			}

function moveBox(e) {

	node = document.getElementById('popBox');

	node.style.left = e.layerX + 'px';

	node.style.top = e.layerY + 'px';

}

function hideBox() {

	node = document.getElementById('popBox');

	node.parentNode.removeChild(node);

}

    </script>

	

	<!-- CONTENT -->			

		 

			 

 <?php

 if(isset($_REQUEST['lid']))

  {

  	    if(isset($_REQUEST['lid']))

		{     

			$sql=mysql_query("SELECT * FROM location_info WHERE loc_id='".$lid."'");

			$count_location=mysql_num_rows($sql);

			if($count_location<1)

			{

				echo "<meta http-equiv='refresh' content='0;url=login.php?logout'>";

			}

			$row=mysql_fetch_array($sql);

			

		}


		if(isset($_REQUEST['pid']))

		{

			$sql4=mysql_query("SELECT * FROM project_info WHERE project_id='".$pid."'");

			$row4=mysql_fetch_array($sql4);

		}


  ?>
 <h2 id="com_name">
        
        <a href="index.php?show_project=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid; }?>" > 

  <?php if(isset($row4['project_name'])) { echo $row4['project_name']."&nbsp; > &nbsp;"; } ?></a>
        
        <?php echo $row['loc_name']." &nbsp;- &nbsp;"; ?> 

        

        <a style="font-size:18px;" href="index.php?edit_location=<?php echo $row['loc_id']; ?>&amp;lid=<?php if(isset($_REQUEST['lid'])) { echo $lid; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid; } ?>">Edit</a>
        
        </h2>
 <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>

        <div class="group">

			<h3  id="doc_lib">Location Description</h3>


      		  <span class="dropt" style="color: #333399;font-size:18px"><?php echo substr($row['loc_desc'],0,250);?>

  			  <span style="width:900px;"><?php echo $row['loc_desc'];?></span>

			  </span>

				<br class="spacer" />

		</div>

          <div class="group">

		 		 <h3  id="doc_lib">Location Image(s)</h3>

<?php 	

				$select_image_name=mysql_query("SELECT * FROM location_images WHERE loc_id='".$lid."'");

				while($get_image_name=mysql_fetch_assoc($select_image_name))

				{

					$get_name=$get_image_name['image_document'];

				}

					$sql="SELECT * FROM location_info WHERE loc_id='".$lid."'";

					$results=  mysql_query($sql) or die(mysql_error()); 

					$re=mysql_fetch_assoc($results); 

					if(isset($get_name))

					{

						if($get_name!='')

						{		 

?>							<p> <img src="uploadfiles/location_images/<?php echo $lid; ?>/<?php echo $get_name; ?>" width="150px" height="100px" onclick="openWin('<?php echo $lid; ?>','<?php echo $get_name; ?>');" id="loc_image"/></p>

<?php					}

  		   			}



?>

                    

		</div>

		<div align="left" width="100%">

<?php 

		if(isset($get_name))

		{

			if($get_name!='')

			 { 

?>			

         		 	<a style="font-size:13px;" href="index.php?imageid=<?php echo $row['loc_id']; ?>&amp;lid=<?php if(isset($_REQUEST['lid'])) { echo $lid; } ?>&amp;pid=<?php if(isset($pid)) { echo $pid; } ?>" >See more....</a>

<?php		 } 

		} ?>         

         </div>

         <div class="group" id="headerdive">

				<table width="100%">



                    <tr width="100%">

               		    <td width="20%" style="text-align:left"><p id="com_name">Lat: </p></td><td width="80%" align="left"><h4 id="com_name1"><?php echo $row['l_lat'];?></h4></td> 

                    </tr>

                     <tr>

                 		 <td width="20%"><p id="com_name">Long:</p></td><td width="80%" align="left"><h4 id="com_name1"><?php echo $row['l_long'];?></h4></td> 

                    </tr>

					

                    

                    </table>

					

				</div>


		
 <!-- CONTENT -->

	

	<!-- FOOTER -->



<?php

	}

	else

	{

?>

	

	<!-- CONTENT -->

			<h2>Please Click on the Left Menu </h2>

			<br class="spacer" />
	<!-- CONTENT -->
	<!-- FOOTER -->
	<!-- FOOTER -->
<?php
	}
}
?>