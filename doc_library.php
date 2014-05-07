<?php 

 	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}

	 $count_projectfiles=0;

	 $count=0;

?>	



<script type="text/javascript">

	function delete_project(x)

	{

		var con=confirm("Are you sure?");

		if(con==1)

		{

			var filePath=x;

			var fileLength=filePath.length;

			var project_id=filePath.lastIndexOf("project_files");

			project_id=project_id+14;

			//alert(project_id);

			var fileName=filePath.lastIndexOf("/");

			lastIndex=fileName-project_id;

			var project_id1=filePath.substr(project_id,lastIndex);

			fileName=fileName+1;

			fileName1=filePath.substr(fileName,fileLength);

			document.getElementById('text1').innerHTML += "<input type='hidden' name='del_file' value='"+x+"' /><br /><input type='hidden' name='project_id1' value='"+project_id1+"' /><br /><input type='hidden' name='del_file1' value='"+fileName1+"' />";

	    }

 	}

	

	function delete_permit(x)

	{

		var con=confirm("Are you sure?");

		if(con==1)

		{

			var filePath=x;

			var fileLength=filePath.length;

			var project_id=filePath.lastIndexOf("project_files");

			project_id=project_id+26;

			//alert(project_id);

			var fileName=filePath.lastIndexOf("/");

			lastIndex=fileName-project_id;

			//alert(fileName);

			var project_id1=filePath.substr(project_id,lastIndex);

			 //alert(project_id1);



			fileName=fileName+1;

			fileName1=filePath.substr(fileName,fileLength);

		

			//alert(fileName1);

			document.getElementById('text2').innerHTML += "<input type='hidden' name='del_permitFile' value='"+x+"' /><br /><input type='hidden' name='project_id1' value='"+project_id1+"' /><br /><input type='hidden' name='del_file1' value='"+fileName1+"' />";

			document.delete_files.submit();

		}

	}

</script>

<?php 



	

	if(isset($_REQUEST['pid']))

	{

		$sql3=mysql_query("SELECT * FROM  project_info WHERE project_id='".$_REQUEST['pid']."'");

		$row3=mysql_fetch_array($sql3);

?>			  

		<h2 id="com_name">

        

        

        <a href="index.php?show_company=1&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $cid_encode; } ?>" ><?php if(isset($row1['company_nam'])) { echo $row1['company_nam']."&nbsp; > &nbsp;"; } ?></a>

        

        

        <a href="index.php?pro_update=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?>" ><?php if(isset($row3['project_name'])) { echo $row3['project_name']."&nbsp; >"; } ?></a>

        

        

        

        <a href="index.php?doc_lib=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; } ?>&amp;cid=<?php if(isset($_REQUEST['cid'])) { echo $_REQUEST['cid']; }?>"><?php echo "&nbsp Documents";  ?></a>

        

        

        </h2>

		<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>

		

<?php		

	  $counter=0;	

	  $select_proj_id=mysql_query("SELECT project_id FROM company_to_project WHERE project_id='".$_REQUEST['pid']."'");	

      while($get_proj_id=mysql_fetch_assoc($select_proj_id))

	  {

	  	$proj_id[$counter]=$get_proj_id['project_id'];

		//print_r($proj_id[$counter]);

		$counter++;

	  }

	  if(isset($proj_id))

	  {

	  	 if($proj_id!='')

		  {

?>

		 <form name="delete_files" id="delete_files" action="">

		 	<div id="text1"></div>

			<div id="text2"></div>

		 	<table width="100%" class="project_line">

		  	<tr>

				<td id="doc_lib" width="15%">Project Name</td> <td id="doc_lib" width="33%">Permit Document</td><td id="doc_lib" width="33%">Project Document</td>

			</tr>

<?php

			for($i=0; $i<$counter; $i++)

			{   

				$select_document_list=mysql_query("SELECT * FROM project_info WHERE project_id='".$proj_id[$i]."'");

				$get_document_list[$i]=mysql_fetch_assoc($select_document_list);

?>

				<tr>

				   <td id="doc_lib1" style="width:50px;"><?php if(isset($get_document_list)) { echo $get_document_list[$i]['project_name']; } ?></td>

				   <td id="doc_lib1">

				   	 <table width="100%" style="position:relative; top:8px;">

				   	 	<tr>

				   	 		<td align="left" width="45%"  id="doc_lib1" style="margin-right: 15px"><?php if(isset($get_document_list)) {  if($get_document_list[$i]['permit_doc']!='') { ?> <a href="uploadfiles/<?php echo $get_document_list[$i]['permit_doc'];?>"><?php echo "<span style='color:#3333BB'>".$get_document_list[$i]['permit_doc']."</span></a>";?><?php } else { echo "<span  id='doc_lib1'>No Document</span>";} }  ?></td>

				   	 		<td align="right" width="21%"  id="doc_lib1" style="padding-right:60px;">

				   	 		<?php if($get_document_list[$i]['permit_doc']!='')

								  {

							?>		<button onclick="delete_permit(this.value);" style="width: 49px" value="uploadfiles/permit_files/<?php echo $get_document_list[$i]['project_id']."/".$get_document_list[$i]['permit_doc'];?>">Delete</button>

				   	 	    <?php }

							?>

							</td>

				   	 	</tr>

				   	</table>

				   </td>

					<td>

						<table width="100%" style="position:relative; top:4px;">

<?php                         $select_projectfiles=mysql_query("SELECT project_document FROM project_documents WHERE project_id='".$proj_id[$i]."'");

							  while($get_projectfiles=mysql_fetch_array($select_projectfiles)) 

							  {

							  	if($get_projectfiles['project_document']!='')

								{

?>									<tr>

								    	<td id="doc_lib1">

								    		<a href="uploadfiles/project_files/<?php echo $proj_id[$i]."/".$get_projectfiles['project_document'];?>"><?php echo $get_projectfiles['project_document']."</a>&nbsp;";?>

								    	</td>

											<td align="right"  id="doc_lib1" style="padding-right: 20px"><button style="width: 49px" onclick="delete_project(this.value);" value="uploadfiles/project_files/<?php echo $proj_id[$i]."/".$get_projectfiles['project_document'];?>">Delete</button></td>

											<!-- <input type="text" name="delete_file" id="delete_file" value="uploadfiles/project_files/<?php echo $proj_id[$i]."/".$get_projectfiles['project_document'];?>"> --> 

										</tr>

										

<?php							 $count++; 

								}

								

							  }

							  

							  if($count==0)

							  {

							  	 

								 	echo "<span  id='doc_lib1'>No Document</span>";

								 

							  }

							

							  $count=0;

?>								

					    	<input type="hidden" name="cid" id="cid" value="<?php if(isset($cid_encode)) { echo $cid_encode; } ?>" />

							<input type="hidden" name="fid" id="fid" value="<?php if(isset($fid_encode)) { echo $fid_encode; } ?>" />

							<input type="hidden" name="pid" id="pid" value="<?php if(isset($pid_encode)) { echo $pid_encode; } ?>" />

							<input type="hidden" name="doc_lib" id="doc_lib" value="1" />		

					    	

					    </table>

					</td>

				</tr>	

			

				

<?php

			}

?>

		  </table>

		  </form>

<?php

			

		  }

	  }

	  else

	  {

?>	  	

			<p style="text-align: center; color: #002AB2">No Documents</p>

<?php			

	  }

	}

?>