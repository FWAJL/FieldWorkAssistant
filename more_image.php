   

<?php



	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}

include('config.php');

if(isset($_REQUEST['imageid']))

{

	$imageid=$_REQUEST['imageid'];

}

if(isset($_REQUEST['del_id']))

{

	

	$del_location_images=mysql_query("DELETE FROM location_images WHERE id='".$_REQUEST['del_id']."'");



echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?upload_locationsale=1&lid='.$_REQUEST['lid'].'&pid='.$_REQUEST['pid'].'&fid='.$_REQUEST['fid'].'&cid='.$_REQUEST['cid'].'">';    

exit;	

 

// header("Location:index.php?upload_locationsale=1&lid='".$_REQUEST['lid']."'&pid='".$_REQUEST['pid']."'&fid='".$_REQUEST['fid']."'&cid='".$_REQUEST['cid']."'");

}

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

			if(isset($row['sl_type_id']))

			{

				$sl_typeid=$row['sl_type_id'];

				$locationtype=mysql_query("SELECT sl_type FROM sample_location_types WHERE sl_type_id='".$sl_typeid."'");

				$get_locationtype=mysql_fetch_assoc($locationtype);

			}

			

		}

		if(isset($_REQUEST['pid']))

		{

			$sql4=mysql_query("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");

			$row4=mysql_fetch_array($sql4);

		}

		if(isset($row['sl_type_id']))

		{

		 	$sql5=mysql_query("SELECT sl_type FROM sample_location_types WHERE sl_type_id='".$row['sl_type_id']."'");

			$row5=mysql_fetch_assoc($sql5);

			$loc_desc=substr($row['loc_desc'],0,140);

		}  

}	

?> 	 







	<!-- HEADER -->

	

	<!-- NAV -->

	<!-- CONTENT -->

	<div style="color:#0000CC">

		<h2 id="com_name" class="head_clr"></h2>

	</div>	

	<h2 id="com_name"><a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?> " ><?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?></a><a href="index.php?show_facility=1&amp;fid=<?php if(isset($_REQUEST['fid'])) { echo $fid_encode;  }?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>" ><?php if(isset($row3['facility_nam'])) { echo $row3['facility_nam']."&nbsp; >"; } ?></a><a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; }?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>"><?php if(isset($row4['project_name'])){ echo "&nbsp;".$row4['project_name']."&nbsp; > &nbsp;"; }?></a><a href=""><?php if(isset($row5['sl_type'])) { echo $row5['sl_type']."&nbsp >";  } ?> </a><a href="index.php?upload_locationsale=1&amp;lid=<?php if(isset($_REQUEST['lid'])) {  echo $lid_encode; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) {  echo $pid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>"><?php if(isset($row['loc_name'])) {  echo $row['loc_name']." &nbsp;- &nbsp;"; } ?></a> <a style="font-size:18px;" href="index.php?imageid=<?php if(isset($_REQUEST['imageid'])) { echo $_REQUEST['imageid']; } ?>&amp;lid=<?php if(isset($_REQUEST['lid'])) { echo $lid_encode; } ?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid_encode; } ?>&amp;fid=<?php if(isset($_REQUEST['fid'])) {  echo $fid_encode; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; } ?>">Images</a></h2>

	 <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>  

	     <form name="del_image" action="" method="get">

	      <table width="100%">

				   

			<?php	

			     $counter=0;

				 $sql="SELECT * FROM location_images WHERE loc_id='".$imageid."'";

				 $results=  mysql_query($sql) or die(mysql_error()); 

				 while($row=mysql_fetch_array($results))

				 { 

			       	if($counter<3)

					{

						if($counter==0)

						  {

							 if(isset($tr))

								{

									echo $tr;

								}

						  }

		    ?>	

			    							<td>

			    							<?php if($row['image_name']!='') {

			    							?>						

												<img src="uploadfiles/<?php echo $row['image_name']; ?>" style="width:200px; height:200px; margin:5px;" onclick="openWin('<?php echo $row['image_name']; ?>');"/>

												

					                            <?php echo "<br> <input type='submit' name='img' id='img' onclick='image_id(".$row['id'].");' value='Remove'>" ; ?>

											    

												<?php } ?>		

											</td>	

							  		

			<?php                           if($counter==2)

											{

												if(isset($close_tr))

												{

													echo $close_tr;

											    }

											}

								   		}

									$counter++;

									if($counter==3)

									{

										$counter=0;

										$tr="<tr>";

										$close_tr="</tr>";

									}	

									

								} 

			?>	

				<input type="hidden" name="imageid" id="imageid" value="<?php if(isset($imageid)) { echo trim($_REQUEST['imageid']); } ?>">

				<input type="hidden" name="pid" id="pid" value="<?php if(isset($_REQUEST['pid'])) { echo trim($pid_encode); } ?>">

				<input type="hidden" name="fid" id="fid" value="<?php if(isset($_REQUEST['fid'])) { echo trim($fid_encode); } ?>">

				<input type="hidden" name="cid" id="cid" value="<?php if(isset($_REQUEST['cid'])) { echo trim($cid_encode); } ?>">

				<input type="hidden" name="lid" id="lid" value="<?php if(isset($_REQUEST['lid'])) { echo trim($lid_encode); } ?>">

				<input type="hidden" name="del_id" id="del_id" value="">

               

              </table>

            </form>

                

 



	 		

		  

	

 

				

		 