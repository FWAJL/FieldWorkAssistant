<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>
// Check all
$(document).ready(function () {
$('#allbox').click(function () {    
     $('input:checkbox').prop('checked', this.checked);    
 });
});
</script> 

<script type="text/javascript">
//Confirm - Group Name is entered.
$(document).ready(function(){
	$("#analyte_frm").submit(function(){
		if ($("#grp_name").val() != '') {
		return confirm("This will create a group: " + $("#grp_name").val() + ".  Are you sure?");
		}
	});
});
</script>     
<?php 
	
	if(!isset($_SESSION['pm'])){
		header("location:login.php");
	}

	include('config.php');

$sql_proj_nam=mysql_query("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'"); 
$row_proj=mysql_fetch_assoc($sql_proj_nam);
	
$query1 = mysql_query("SELECT * FROM analyte_to_project WHERE project_id='".$_REQUEST['pid']."'");

	$x=mysql_num_rows($query1);
	
	if(isset($_REQUEST['submit_all'])) {
		$limit=$x;
	} else {
		
		if(isset($_REQUEST['perpage'])) {
			$limit=$_REQUEST['perpage'];
		} else {
			$limit=$x;
		}

	}

	$page=1;
	
	if(isset($_REQUEST['page'])){
		$page=$_REQUEST['page'];
		
		if($page==0)   {
			$page=1;
		}

	}

	$startpoint = ($page * $limit) - $limit;
$analyte=mysql_query("select analyte_id from analyte_info  LIMIT {$startpoint}

 , {$limit}

 ");
// Save
if(isset($_REQUEST['save']))
{ 
	if(isset($_REQUEST['cbox'])) 
	{
		foreach($_REQUEST['id'] as $key => $id) 
		{
			if(isset($_REQUEST['cbox'][$key])) 
			{
				$checked[] = $id;
			} else 
		{
				$unchecked[] = $id;
		}
	}
	mysql_query("UPDATE analyte_info SET active_bool=1 WHERE analyte_id IN (".implode(',', $checked).")");
		mysql_query("UPDATE analyte_info SET active_bool=0 WHERE analyte_id IN (".implode(',', $unchecked).")");
  } else {
		if(!isset($_REQUEST['cbox'])) 
			{
			foreach($_REQUEST['id'] as $key =>$id) 
				{
				$unchecked[] = $id;
				}
			}
		mysql_query("UPDATE analyte_info SET active_bool=0 WHERE analyte_id IN (".implode(',', $unchecked).")");
 
} 
?>

<?php
//Save as Group
if($_REQUEST['grp_name']=="") 
{
	//Nothing	
	} else {
		if($_REQUEST['grp_name']!=="") 
				{
$dup = mysql_query("SELECT TRUE FROM anal_groupname_to_group WHERE anal_group_name='".$_REQUEST['grp_name']."' LIMIT 1");
if (mysql_num_rows($dup)) {
	//Alert
print '<script type="text/javascript">'; 
print 'alert("There is already a group with the same name.  You may want to consider changeing the group name to be unique to avoid future confusion.")'; 
print '</script>'; 
}
$sql_new_group=mysql_query("INSERT INTO anal_groupname_to_group SET  
	 anal_group_name='".$_REQUEST['grp_name']."'")
	 or die(mysql_error());

	  $lastinserted=mysql_insert_id();
	  
$sql_group_to_project=mysql_query("INSERT INTO anal_group_to_project SET  
	 anal_group_id='".$lastinserted."',
	 project_id='".$_REQUEST['pid']."'")
	 or die(mysql_error());

if(isset($_REQUEST['cbox'])) 
		{
		foreach($_REQUEST['id'] as $key => $id) 
			{
			if(isset($_REQUEST['cbox'][$key])) 
				{
			mysql_query("INSERT INTO analyte_to_group SET
			 analyte_id='".$key."',
			 anal_group_id='".$lastinserted."'") or die ("Error in query: $sql"); 
			
				}
			}
		}

				}
			}
 }
?>

<link href="css/pagination.css" rel="stylesheet" type="text/css" />
	<link href="css/grey.css" rel="stylesheet" type="text/css" />
	<link href="paging.css" rel="stylesheet" type="text/css" /> 
    

    
    <h2 id="com_name">
  
  <a href="index.php?show_project=1&amp;pid=
<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; }?>
">
  <?php echo $row_proj['project_name']; ?>
  </a>
   
</h2>
          

<form name="analyte_frm" id="analyte_frm" action="#" style="width: 30px;" >
<input type="hidden" name="list_analytes" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<?php  if(isset($_REQUEST['page'])) { ?>
<input type="hidden" name="page" id="page_num" value="<?php  echo $_REQUEST['page']; ?>">
				 <?php
 } ?>
		     <table width="540">
                 	 <tr>
				 <td width="35">
				 </td>
				 <td width="263">
				    <div style="width:250px;">
				      <h3 id="com_name">
                   Analytes</h3></div>
				  </td>
				  <td width="230" style="float:left"> 
				        <div style="width:230px;"><h3 style="color:#0099FF;">Show <img src="images/rightcheck.png"  width="15" height="15"/> &nbsp;  Hide <img src="images/crosscheck.png" width="18" height="13"/> </h3></div>
			
				   </td>
				 </tr>
                 	 <tr>
				 <td width="35" height="24">
				 </td>
				 <td width="263">
        
                 </td>
				  <td width="230" style="float:left"> 
				       
				            <div style="margin-left:10px;">( Left Menu list )</div>
				   </td>
			   </tr>
				 <tr>
				   <td colspan="4">
				   <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>
				   </td>
				 </tr>
 <?php 
$k=0;
$p=0;
$arr=array();
$y=ceil($x/$limit);
$query = mysql_query("SELECT * FROM analyte_info, analyte_to_project WHERE analyte_info.analyte_id = analyte_to_project.analyte_id AND analyte_to_project.project_id='".$_REQUEST['pid']."' 
LIMIT {$startpoint}

 , {$limit}

");
 while($row = mysql_fetch_assoc($query))       { ?>		
 <tr id="<?php echo $row['analyte_id'];?>">
                 <td>
				  <?php  if($row['active_bool']==0) { ?>	
<input type="checkbox" name="cbox[<?php  echo $row['analyte_id']; ?>]" value="0">
<input type="hidden" name="id[<?php  echo $row['analyte_id']; ?>]" value="<?php  echo $row['analyte_id']; ?>">
				  <?php 
	}

	
	if($row['active_bool']==1) {
		?>                 
<input type="checkbox" checked="checked" name="cbox[<?php  echo $row['analyte_id']; ?>]" value="1">
<input type="hidden" name="id[<?php  echo $row['analyte_id']; ?>]" value="<?php  echo $row['analyte_id']; ?>">
				 <?php  } ?>
				 </td>
				<td height="25">
                <h3 class="del_com">
				<a href="index.php?pid=<?php echo $_REQUEST['pid']; ?>&amp;aid=<?php  echo $row['analyte_id']; ?>&amp;show_analyte1=1"><?php  echo $row['analyte_name']; ?></a>
				</h3>
				 </td>
         <td align="left" style="padding-left:30px">         
				<?php  if ($row['visible']==1) { ?>
			<a href="index.php?pid=<?php echo $_REQUEST['pid']; ?>&amp;list_analytes=1&amp;aid=<?php  echo $row['analyte_id']; ?>&amp;visible=<?php  echo $row['visible']; ?>&amp;vis_anal=1&amp;page=<?php 
		
		if(isset($_REQUEST['page'])){
			echo $_REQUEST['page'];
		}

		?>&amp;perpage=<?php  echo $limit; ?>"><img src="images/rightcheck.png"  width="15" height="15"/> </a>
			<?php
 } else { ?>
			 <a href="index.php?pid=<?php echo $_REQUEST['pid']; ?>&amp;list_analytes=1&amp;aid=<?php  echo $row['analyte_id']; ?>&amp;visible=<?php  echo $row['visible']; ?>&amp;vis_anal=1&amp;page=<?php 
		
		if(isset($_REQUEST['page'])){
			echo $_REQUEST['page'];
		}

		?>&amp;aid=<?php  echo $row['analyte_id']; ?>&amp;&amp;perpage=<?php  echo $limit; ?>"><img src="images/crosscheck.png" width="15" height="15"/> </a>
			 <?php
 } ?>
				</td>
			
				 </tr>
<?php
 } ?>
			</table>			 
			<table width="550">	
				 <tr>
                 	<td width="31">
				 		<input type="checkbox" value="on" name="allbox" id="allbox" class="allbox"/>    
                    </td>
					 <td width="129">
					  	<div>Check/Uncheck all</div>
					 </td>
                     <td width="68"> 
                         <input name="perpage" type="hidden" value="<?php  echo $limit  ?>" />
                     	<input type="submit" name="save" id="save" value="Save" />
                     </td>
                        <td width="281"> 
<input value="" name="grp_name" type="text" id="grp_name" style="font-size:9px" size="40" />

                     </td>
				 </tr>
                 <tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td><label for="grp_name">Enter a name here to save as a group.</label>
                 </td>
              </tr>
			 </table> 
				</form>
                
				<div class="pagination">
<?php  if($x>$limit) { ?>
<ul id="pagination-flickr">
<?php  if($page>1) { ?><li class="next"><a href="?pid=<?php echo $_REQUEST['pid']; ?>&amp;page=<?php  echo $page-1; ?>
												&amp;perpage=<?php 
		
		if(isset($_REQUEST['perpage'])){
			echo $_REQUEST['perpage'];
		}

		?>
                                                &amp;list_analytes=1">
                                                Previous</a></li> <?php  } ?>
<?php  for($i=1;$i<=$y;$i++){ ?>
<a href="?page=<?php  echo $i; ?>&amp;list_analytes=1
                                &amp;pid=<?php echo $_REQUEST['pid']; ?>&amp;perpage=<?php 
		
		if(isset($_REQUEST['perpage'])){
			echo $_REQUEST['perpage'];
		}

		?>
">
<?php  echo $i; ?></a>
<?php
 } ?>
<?php  if($page<$y) { ?><li class="next"><a href="?page=<?php  echo $page+1; ?>
												  &amp;pid=<?php echo $_REQUEST['pid']; ?>&amp;perpage=<?php 
		
		if(isset($_REQUEST['perpage'])){
			echo $_REQUEST['perpage'];
		}

		?>
										          &amp;list_analytes=1">Next </a></li> <?php  } ?>
</ul> 
<?php  } ?>
<br />
<br />
</div>
<form action="" method="get" name="form1">
<input name="list_analytes" type="hidden" value="1" />
 <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>" />
<div style="margin-left:10px">
<table width="350px">
  <tr>
    <td>
    <input name="perpage" type="text" value="<?php  echo $limit  ?>" size="3" maxlength="3" />
<input type="submit" name="submitted" id="submit" value="Set" />
    #per page
        </td>
            <td width="100px"><label for="submit_all">Show All</label> <input type="submit" name="submit_all" id="submit_all" value="<?php  echo $x; ?>" /> 
    </td>
  </tr>
</table>
</div></form>
