<?php



	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}

	include('config.php');



	if(isset($_REQUEST['submit']))

	{

	 $sql=mysql_query("INSERT INTO project_info SET  project_name='".$_REQUEST['p_name']."', 
	 project_descr='".$_REQUEST['p_descr']."', 
	 facility_nam='".$_REQUEST['f_nam']."', 
	 facility_address='".$_REQUEST['f_address']."', 
	 facility_lat='".$_REQUEST['f_lat']."', 
	 facility_long='".$_REQUEST['f_long']."',
	 facility_contact_nam='".$_REQUEST['f_contact_nam']."',
	 facility_contact_cell='".$_REQUEST['f_contact_cell']."', 
	 facility_contact_email='".$_REQUEST['f_email']."', 
	 facility_id_num='".$_REQUEST['f_id_num']."', 
	 facility_sector='".$_REQUEST['f_sector']."', 
	 facility_sic='".$_REQUEST['f_sic']."', 
	 company_nam='".$_REQUEST['c_nam']."', 
	 company_contact_nam='".$_REQUEST['c_contact_nam']."', 
	 company_contact_cell='".$_REQUEST['c_cell']."', 
	 company_contact_email='".$_REQUEST['c_email']."', 
	 company_address='".$_REQUEST['c_address']."', 
	 company_id_num='".$_REQUEST['c_id_num']."'")
	 or die(mysql_error());

	  $lastinserted=mysql_insert_id();

	  echo "<meta http-equiv='refresh' content='0;url=index.php?pid=".$lastinserted."&amp;show_project=1'>";

    exit;

	}


?>
<style type="text/css">

	.edit_com{

			   width:186px;

			   height:30px;

			   box-shadow:0px 0px 2px 0px;

			 }

	

	</style>


<h5 style="border-bottom: 8px solid #0066CC; margin-top:5px; margin-bottom:5px; "></h5>

<br />

<br />

 <form name="add_project" action="" method="post" style='display:inline;'>

			    <table  style="line-height:50px" width="70%">

				

			<tr>

        <td id="doc_lib">Project Name: </td>

        <td align="right"><input type="text"  name="p_name" id="p_name" class="edit_com"/></td>

      </tr>

 <tr>

        <td id="doc_lib"> Project Description:</td>

         <td align="right"><input type="text"  name="p_descr" id="p_descr" class="edit_com" /></td>

      </tr>
      

    
    
<tr><td colspan="2"><h5 style="border-bottom: 8px solid #0066CC; margin-top:1px; margin-bottom:1px; "></h5></td></tr>
    
    
    <tr>
    
    

      <td colspan="2" id="doc_lib">Company and Faciility Information below.</td>

    </tr>

    <tr>

      <td id="doc_lib">Facility Name:</td>

      <td align="right"><input type="text"  name="f_nam" id="f_nam" class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility Address:</td>

      <td align="right"><input type="text"  name="f_address" id="f_address" class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility Latitude:</td>

      <td align="right"><input type="text"  name="f_lat" id="f_lat" class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility Longitude:</td>

      <td align="right"><input type="text"  name="f_long" id="f_long" class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility - Contact Name:</td>

      <td align="right"><input type="text"  name="f_contact_nam" id="f_contact_nam"  class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility - Phone (Mobile):</td>

      <td align="right"><input type="text"  name="f_contact_cell" id="f_contact_cell" class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility Email:</td>

      <td align="right"><input type="text"  name="f_email" id="f_email" class="edit_com" /></td>

    </tr>
    
     <tr>

      <td id="doc_lib">Facility ID Number:</td>

      <td align="right"><input type="text"  name="f_id_num" id="f_id_num" class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility - Sector:</td>

      <td align="right"><input type="text"  name="f_sector" id="f_sector" class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib">Facility - SIC Code:</td>

      <td align="right"><input type="text"  name="f_sic" id="f_sic" class="edit_com" /></td>

    </tr>

    <tr>

      <td id="doc_lib">Company Name:</td>

      <td align="right"><input type="text"  name="c_nam" id="c_nam" class="edit_com" /></td>

    </tr>
    
        <tr>

      <td id="doc_lib">Company - Contanct Name:</td>

      <td align="right"><input type="text"  name="c_contact_nam" id="c_contact_nam" class="edit_com"/></td>

    </tr>
    
        <tr>

      <td id="doc_lib">Company - Phone (Mobile):</td>

      <td align="right"><input type="text"  name="c_cell" id="c_cell" class="edit_com" /></td>

    </tr>
    
        <tr>

      <td id="doc_lib">Company Email:</td>

      <td align="right"><input type="text"  name="c_email" id="c_email" class="edit_com" /></td>

    </tr>
    
        <tr>

      <td id="doc_lib">Company Address:</td>

      <td align="right"><input type="text"  name="c_address" id="c_address" class="edit_com" /></td>

    </tr>
    
        <tr>

      <td id="doc_lib">Company ID Number:</td>

      <td align="right"><input type="text"  name="c_id_num" id="c_id_num" class="edit_com" /></td>

    </tr>

			  <tr> <td colspan="2" align="right">

			  	<input type="submit" name="submit" id="submit" value="Add Project" />

			  	 </td><td></td></tr>

               </table>	

			  </form>	

