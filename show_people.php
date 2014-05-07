<?php

	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}

	include('config.php');


		if(isset($_REQUEST['peo_id']))

		{

			$peo_id=$_REQUEST['peo_id'];

           $peopleId=base64_decode($peo_id);

		  	  if(isset($_REQUEST['submit']))

	     {

 $select_name=mysql_query("SELECT COUNT(name) FROM people WHERE name='".$_REQUEST['peo_name']."' and is_status='0' and people_id <> '".$peopleId."'");

         $row_name_val=mysql_fetch_assoc($select_name);

	    $name=$row_name_val['COUNT(name)'];



 $select_m_phone=mysql_query("SELECT COUNT(m_phone) FROM people WHERE m_phone='".$_REQUEST['Phonemob']."' and is_status='0' and people_id <> '".$peopleId."'");

	    $row_m_phone=mysql_fetch_assoc($select_m_phone);

	     $phone= $row_m_phone['COUNT(m_phone)'];

	

	     $select_email=mysql_query("SELECT COUNT(email) FROM people WHERE email='".$_REQUEST['email']."' and  is_status='0' and people_id <> '".$peopleId."'");

	     $row_email=mysql_fetch_assoc($select_email);

	      $email= $row_email['COUNT(email)'];

		

		if($name!='0' || $phone!='0' || $email!='0')

		{?>

			<meta http-equiv='refresh' content='0;url=index.php?editPeople=<?php if(isset($_REQUEST['peo_id'])) { echo $_REQUEST['peo_id']; } ?>&amp;peo_id=<?php if(isset($_REQUEST['peo_id'])) { echo $_REQUEST['peo_id']; } ?>'>

   	        

            <?php exit;

			

			}

			else

			{

				if($_REQUEST['Phonemob']=='' and $_REQUEST['email']=='')

				{

				$insert_people=mysql_query("UPDATE  people SET name='".trim($_REQUEST['peo_name'])."',m_phone='0',email='0' WHERE people_id='".base64_decode($_REQUEST['peo_id'])."'");

				}

				else if($_REQUEST['Phonemob']=='')

				{

$insert_people=mysql_query("UPDATE  people SET name='".trim($_REQUEST['peo_name'])."',m_phone='0',email='".trim($_REQUEST['email'])."' WHERE people_id='".base64_decode($_REQUEST['peo_id'])."'");

				}

				else if($_REQUEST['email']=='')

				{

	$insert_people=mysql_query("UPDATE  people SET name='".trim($_REQUEST['peo_name'])."',m_phone='".trim($_REQUEST['Phonemob'])."',email='0' WHERE people_id='".base64_decode($_REQUEST['peo_id'])."'");

					}

					else

			      {

					 $s=mysql_query("UPDATE people SET  name='".$_REQUEST['peo_name']."',m_phone='".$_REQUEST['Phonemob']."', email='".$_REQUEST['email']."' WHERE people_id='".base64_decode($_REQUEST['peo_id'])."'") or die(mysql_error());

					  }

			

			 echo "<meta http-equiv='refresh' content='0;url=index.php?people=1'>";

                    exit; 

					  }

				

	}

		



			$sql="SELECT * FROM  people WHERE people_id='".$peopleId."'";

			$results=  mysql_query($sql) or die(mysql_error()); 

			

			$row=mysql_fetch_array($results);

			if(isset($row))

			{ 

?>

			

		<h2 id="com_name" class="head_clr"><a href="#"><?php echo $row['name']."&nbsp; -"; ?></a> <a style="font-size:18px;" href="index.php?editPeople=<?php if(isset($_REQUEST['peo_id'])) { echo $_REQUEST['peo_id']; } ?>&amp;peo_id=<?php if(isset($_REQUEST['peo_id'])) { echo $_REQUEST['peo_id']; } ?>">Edit</a></h2>

         <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>         

				<div class="group" id="headerdive">

               

				    

					<table width="100%">

                    <tr>

                       <td width="30%"><p id="com_name">Field Personnel :</p></td>

                       <td width="70%">

				 		  <h4 id="com_name1"><?php echo $row['name'];?></h4>

                        </td>

                       </tr>

                    </table>

                     

					<br class="spacer" />

                    

				</div>

                <div class="group" id="headerdive">

				  		

					<table width="100%">

                    <tr>

                  		<td width="30%"><p id="com_name">Cell Number: </p></td>

					    <td width="70%">

				 		  <h4 id="com_name1"><?php if(isset($row['m_phone'])){ if($row['m_phone']=='0'){echo '';}else{echo $row['m_phone'];}} ?></h4>

                        </td>

                        

                       

                    </tr>

                    <tr>

                       <td width="30%"><p id="com_name">Email Address:</p></td>

                       <td width="70%">      

				 		  <h4 id="com_name1"><?php if(isset($row['email'])){ if($row['email']=='0'){echo '';}else{echo $row['email'];}} ?></h4>

                       </td>

                     </tr>

                    </table>

                  	</div>

				

			<?php

			}

		}

			?>

			

			

		

	<!-- CONTENT -->

	

	<!-- FOOTER -->





