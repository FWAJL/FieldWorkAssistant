<?php 
session_start();
$pid=$_SESSION['pid'];

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script type="text/javascript">
$(document).ready(function () {
$('#allbox').click(function () {    
     $('input:checkbox').prop('checked', this.checked);
	$.ajax({
type:"POST",
url:"saveallcheckval.php",
success:function(){
}
});
 });
});

$(document).ready(function(){
//alert('<?php echo $_SESSION['pid'];?>');
	$("#bound_frm").submit(function(){
		if ($("#bound_grp_name").val() != '') {
		return confirm("This will create a group: " + $("#bound_grp_name").val() + ".  Are you sure?");
		}
	});
});
//checkbox boundary
function check(bound_id)
{
	$.ajax({
type:"POST",
url:"savecheckval.php",
data:'id='+bound_id,
success:function(){
}
});

}
//cross check boundary
function crosscheck(id)
{
	document.getElementById("cross"+id).innerHTML='<img src="images/crosscheck.png" onclick="rightcheck('+id+')" width="15" height="15"/>';
	 // jQuery.get('test.txt', function(data) {
 // var text_id=data.split(",");
  //var index=text_id.indexOf(""+id+"");
//text_id.splice(index, 1);
$.ajax({
type:"POST",
url:"saverightcheck.php",
data:'id='+id,
success:function(){

}
});
//});
}
function rightcheck(id)
{

	document.getElementById("cross"+id).innerHTML='<img src="images/rightcheck.png" onclick="crosscheck('+id+')" width="15" height="15"/>';
	  //jQuery.get('test.txt', function(data) {
 // var text_id=data.split(",");
//text_id.push(id);
$.ajax({
type:"POST",
url:"savecrosscheck.php",
data:'id='+id,
success:function(){
}
});
//});
}
</script> 
<?php 

  file_put_contents("test.txt", "");
		if(!isset($_SESSION['pm']))
	{
		header("location:login.php");
	}
	include('config.php');
	$sql_proj_nam=mysql_query("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'"); 
    $row_proj=mysql_fetch_assoc($sql_proj_nam);
	$query1 = mysql_query("SELECT * FROM boundary_to_project WHERE project_id='".$_REQUEST['pid']."'");

	$x=mysql_num_rows($query1);
	
	if(isset($_REQUEST['submit_all'])) {
		$limit=$x;
	} else
	{
		if(isset($_REQUEST['perpage'])) {
			$limit=$_REQUEST['perpage'];
		} 
		else {
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

mysql_query("UPDATE boundary SET active_bool=1 WHERE id IN (".implode(',', $checked).")");
	
mysql_query("UPDATE boundary SET active_bool=0 WHERE id IN (".implode(',', $unchecked).")");
  			} else {
		if(!isset($_REQUEST['cbox'])) 
				{
			foreach($_REQUEST['id'] as $key =>$id) 
					{
				$unchecked[] = $id;
					}
				}
mysql_query("UPDATE boundary SET active_bool=0 WHERE id IN (".implode(',', $unchecked).")");
	}
} 
	
if($_REQUEST['bound_grp_name']=="") 
{

	//Nothing	
}
 else
 {
 if($_REQUEST['bound_grp_name']!=="") 
			{

			$dup = mysql_query("SELECT * FROM bound_groupname_to_group WHERE bound_group_name='".$_REQUEST['bound_grp_name']."' LIMIT 1");
if (mysql_num_rows($dup)) 
			
			{
print '<script type="text/javascript">'; 
print 'alert("There is already a group with the same name.  You may want to consider changing the group name to be unique to avoid future confusion.")'; 
print '</script>'; 
				}
$sql_new_group=mysql_query("INSERT INTO bound_groupname_to_group SET bound_group_name='".$_REQUEST['bound_grp_name']."'");

	  $lastinserted=mysql_insert_id();
	  
$sql_group_to_project=mysql_query("INSERT INTO bound_group_to_project SET bound_group_id='".$lastinserted."',project_id='$pid'");

if(isset($_REQUEST['cbox'])) 
				{
		foreach($_REQUEST['id'] as $key => $id) 
					{
			if(isset($_REQUEST['cbox'][$key])) 
						{
			mysql_query("INSERT INTO boundary_to_group SET bound_id='".$key."', bound_group_id='".$lastinserted."'"); 
						}
					}
				}
			}
			
echo "<meta http-equiv='refresh' content='0;url=index.php?list_boundaries=1&amp;pid=".$_REQUEST['pid']."'>";

   exit;
 }
?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
	<link href="css/grey.css" rel="stylesheet" type="text/css" />
	<link href="paging.css" rel="stylesheet" type="text/css" /> 
    <h2 id="com_name">  
  <a href="index.php?show_project=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; }?>">
  <?php echo $row_proj['project_name']; ?>
  </a>
</h2>
<form name="bound_frm" id="bound_frm" action="#" style="width: 30px;" >
<input type="hidden" name="list_boundaries" value="1" />
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
                   Boundary Names</h3></div>
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
$y=ceil($x/$limit);
 
$projid=$_REQUEST['pid'];

$query = mysql_query("SELECT * FROM boundary, boundary_to_project WHERE boundary.id = boundary_to_project.bound_id AND boundary_to_project.project_id='".$_REQUEST['pid']."' 
LIMIT {$startpoint}

 , {$limit} ");
  while($row = mysql_fetch_assoc($query))       {
//echo $row[active_bool];
 ?>	
  <tr id="<?php echo $row['id'];?>">
                 <td>
				  <?php  if($row['active_bool']==0) { ?>	
<input type="checkbox" name="cbox[<?php  echo $row['id']; ?>]" value="0" id="<?php echo $row['id'];?>" onclick="check(<?php echo $row['id'];?>)">
<input type="hidden" name="id[<?php  echo $row['id']; ?>]" value="<?php  echo $row['id']; ?>">
				  <?php 
				  //echo $row['id'];
	}

	
	if($row['active_bool']==1) {
		?>                 
<input type="checkbox" checked="checked" name="cbox[<?php  echo $row['id']; ?>]" value="1" id="<?php echo $row['id'];?>" onclick="check(<?php echo $row['id'];?>)">
<input type="hidden" name="id[<?php  echo $row['id']; ?>]" value="<?php  echo $row['id']; ?>">
				 <?php  } ?>
				 </td>
				 
				<td height="25">
                <h3 class="del_com">
				<a href="index.php?pid=<?php echo $_REQUEST['pid']; ?>&amp;bid=<?php  echo $row['id']; ?>&amp;edit_boundary=1"><?php  echo $row['bound_name']; ?></a>
				</h3>
				 </td>
         <td align="left" style="padding-left:30px" >         

			<?php  if ($row['visible']==1) { ?>
			<a href="index.php?pid=<?php echo $_REQUEST['pid']; ?>&amp;list_boundaries=1&amp;bid=<?php  echo $row['id']; ?>&amp;visible=<?php  echo $row['visible']; ?>&amp;vis_bound=1&amp;page=<?php 
		
		if(isset($_REQUEST['page'])){
			echo $_REQUEST['page'];
		}

		?>&amp;perpage=<?php  echo $limit; ?>"><div id="cross<?php echo $row['id'];?>"><img src="images/rightcheck.png" onclick="crosscheck(<?php echo $row['id'];?>)" width="15" height="15"/> </a></div>
			<?php
 } else { ?>
			 <a href="index.php?pid=<?php echo $_REQUEST['pid']; ?>&amp;list_boundaries=1&amp;bid=<?php  echo $row['id']; ?>&amp;visible=<?php  echo $row['visible']; ?>&amp;vis_bound=1&amp;page=<?php 
		
		if(isset($_REQUEST['page'])){
			echo $_REQUEST['page'];
		}

		?>&amp;bid=<?php  echo $row['id']; ?>&amp;&amp;perpage=<?php  echo $limit; ?>"><div id="cross<?php echo $row['id'];?>"><img src="images/crosscheck.png" onclick="rightcheck(<?php echo $row['id'];?>)" width="15" height="15"/> </a></div>
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
<input type="checkbox" value="<?php echo $row['id'];?>" name="allbox" id="allbox" class="allbox"/>    
                    </td>
					 <td width="129">
					  	<div>Check/Uncheck all</div>
					 </td>
<td width="68"> 
<input name="perpage" type="hidden" value="<?php  echo $limit  ?>" />
<input type="submit" name="save" id="save" value="Save" />
</td>

<td width="281"> 
<input value="" name="bound_grp_name" type="text" id="bound_grp_name" style="font-size:9px" size="40" />
</td>
</tr>
                 
<tr>
<td></td>
<td></td>
<td></td>
<td><label for="bound_grp_name">Enter a name here to save as a group.</label>
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
                                                &amp;list_boundaries=1">
                                                Previous</a></li> <?php  } ?>
<?php  for($i=1;$i<=$y;$i++){ ?>
<a href="?page=<?php  echo $i; ?>&amp;list_boundaries=1
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
										          &amp;list_boundaries=1">Next </a></li> <?php  } ?>
</ul> 
<?php  } ?>
<br />
<br />
</div>



<form action="" method="get" name="form1">
<input name="list_boundaries" type="hidden" value="1" />
 <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>" />				<div style="margin-left:10px">
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
</div>
</form>