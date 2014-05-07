
<script type="text/javascript">

$(document).ready(function() {



var msg='<?php echo $_REQUEST['check']; ?>';

if(!msg=='')

{

alert("This company has associated with projects, so please first delete the projects.");

}

});

</script>


<?php

	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}
	
		include('config.php');
		
						$proj_id=$_REQUEST['pid'];
		$prjid=$proj_id;
				
				
			$query1 = mysql_query("SELECT *
FROM location_info, location_to_project
WHERE location_info.loc_id = location_to_project.loc_id AND location_to_project.project_id='".$_REQUEST['pid']."' AND location_info.loc_group='".$_REQUEST['loc_grp']."'");

        $x=mysql_num_rows($query1);
		

if(isset($_REQUEST['submit_all']))

 	{

$limit=$x;

 	} else {


if(isset($_REQUEST['perpage']))

 	{

$limit=$_REQUEST['perpage'];

 	} else {
		
		$limit=$x;
		
		
		}
	}

	  $page=1;

		if(isset($_REQUEST['page']))

		{

		   $page=$_REQUEST['page'];

		   if($page==0)

		   {

		      $page=1;

		   }

		}

        $startpoint = ($page * $limit) - $limit;

		 $prj=mysql_query("select loc_id from location_info  LIMIT {$startpoint} , {$limit} ");
		 
		 
		 
		 
		 if(isset($_REQUEST['save'])) 
{
  
  if(isset($_REQUEST['cbox'])) 
	{ 

foreach($_REQUEST['id'] as $key => $id) 

		{

      if(isset($_REQUEST['cbox'][$key])) 
			{
         $checked[] = $id;
      		} else {
         $unchecked[] = $id;
			        }
		
		}
   mysql_query("UPDATE location_info SET active_bool=1 WHERE loc_id IN (".implode(',', $checked).")"); 
   mysql_query("UPDATE location_info SET active_bool=0 WHERE loc_id IN (".implode(',', $unchecked).")"); 
  
	} else {
	
	if(!isset($_REQUEST['cbox'])) 
	{ 

foreach($_REQUEST['id'] as $key => $id) 

		{

         $unchecked[] = $id;
			        }
		
		} 
   mysql_query("UPDATE location_info SET active_bool=0 WHERE loc_id IN (".implode(',', $unchecked).")"); 
  
	}


}


 if(isset($_REQUEST['vis']))

 {

 	$var=$_REQUEST['visible'];

 	$var2=-1;

 	$var1=$var*$var2;

 	$r=mysql_query("UPDATE location_info SET visible='".$var1."' WHERE loc_id='".$_REQUEST['id']."'");

 }
	
?>


<link href="css/pagination.css" rel="stylesheet" type="text/css" />

	<link href="css/grey.css" rel="stylesheet" type="text/css" />

	<link href="paging.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript">

			function checkAll()
			
			{

		for (var i=0;i<document.loc_frm.elements.length;i++)

		{

			var e=document.loc_frm.elements[i];

			if ((e.name != 'allbox') && (e.type=='checkbox'))

			{

			e.checked=document.loc_frm.allbox.checked;

			}

		}

	  }

	</script>
    
     <?php

	 if(isset($_REQUEST['pid']))

	 {

	      $sqlpro=mysql_query("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");

		  $rowpro=mysql_fetch_array($sqlpro);

	 }
 

?>    
    

<?php

	 if(isset($mess))

	 {

  		  echo "<center><b style='color:#FFFFFF' >".$mess."</b></center>";

	 }
	 
	 ?>
     
<form name="loc_frm" id="loc_frm" action="#" style="width: 30px;">

<input type="hidden" name="perpage" value="<?php echo $limit ?>" />
<input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>">
<input type="hidden" name="pid" value="<?php echo $prjid ?>" />
<input type="hidden" name="loc_grp" value="<?php echo $_REQUEST['loc_grp']; ?>" />		
             
<?php if(isset($_REQUEST['page'])) { ?>

	

				 <?php

				 }

				 ?>

 <table>
 
 <tr>
   

    <td>
                 
                     <div style="width:400px; border-left: 100px;" align="left">
              

				   			 <h2 id="com_name">
        
        <a href="index.php?show_project=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid; }?>" > 

  <?php if(isset($rowpro['project_name'])) { echo $rowpro['project_name'].""; } ?></a>
               
</h2> 

</div>

	  </td>
                 
                 <td></td>
                 <td></td>
                 <td></td>
  </tr>
  
  </table>


  <table width="100%">
                
               
                 
               <tr height="10">
  <td colspan="4" width="100%"></td>
  </tr>
  
 
<!--   New row  -->

<tr>
    <td>
    
    <div style="width:50px;">
              
 

</div>
    
      </td>

				 <td>
                 
                 <div style="width:400px;">
              

				   			 <h2 id="com_name" style="border-left:30px"> Location
     
               
</h2> 

</div>
                 
                 
      </td>
                    
    <td>
                 
                 <div style="width:300px;">
              

				   			 <h2 id="com_name"> Group
     
               
</h2> 

</div>
                 
                 
      </td>    
                 
    <td> 
       

				       <div style="width:200px;"><h3 style="color:#0099FF;">&nbsp;</h3>
                       
                       </div>

          <div style="margin-left:10px;"></div>

      </td>

    </tr>
                 
               

 <tr>

    <td width="100%" colspan="4">

				   <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>

      </td>

  </tr>  
  
  </table>
<table>
 
 <thead>	
 <tr> 
                 <th id="checkHeader"><div style="width:50px;"></div></th>   
                 <th id="project_Header"><div style="width:400px;"></div></th>    
                 <th id="group_Header"><div style="width:300px;"></div></th>    
                 <th id="hide_Header"><div style="width:200px;"></div></th>    
                 </tr> 
                 </thead>  

                 
				 <?php 

		$k=0;
		
		$p=0;

		$arr=array();


		$y=ceil($x/$limit);

    	$query = mysql_query("SELECT * FROM location_info, location_to_project WHERE location_info.loc_id = location_to_project.loc_id AND location_to_project.project_id='".$_REQUEST['pid']."' 
		AND location_info.loc_group='".$_REQUEST['loc_grp']."'
		ORDER BY
		loc_group 
		LIMIT {$startpoint} , {$limit}");



      

      while($row = mysql_fetch_assoc($query))

       {

   $s=mysql_query("select loc_id from location_to_project where loc_id='".$row['loc_id']."'");

	   $arr[]=mysql_num_rows($s);

		$row1=mysql_fetch_assoc($s);

		

		if($row1['loc_id']=='')

		{

		$p=$k;

	

		}

?>	

<tbody>
				 			<tr>

				 				
                                
                                <td width="5%">

				  <?php if($row['active_bool']==0) { ?>	


<input type="checkbox" name="cbox[<?php echo $row['loc_id'];?>]" value="0">
<input type="hidden" name="id[<?php echo $row['loc_id'];?>]" value="<?php echo $row['loc_id'];?>">

				  <?php } if($row['active_bool']==1) { 

				  	?>                 
                    
                    
<input type="checkbox" checked="checked" name="cbox[<?php echo $row['loc_id'];?>]" value="1">
<input type="hidden" name="id[<?php echo $row['loc_id'];?>]" value="<?php echo $row['loc_id'];?>">
                    
                    
                    

				 <?php } ?>

				 </td>
                                
                                
                                

							  <td height="25"> <h3 class="del_com">      <a style="font-size:18px;"href="index.php?loc_display=1&amp;lid=<?php echo $row['loc_id'];?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid; }?>">

<?php echo $row['loc_name'].""; ?>
</a>
</h3>
</td>
								<td align="left" style="padding-left:10px">
								<h3 class="del_com">
								 <a style="font-size:18px;"href="index.php?loc_display=1&amp;loc_grp=<?php echo $row['loc_group']; ?>&amp;lid=<?php echo $row['loc_id'];?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $pid; }?>">

<?php echo $row['loc_group']; ?>
</a>
								
                                
                                </h3>
                                </td>

					 			<td align="left" style="padding-left:30px">
                  
                             
                                
                                
                                
                                
                                
                                </td>

	    		   </tr>

<?php			

			  				}	


		

	

?>
</tbody>

			 </table>

			 <table width="400">	

				 <tr>

                 	<td width="12%">
                    
                   
  <input type="checkbox" value="on" name="allbox" onclick="checkAll();"/>  
               	 </td>

					 <td width="35%">

					  	<div>Check/Uncheck all</div>

					 </td>

	                   
 
                     <td width="44"> 

                     	<input type="submit" name="save" id="save" value="Save" />

                     	

                     </td>
<td>
</td>

				  

				 </tr>

			 </table> 

</form>


<form action="" method="get" name="new_group_list" onchange="document.forms['new_group_list'].submit()">
<input type="hidden" name="perpage" value="<?php echo $limit ?>" />
<input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>">
<input type="hidden" name="pid" value="<?php echo $prjid ?>" />

<table width="600">	

				 <tr>

                 	<td width="12%">
                      
               	 </td>

					 <td width="35%">

					 </td>

                     <td width="44%"> 
                    
                     </td>
<td width="9%">
                        <select name="loc_grp">
<option value="No Group" selected>Select Another Group</option>
 <?php	        	

	     $sql_group=mysql_query("SELECT DISTINCT location_info.loc_group
FROM location_info, location_to_project 
WHERE location_to_project.project_id='".$_REQUEST['pid']."' AND location_to_project.loc_id=location_info.loc_id AND loc_group IS NOT NULL ORDER BY loc_group") 

;

		while($groups=mysql_fetch_assoc($sql_group))

						{

?>					

<?php if($groups['loc_group']!=='')

{
	?>

							<option value="<?php echo $groups['loc_group']; ?>"><?php echo $groups['loc_group'] ?></option>	
                            
              <?php } ?>          
              
<?php					

						}

?>
</select>
</td>

				  

				 </tr>

			 </table></form>

				

				<div class="pagination">

<?php if($x>$limit) { ?>

<ul id="pagination-flickr">

<?php if($page>1) { ?><li class="next"><a href="?del_loc=1&amp;page=<?php echo $page-1; ?>&amp;perpage=<?php if(isset($_REQUEST['perpage'])){ echo $_REQUEST['perpage']; }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; } ?>">Previous</a></li>  <?php } ?>

<?php for($i=1;$i<=$y;$i++)

{

?>

<a href="?del_loc=1&amp;page=<?php echo $i; ?>&amp;perpage=<?php if(isset($_REQUEST['perpage'])){ echo $_REQUEST['perpage']; }?>&amp;pid=<?php echo $_REQUEST['pid'] ?>"> <?php  echo $i; ?></a>

<?php

}

?>

<?php if($page<$y) { ?><li class="next"><a href="?del_loc=1&amp;page=<?php echo $page+1; ?>&amp;perpage=<?php if(isset($_REQUEST['perpage'])){ echo $_REQUEST['perpage']; }?>&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; } ?>">Next</a></li> <?php } ?>



</ul> 

<?php } ?> 

<br />
<br />
</div>

<form action="" method="get" name="form1">
<input name="del_loc" type="hidden" value="1" />
<input type="hidden" name="pid" value="<?php echo $prjid ?>" />

<div style="margin-left:10px">
<table width="350px">
  <tr>
    <td>
    <input name="perpage" type="text" value="<?php echo $limit ?>" size="3" maxlength="3" />

     

<input type="submit" name="submitted" id="submit" value="Set" />
    #per page
        </td>
        
            <td width="100px">

            <label for="submit_all">Show All</label> <input type="submit" name="submit_all" id="submit_all" value="<?php echo $x; ?>" /> 

    </td>
  </tr>
</table>
</div></form>
