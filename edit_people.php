<?php

	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}

	include('config.php');
 

	?>	

 
 <?php
 
 if(isset($_REQUEST['submit']))

{
		

 $s=mysql_query("UPDATE people SET 
	name='".$_REQUEST['peo_name']."', 
	m_phone='".$_REQUEST['Phonemob']."', 
	email='".$_REQUEST['email']."'
	WHERE people_id='".$_REQUEST['peo_id']."'")
	or die(mysql_error());


	echo "<meta http-equiv='refresh' content='0;url=index.php?show_people=1&amp;peo_id=".$_REQUEST['peo_id']."'>";

    exit; 		
		
}
 
 
 ?>
 
 
  <?php
 
 if(isset($_REQUEST['delete']))

{
		
  $del=mysql_query("DELETE FROM people 
   WHERE people_id='".$_REQUEST['peo_id']."'")
    or die(mysql_error());


	echo "<meta http-equiv='refresh' content='0;url=index.php?ppl=1'>";

    exit; 		
		
}
 
 
 ?>
 

	<!-- CONTENT -->

     <link href="css/style.css" rel="stylesheet" type="text/css" />	

 		<?php

			  $sql=mysql_query("SELECT * FROM people WHERE people_id='".$_REQUEST['peo_id']."'");

			  $row=mysql_fetch_assoc($sql);

			 ?>	

                 <h2 id="com_name"><a href="#" ><?php echo $row['name']; ?></a></h2>

			      <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5> 

              <form name="people_data" action="" method="post" style='display:inline;'>

			    <table  style="line-height:50px" width="70%">

			<tr><td id="doc_lib">Field Personnel: </td><td align="right"><input type="text"  name="peo_name" id="peo_name" value="<?php echo $row['name'];?>" class="edit_com"/></td><td></td> </tr>

            <tr><td id="doc_lib">Cell Number:</td><td align="right"><input type="text" maxlength="12"  name="Phonemob" id="Phonemob"  

            value="<?php if(isset($row['m_phone'])){ if($row['m_phone']=='0'){echo '';}else{echo $row['m_phone'];}} ?>" class="edit_com"  /></td><td style="font-size:12px; padding-left:3px;">Hint:(xxx-xxx-xxxx)</td></tr>

            <tr><td id="doc_lib">Email Address:</td><td align="right"><input type="text"  name="email" id="email" 

            value="<?php if(isset($row['email'])){ if($row['email']=='0'){echo '';}else{echo $row['email'];}} ?>" class="edit_com"/></td><td></td></tr>
            
              <tr><td align="right"></td><td></td></tr>

			  <tr> <td colspan="2" align="right">

			  	<input type="submit" name="submit" id="submit" value="Update" />
                </f

			  	 ></td><td></td></tr>
                 
                  <tr> <td colspan="2" align="right">


			  	<input type="submit" name="delete" id="delete" value="Delete" onclick="return confirm('Are you sure want to delete this Field Technician?');"/>

			  	 </td><td></td></tr>

               </table>	

			  </form>	

			<br class="spacer" />

		<!-- CONTENT -->

	

	<!-- FOOTER -->

