<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>$(document).ready(function () {
$('#allbox').click(function () {    
     $('input:checkbox').prop('checked', this.checked);    
 });
});
</script> 
<?php 

include('config.php');

//Queries

// Tasks
	
// Tasks
$sql_task = $DBH->prepare("SELECT * FROM task_info, task_to_project WHERE task_info.task_id=task_to_project.task_id AND project_id='".$_REQUEST['pid']."'");
$sql_task->execute();
$task_result_rows = $sql_task->rowCount();

if(!isset($_SESSION['pm'])){
		header("location:login.php");
	}
	
	if(isset($_REQUEST['submit_all'])) {
		$limit=$task_result_rows;
	} else {
		
		if(isset($_REQUEST['perpage'])) {
			$limit=$_REQUEST['perpage'];
		} else {
			$limit=$task_result_rows;
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
	
if(isset($_REQUEST['save'])){
	
	if(isset($_REQUEST['cbox'])) {
		foreach($_REQUEST['id'] as $key => $id) {
			
			if(isset($_REQUEST['cbox'][$key])) {
				$checked[] = $id;
			} else {
				$unchecked[] = $id;
			}

		}

mysql_query("UPDATE task_info SET active_bool=1 WHERE task_id IN (".implode(',', $checked).")");
		
mysql_query("UPDATE task_info SET active_bool=0 WHERE task_id IN (".implode(',', $unchecked).")");
	} else {
		
		if(!isset($_REQUEST['cbox'])) {
			foreach($_REQUEST['id'] as $key => $id) {
				$unchecked[] = $id;
			}

		}

mysql_query("UPDATE task_info SET active_bool=0 WHERE task_id IN (".implode(',', $unchecked).")");
	}

}

?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
	<link href="css/grey.css" rel="stylesheet" type="text/css" />
	<link href="paging.css" rel="stylesheet" type="text/css" />
    
<form name="del_prj" id="del_prj" action="" style="line-height:10px">

<input type="hidden" name="list_tasks" value="1">
<?php  if(isset($_REQUEST['page'])) { ?>

<input type="hidden" name="page" id="page_num" value="<?php  echo $_REQUEST['page']; ?>">
				 
<?php                               } ?>
 
		     <table>
				 <tr>
				 <td width="5%">
				 </td>
				 <td width="45%">
				    <div style="width:400px;">
				      <h3 id="com_name">
                    Task Name</h3></div>
				  </td>
				  <td width="50%" style="float:left"> 
				       <div style="width:200px;"><h3 style="color:#0099FF;">Show <img src="images/rightcheck.png"  width="15" height="15"/> &nbsp;  Hide <img src="images/crosscheck.png" width="15" height="15"/> </h3></div>
					   <br />
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
$y=ceil($task_result_rows/$limit);
$query = mysql_query("SELECT * FROM task_info LIMIT {$startpoint}

 , {$limit}

");
?>
<?php
 while($row = mysql_fetch_assoc($query))       { ?>		
 <tr>
                 <td width="5%">
				  <?php  if($row['active_bool']==0) { ?>	
<input type="checkbox" name="cbox[<?php  echo $row['task_id']; ?>]" value="0">
<input type="hidden" name="id[<?php  echo $row['task_id']; ?>]" value="<?php  echo $row['task_id']; ?>">
				  <?php 
	}

	
	if($row['active_bool']==1) {
		?>                 
<input type="checkbox" checked="checked" name="cbox[<?php  echo $row['task_id']; ?>]" value="1">
<input type="hidden" name="id[<?php  echo $row['task_id']; ?>]" value="<?php  echo $row['task_id']; ?>">
				 <?php  } ?>
				 </td>
				<td width="45%" height="25">
                <h3 class="del_com">
				<a href="index.php?tid=<?php  echo $row['task_id']; ?>&amp;edit_task=1"><?php  echo $row['task_name']; ?></a>
				</h3>
				 </td>
<td width="50%" align="left" style="padding-left:30px">         
<?php  if ($row['visible']==1) { ?>
<a href="index.php?list_tasks=1
&amp;pid=<?php  echo $_REQUEST['pid']; ?>&amp;tid=<?php  echo $row['task_id']; ?>&amp;visible=<?php  echo $row['visible']; ?>&amp;vis_tsk=1&amp;page=<?php 
		
		if(isset($_REQUEST['page'])){
			echo $_REQUEST['page'];
		}

		?>&amp;perpage=<?php  echo $limit; ?>"><img src="images/rightcheck.png"  width="15" height="15"/> </a>
			<?php
 } else { ?>
<a href="index.php?list_tasks=1
&amp;pid=<?php  echo $_REQUEST['pid']; ?>&amp;visible=<?php  echo $row['visible']; ?>&amp;vis_tsk=1&amp;page=<?php 
		
		if(isset($_REQUEST['page'])){
			echo $_REQUEST['page'];
		}

		?>&amp;tid=<?php  echo $row['task_id']; ?>&amp;perpage=<?php  echo $limit; ?>"><img src="images/crosscheck.png" width="15" height="15"/> </a>
			 <?php
 } ?>
				</td>
				<td></td>
				 </tr>
<?php
 } ?>
			</table>			 
			<table>	
				 <tr>
                 	<td width="5%
                    ">
				 		<input type="checkbox" value="on" name="allbox" id="allbox" class="allbox"/>    
                    </td>
					 <td width="20%">
					  	<div>Check/Uncheck all</div>
					 </td>
                     <td width="30%"> 
<input name="perpage" type="hidden" value="<?php  echo $limit  ?>" />
 <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>" />
<input type="submit" name="save" id="save" value="Save" />
                     </td>
<td width="40%">
</td>
				 </tr>
			 </table> 
				</form>
				<div class="pagination">
<?php  if($task_result_rows>$limit) { ?>
<ul id="pagination-flickr">
<?php  if($page>1) { ?><li class="next">
<a href="?page=<?php  echo $page-1; ?>
&amp;pid=<?php echo $_REQUEST['pid'];?>												&amp;perpage=<?php 
		
		if(isset($_REQUEST['perpage'])){
			echo $_REQUEST['perpage'];
		}

		?>
                                                &amp;list_tasks=1">
                                                Previous</a></li> <?php  } ?>
<?php  for($i=1;$i<=$y;$i++){ ?>
<a href="?page=<?php  echo $i; ?>&amp;list_tasks=1
&amp;pid=<?php echo $_REQUEST['pid'];?>
&amp;perpage=<?php 
		
		if(isset($_REQUEST['perpage'])){
			echo $_REQUEST['perpage'];
		}

		?>
">
<?php  echo $i; ?></a>
<?php
 } ?>
<?php  if($page<$y) { ?><li class="next"><a href="?page=<?php  echo $page+1; ?>
&amp;pid=<?php echo $_REQUEST['pid'];?>												  &amp;perpage=<?php 
		
		if(isset($_REQUEST['perpage'])){
			echo $_REQUEST['perpage'];
		}

		?>
										          &amp;list_tasks=1">Next </a></li> <?php  } ?>
</ul> 
<?php  } ?>
<br />
<br />
</div>
<form action="" method="post" name="form1">
<input name="list_tasks" type="hidden" value="1" />
 <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>" />
<div style="margin-left:10px">
<table width="350px">
  <tr>
    <td>
    <input name="perpage" type="text" value="<?php  echo $limit  ?>" size="3" maxlength="3" />
<input type="submit" name="submitted" id="submit" value="Set" />
    #per page
        </td>
            <td width="100px"><label for="submit_all">Show All</label> <input type="submit" name="submit_all" id="submit_all" value="<?php  echo $task_result_rows; ?>" /> 
    </td>
  </tr>
</table>
</div></form>