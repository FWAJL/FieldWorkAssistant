<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>
// Check all
$(document).ready(function () {
$('#allbox').click(function () {    
     $('input:checkbox').prop('checked', this.checked);    
 });
});
</script> 
<?php 
	if(!isset($_SESSION['pm']))
	{
		header("location:login.php");
	}
include('config.php');
// Project info	
$STH_project = $DBH->prepare("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");  
$STH_project->execute();
$STH_project->setFetchMode(PDO::FETCH_ASSOC);  
$row_project = $STH_project->fetch();

// Task info	
$STH_task = $DBH->prepare("SELECT * FROM task_info WHERE task_id='".$_REQUEST['tid']."'");  
$STH_task->execute();
$STH_task->setFetchMode(PDO::FETCH_ASSOC);  
$row_task = $STH_task->fetch();

// People info
$sql = "SELECT * FROM people";  
$row_people = $DBH->query($sql);
$people_rows = $row_people->rowCount();
$x=$people_rows;

// Tasks 	
$sql1 = "SELECT task_id, task_name FROM task_info"; 
$tasks = $DBH->query($sql1);

// Form Handlers

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
 
// Assign

if(isset($_REQUEST['save']))
{ 
 if($_REQUEST['task_id']==0)
 {
  // Alert
$message='You must select a task.';
echo "<script type='text/javascript'>alert('$message');</script>"; 
 
 } else
  {	  
	if(isset($_REQUEST['cbox'])) 
	{

  // Tasks 	
$STH_tn = $DBH->prepare("SELECT task_name FROM task_info WHERE task_id='".$_REQUEST['task_id']."'"); 
$STH_tn->execute();
$STH_tn->setFetchMode(PDO::FETCH_ASSOC);  
$row_tn = $STH_tn->fetch();

$selected_task = $row_tn['task_name'];


  // Lead Technician name
$lead_tech="NOBODY";
$lead_tech_id=0;
if(isset($_REQUEST['lead'])) 	{ 
$lead_tech_id=$_REQUEST['lead']; 	
$STH_lt = $DBH->prepare("SELECT name FROM people WHERE people_id='".$lead_tech_id."'"); 
$STH_lt->execute();
$STH_lt->setFetchMode(PDO::FETCH_ASSOC);  
$row_lt = $STH_lt->fetch();
$lead_tech = $row_lt['name'];
							    }
  // DELETE OLD ASSGNMENTS	
$STH_del_techs = "DELETE FROM people_to_task WHERE task_id = '".$_REQUEST['task_id']."'"; 
$del_people_task = $DBH->query($STH_del_techs);

  //Alert
$message='This will assign the selected field personnel to task: '.$selected_task.' with '.$lead_tech.' as the lead field technician.';
echo "<script type='text/javascript'>confirm('$message');</script>";	

  //Save the selected to a people_to_task list		
		
  foreach($_REQUEST['id'] as $key => $id) 
		{
		  if(isset($_REQUEST['cbox'][$key])) 
			{	
				
  // NEW ASSGNMENTS	
$sql_people_task = "INSERT INTO people_to_task SET 
people_id = :people_i,
task_id = :task_i,
lead_tech = :lead_tec
";
 
$stmt = $DBH->prepare($sql_people_task);

$stmt->bindParam(':people_i', $_REQUEST['id'][$key], PDO::PARAM_INT);
$stmt->bindParam(':task_i', $_REQUEST['task_id'], PDO::PARAM_INT);
$stmt->bindParam(':lead_tec', $lead_tech_id, PDO::PARAM_INT);
$stmt->execute();

  // Show task as "Assigned"	
if($row_task['task_status']=="Under Construction" OR $row_task['task_status']=="Ready") 			{
$sql_task_assigned = "UPDATE task_info SET 
task_status = :task_statu
WHERE
task_id='".$_REQUEST['task_id']."'";
$stmt1 = $DBH->prepare($sql_task_assigned);
$new_status="Assigned";
$stmt1->bindParam(':task_statu', $new_status, PDO::PARAM_STR);
$stmt1->execute(); 
				} 				
			} 
		}
echo "<meta http-equiv='refresh' content='0;url=index.php?list_people=1&amp;pid=".$_REQUEST['pid']."&amp;tid=".$_REQUEST['task_id']."'>";
	}
	exit;
  }
} 
?>

<link href="css/pagination.css" rel="stylesheet" type="text/css" />
	<link href="css/grey.css" rel="stylesheet" type="text/css" />
	<link href="paging.css" rel="stylesheet" type="text/css" /> 
    
<h2 id="com_name">
<?php if(isset($_REQUEST['pid'])) { ?>  
<a href="index.php?show_project=1&amp;pid=<?php echo $_REQUEST['pid'] ?> ">
<?php echo $row_project['project_name']; ?>
</a>
<?php } ?>

<?php if(isset($_REQUEST['tid'])) { ?>  
&nbsp;-&nbsp;
<a href="index.php?show_task=1&amp;tid=<?php echo $_REQUEST['tid'] ?> ">
<?php echo $row_task['task_name']; ?>
<?php } ?>
 </a>
</h2>

<br />
          

<form name="loc_frm" id="loc_frm" action="#" style="width: 30px;" >
<input type="hidden" name="list_people" value="1" />
<input type="hidden" name="pid" value="<?php  echo $_REQUEST['pid']; ?>" />
<input type="hidden" name="tid" value="<?php  echo $_REQUEST['tid']; ?>" />
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
                   Field Personnel</h3></div>
				  </td>
				  <td width="230" style="float:left"> 
<div style="width:230px;">
<h3>
  <label for="radio">Lead Technician</label>
</h3>
</div>
			
				   </td>
				 </tr>
                 	
				 <tr>
				   <td colspan="4">
				   <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>
				   </td>
				 </tr>
 <?php 
$y=ceil($x/$limit);

// Current lead tech
$STH_clt = $DBH->prepare("SELECT DISTINCT lead_tech FROM people_to_task WHERE task_id = '".$_REQUEST['tid']."'");
$STH_clt->execute();
$STH_clt->setFetchMode(PDO::FETCH_ASSOC);  
$row_clt = $STH_clt->fetch();

// Current techs
$STH_techs = $DBH->prepare("SELECT people_id FROM people_to_task WHERE task_id= '".$_REQUEST['tid']."'");
$STH_techs->execute();
$STH_techs->setFetchMode(PDO::FETCH_ASSOC);  
$row_techs = $STH_techs->fetch();

// People List with page limits
$sql_peopl_limit = "SELECT * FROM people LIMIT {$startpoint} , {$limit}" ;  
$row_peopl = $DBH->query($sql_peopl_limit);

foreach($row_peopl as $row)     { 

// Current tech?
// Location Groups
$sql_techs = $DBH->prepare("SELECT * FROM people_to_task WHERE people_id= '".$row['people_id']."' AND task_id= '".$_REQUEST['tid']."'");
$sql_techs->execute();
$sql_techs_rows = $sql_techs->rowCount();

?>

 <tr id="<?php echo $row['people_id'];?>">
                 <td>
				  <?php  if($sql_techs_rows==0) { ?>	
<input type="checkbox" name="cbox[<?php  echo $row['people_id']; ?>]" value="0">
<input type="hidden" name="id[<?php  echo $row['people_id']; ?>]" value="<?php  echo $row['people_id']; ?>">
				  <?php 
	}

	
	if($sql_techs_rows==1) {
		?>                 
<input type="checkbox" checked="checked" name="cbox[<?php  echo $row['people_id']; ?>]" value="1">
<input type="hidden" name="id[<?php  echo $row['people_id']; ?>]" value="<?php  echo $row['people_id']; ?>">
				 <?php  } ?>
				 </td>
				<td height="25">
                <h3 class="del_com">
				<a href="index.php?fpid=<?php  echo $row['people_id']; ?>&amp;edit_people=1"><?php  echo $row['name']; ?></a>
				</h3>
</td>
                 
<td align="left" style="padding-left:30px"><input type="radio" name="lead" <?php if($row['people_id']==$row_clt['lead_tech']) { echo 'checked="checked"'; }?> value="<?php  echo $row['people_id']; ?>" />         
	
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
<input type="submit" name="save" id="save" value="Assign" />
</td>

<td width="281"> 
<Select name="task_id">
<option value="0">Select</option>
<?php foreach($tasks as $row) { ?>
<option value="<?php echo $row['task_id'] ?>" <?php if( $row['task_id'] == $_REQUEST['tid']) { ?> selected="selected" <?php } ?>><?php echo $row['task_name'] ?></option>
<?php } ?>
</select>
</td>
</tr>
                 
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
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
                                                &amp;list_people=1">
                                                Previous</a></li> <?php  } ?>
<?php  for($i=1;$i<=$y;$i++){ ?>
<a href="?page=<?php  echo $i; ?>&amp;list_people=1
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
										          &amp;list_people=1">Next </a></li> <?php  } ?>
</ul> 
<?php  } ?>
<br />
<br />
</div>
<form action="" method="get" name="form1">
<input name="list_people" type="hidden" value="1" />
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
