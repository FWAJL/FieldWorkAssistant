<?php error_reporting(1);?>

<?php 	

	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}

	    if(isset($_REQUEST['add_peo']))

	     {

	 $sql=mysql_query("INSERT INTO people SET  
		name='".$_REQUEST['fnam']."', 
	 m_phone='".$_REQUEST['phone']."', 
	 email='".$_REQUEST['e_mail']."'")
	 or die(mysql_error());

	  echo "<meta http-equiv='refresh' content='0;url=index.php?ppl=1'>";

    exit;

	}
	
?>

<!-- Form Validation     -->




<form name="edit_people" method="post" action="" >     
        
         <table width="50%" style="line-height: 40px">

         	<tr>

         		<td id="doc_lib"><label for "fnam">Name:</label></td>

         		<td >

         			<input type="text" name="fnam" id="name" class="edit_com" />

         		</td>

         	</tr>


         	<tr>

         		<td id="doc_lib"><label for "phone">Cell Number:</label></td>

         		<td><input type="text" name="phone" id="m_phone" class="edit_com" maxlength="12" value=""></td>

                <td></td>

               
         	</tr>
            
         	<tr>

         		<td id="doc_lib"><label for "e_mail">Email Address:</label></td>

         		<td><input type="text" name="e_mail" id="email" class="edit_com"></td>

         	</tr>
            
              <tr>
              
</tr>
         	<tr>

         <td colspan="2" align="right" style="padding-right: 372px"><input type="submit"   name="add_peo" id="add_peo" value="Add Field Personnel" />

                </td>


         	</tr>



         </table>
     
     
     </form>
     





