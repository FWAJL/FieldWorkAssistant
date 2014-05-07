<?php 

if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}

	include('config.php');
	
	?>
   
		<table width="100%">

			<tr>

				<th align="left" style="width:250px;position:relative; top:-4px;">

				    Field Personnel	

				</th>

			</tr>
            
            <tr>

				<td align="left" width="25%" valign="top">

<?php					


                       $select_people=mysql_query("SELECT * FROM people");

						while( $get_people=mysql_fetch_assoc($select_people))

						{

					
?>							

                              <table width="100%">

								<tr>

									<td align="left" width="6%">

<input type="radio" name="people_checkbox" id="people_checkbox" value="<?php if(isset($get_people['people_id'])) { echo $get_people['people_id']; } ?>"/>

									 <input type="hidden" name="radio_people" id="radio_people" value="<?php echo $count; ?>" />

									

									</td>

									<td align="left" style="width:250px;position:relative; font-weight:bold;">

                                   

									<a  class="pagerLink" href="index.php?peo_id=<?php echo $get_people['people_id']; ?>&amp;people_edit=1" target="_top" title="Edit"><?php if(isset($get_people['name'])) { echo $get_people['name']; } ?></a>

                                        

									</td>

								</tr>

							</table>

<?php } ?>


		