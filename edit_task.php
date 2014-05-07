<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="parsley.js"></script>

<script>$(document).ready(function () {
	$('.cbox').click(function () {
        var cbox_id = '#' + $(this).attr('id');
       var s_list = '#' + $(this).closest('tr').find('.select_list').attr('id');
        if($(cbox_id).is(":checked"))
         $(s_list).show();
		else
	   $(s_list).hide();
    });
});

</script>

<script>
$(document).ready(function() 
{
$(".lab_message").hide();
    $("#cbox_sampl_lab").change(function()
    {
        if ($("#cbox_sampl_lab").is(":checked")) 
		{
           $("#lab_sample_yes").show();
			$("#lab_sample_no").hide();
			$(".lab_setup").show();
        }
        else	{
            $("#lab_sample_yes").hide();
			$("#lab_sample_no").show();
				}
      })
 });
</script>
  
<script>$(document).ready(function () {
	  $(function() {
    $( "#datepicker" ).datepicker();
  });
});

</script>

<script>$(document).ready(function () {
$('.expand').on( 'keyup', '#instructions', function (e){
    $(this).css('height', 'auto' );
    $(this).height( this.scrollHeight );
});
$('.expand').find( '#instructions' ).keyup();
});
</script> 

<script>$(document).ready(function () {
	
	if($("#cbox_cal").is(":checked")) {
	$("#select_interval").show()	
	} else {
	$("#select_interval").hide()	
	}
	
	if($("#cbox_insp").is(":checked")) {
	$("#select_insp").show()	
	} else {
	$("#select_insp").hide()	
	}
		
	if($("#cbox_constr").is(":checked")) {
	$("#select_constr").show()	
	} else {
	$("#select_constr").hide()	
	}	
	
	if($("#cbox_sampl_field").is(":checked")) {
	$("#select_sample_field").show()	
	} else {
	$("#select_sample_field").hide()	
	}
		
	if($("#cbox_sampl_lab").is(":checked")) {
	$(".lab_setup").show()	
	} else {
	$(".lab_setup").hide()	
	}
	
	});
</script> 

<script>
// Check all
$(document).ready(function () {
$('#allbox').click(function () {    
     $('.cbox_la').prop('checked', this.checked);    
 });
});
</script> 
   
<?php
// Queries

include('config.php');

// Current PM INFO
$STH_pm = $DBH->prepare("SELECT * FROM project_managers");
$STH_pm->execute();
$STH_pm->setFetchMode(PDO::FETCH_ASSOC);  
$row_pm = $STH_pm->fetch();

// Project info	
$STH_project = $DBH->prepare("SELECT * FROM project_info WHERE project_id='".$_REQUEST['pid']."'");  
$STH_project->execute();
$STH_project->setFetchMode(PDO::FETCH_ASSOC);  
$row_project = $STH_project->fetch();

// Current Task Status 
$STH_task = $DBH->prepare("SELECT * FROM task_info, task_to_project WHERE task_info.task_id=task_to_project.task_id AND project_id='".$_REQUEST['pid']."' AND task_to_project.task_id='".$_REQUEST['tid']."'");
$STH_task->execute();
$STH_task->setFetchMode(PDO::FETCH_ASSOC);  
$row_task = $STH_task->fetch();

// Task Status Select List	
$sql = "SELECT * FROM task_status_list";  
$status = $DBH->query($sql);

// Calendar Interval List
$sql1 = "SELECT * FROM task_calinterval_list"; 
$triggercal = $DBH->query($sql1);

// Construction Type List
$sql2 = "SELECT * FROM task_constype_list";  
$constype = $DBH->query($sql2);

// Location Groups 
$sql3 = "SELECT loc_group_to_project.loc_group_id, loc_group_name FROM loc_groupname_to_group, loc_group_to_project WHERE loc_group_to_project.loc_group_id=loc_groupname_to_group.loc_group_id AND project_id='".$_REQUEST['pid']."'";
$loc_groups = $DBH->query($sql3);

// Selected Location Group
$sql4 = "SELECT loc_group_to_project.loc_group_id, loc_group_name FROM loc_groupname_to_group, loc_group_to_project WHERE loc_group_to_project.loc_group_id=loc_groupname_to_group.loc_group_id AND project_id='".$_REQUEST['pid']."'";  
$sel_loc_group = $DBH->query($sql3);

// Field Sample Collection
$sql5 = "SELECT * FROM task_field_sample_list";  
$sample_form = $DBH->query($sql5);

// Field Inspection
$sql6 = "SELECT * FROM task_field_inspection_list";  
$inspection_form = $DBH->query($sql6);

// Sample TAT
$sql7 = "SELECT * FROM turn_around_time";  
$tat = $DBH->query($sql7);

// Sample Type
$sql8 = "SELECT * FROM sample_types";  
$sample_type = $DBH->query($sql8);

// Location Groups
$sql_location_groups = $DBH->prepare("SELECT loc_groupname_to_group.loc_group_id, loc_groupname_to_group.loc_group_name
 FROM loc_groupname_to_group, loc_group_to_project WHERE loc_groupname_to_group.loc_group_id = loc_group_to_project.loc_group_id AND loc_group_to_project.project_id='".$_REQUEST['pid']."'");
$sql_location_groups->execute();
$location_group_rows = $sql_location_groups->rowCount();

// Analyte Groups
$sql_analyte_groups = $DBH->prepare("SELECT anal_groupname_to_group.anal_group_id, anal_groupname_to_group.anal_group_name
 FROM anal_groupname_to_group, anal_group_to_project WHERE anal_groupname_to_group.anal_group_id = anal_group_to_project.anal_group_id AND anal_group_to_project.project_id='".$_REQUEST['pid']."'");
$sql_analyte_groups->execute();
$analyte_group_rows = $sql_analyte_groups->rowCount();

$sql = "SELECT * FROM task_status_list";  
$status = $DBH->query($sql);

?>

<?php

	if(!isset($_SESSION['pm']))

	{

		header("location:login.php");

	}
	
	if(isset($_REQUEST['submit']))
{
	
if(isset($_POST['cbox_pm'])) 
{ $triggerpm=1; }  
else { $triggerpm=0; }	

if(isset($_POST['cbox_rem'])) 
{ $triggerrem=1; }  
else { $triggerrem=0; }	

if(isset($_POST['cbox_sampl_lab'])) 
{ $sampling=1; }  
else { $sampling=0; }	
		
if($_POST['tid']>=1)

// Task Exists - UPDATE  
	{
			
if($_POST['cbox_cal']==1) {$interval=$_POST['trigger_cal'];} else {$interval="";}

if($_POST['cbox_insp']==1) {$inspect=$_POST['sel_form_insp'];} else {$inspect="0";}
//This still needs another database table.

if($_POST['cbox_constr']==1) {$construct=$_POST['form_constr_type'];} else {$construct="";}

if($_POST['cbox_sampl_field']==1) {$field_sample=$_POST['sel_form_samp'];} else {$field_sample="";}

$sql7 = "UPDATE task_info SET 
task_status = :task_statu,
task_name = :task_nam,
task_deadline = :task_deadlin,
trigger_pm = :trigger_p,
trigger_remote = :trigger_remot,
trigger_cal = :trigger_ca,
insp_form_id = :insp_form_i,
sample_form_id = :sample_form_i,
constype = :constr_typ,
loc_group_id = :loc_group_i,
t_instructions = :t_instruction,
t_sampl_lab = :t_sampl_la
WHERE task_id= '".$_POST['tid']."'
";

$stmt = $DBH->prepare($sql7);

$stmt->bindParam(':task_statu', $_POST['task_status'], PDO::PARAM_STR); 
$stmt->bindParam(':task_nam', $_POST['task_nam'], PDO::PARAM_STR);  
$stmt->bindParam(':task_deadlin', $_POST['datepicker'], PDO::PARAM_STR);  
$stmt->bindParam(':trigger_p', $triggerpm, PDO::PARAM_INT); 
$stmt->bindParam(':trigger_remot', $triggerrem, PDO::PARAM_INT);
$stmt->bindParam(':trigger_ca', $interval, PDO::PARAM_STR); 
$stmt->bindParam(':insp_form_i', $inspect, PDO::PARAM_INT);
$stmt->bindParam(':sample_form_i', $field_sample, PDO::PARAM_INT);
$stmt->bindParam(':constr_typ', $construct, PDO::PARAM_STR); 
$stmt->bindParam(':loc_group_i', $_POST['loc_group'], PDO::PARAM_INT);
$stmt->bindParam(':t_instruction', $_POST['instruct'], PDO::PARAM_STR);
$stmt->bindParam(':t_sampl_la', $sampling, PDO::PARAM_INT);  
$stmt->execute();

echo "<meta http-equiv='refresh' content='0;url=index.php?edit_task=1&amp;pid=".$_REQUEST['pid']."&amp;tid=".$_POST['tid']."'>";
		
	} else 
	
//Task does not exist - INSERT
		{
						      
$sql8 = "INSERT INTO task_info 
(task_status, task_name, task_deadline, trigger_pm, trigger_remote, trigger_cal, insp_form_id, sample_form_id, constype, loc_group_id, t_instructions, t_sampl_lab)
VALUES
(:task_statu, :task_nam, :task_deadlin, :trigger_p, :trigger_remot, :trigger_ca, :insp_form_i, :sample_form_i, :constr_typ, :loc_group_i, :t_instruction, :t_sampl_la)
";

$stmt = $DBH->prepare($sql8);

$stmt->bindParam(':task_statu', $_POST['task_status'], PDO::PARAM_STR); 
$stmt->bindParam(':task_nam', $_POST['task_nam'], PDO::PARAM_STR);  
$stmt->bindParam(':task_deadlin', $_POST['datepicker'], PDO::PARAM_STR);  
$stmt->bindParam(':trigger_p', $triggerpm, PDO::PARAM_INT); 
$stmt->bindParam(':trigger_remot', $triggerrem, PDO::PARAM_INT);
$stmt->bindParam(':trigger_ca', $_POST['trigger_cal'], PDO::PARAM_STR); 
$stmt->bindParam(':insp_form_i', $_POST['sel_form_insp'], PDO::PARAM_INT);
$stmt->bindParam(':sample_form_i', $_POST['sel_form_samp'], PDO::PARAM_INT);
$stmt->bindParam(':constr_typ', $_POST['form_constr_type'], PDO::PARAM_STR); 
$stmt->bindParam(':loc_group_i', $_POST['loc_group'], PDO::PARAM_INT);
$stmt->bindParam(':t_instruction', $_POST['instruct'], PDO::PARAM_STR);
$stmt->bindParam(':t_sampl_la', $sampling, PDO::PARAM_INT);   
$stmt->execute();

$insertId = $DBH->lastInsertId();
      
$STH_new_task_to_project = $DBH->prepare("INSERT INTO task_to_project 
(task_id, project_id)
VALUES
(:tid, :pid)
");

$STH_new_task_to_project->execute(array(
':tid' => $insertId,
':pid' => $_REQUEST['pid']
));
      		
echo "<meta http-equiv='refresh' content='0;url=index.php?edit_task=1&amp;pid=".$_REQUEST['pid']."&amp;tid=".$insertId."'>";

		}
 exit; 
}

// Updates Sample Info
// PM information

if(isset($_REQUEST['save_sample_info']))
{
 
$sql9 = "UPDATE  project_managers SET 
pm_comp_name = :pm_comp_nam,
pm_name = :pm_nam,
pm_address = :pm_addres,
pm_email = :pm_emai,
pm_phone = :pm_phon
WHERE pm_id= '".$_SESSION['pm']."'
";
 
$stmt = $DBH->prepare($sql9);

$stmt->bindParam(':pm_comp_nam', $_POST['sample_comp_nam'], PDO::PARAM_STR); 
$stmt->bindParam(':pm_nam', $_POST['sample_contact'], PDO::PARAM_STR);  
$stmt->bindParam(':pm_addres', $_POST['sampler_address'], PDO::PARAM_STR);
$stmt->bindParam(':pm_emai', $_POST['sampler_email'], PDO::PARAM_STR); 
$stmt->bindParam(':pm_phon', $_POST['sampler_phone'], PDO::PARAM_STR); 
$stmt->execute();

// Update task_info
$sql10 = "UPDATE task_info SET 
anal_group_id = :anal_group_i,
sample_tat_id = :ta,
sample_type_id = :sample_typ
WHERE task_id= '".$_REQUEST['tid']."'
"; 
$stmt = $DBH->prepare($sql10);

$stmt->bindParam(':anal_group_i', $_POST['sel_form_anal_group'], PDO::PARAM_INT);
$stmt->bindParam(':ta', $_POST['tat'], PDO::PARAM_INT);
$stmt->bindParam(':sample_typ', $_POST['sample_type'], PDO::PARAM_INT);  
$stmt->execute();


echo "<meta http-equiv='refresh' content='0;url=index.php?edit_task=1&amp;pid=".$_POST['pid']."&amp;tid=".$_POST['tid']."'>";

exit;
	
}

	//include('header.php');

	?>
    
<style type="text/css">
 .matrix_table tr td
{
	border-collapse:collapse;
	border:1px solid black;
	padding-right: 2px;
	padding-left: 2px;
}

 .tab_head {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	text-align: center;
}

.tab_data {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	text-align: center;
}
</style>

<h2 id="com_name">
        
        <a href="index.php?show_project=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; }?>" > 

  <?php echo $row_project['project_name']; ?></a>

<?php

if(isset($_REQUEST['tid']))

{  ?>
		<a href="index.php?edit_task=1&amp;pid=<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; } ?>&amp;tid=<?php if(isset($_REQUEST['tid'])) { echo $_REQUEST['tid']; } ; ?>" > 

  <?php echo " &nbsp;- &nbsp;". $row_task['task_name']; ?></a>

<?php }

if(!isset($_REQUEST['tid'])) {
	
	echo " - Add New Task";
	
}

?>
        
        </h2>
 <h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; "></h5>
    


	<!-- CONTENT -->

<fieldset><legend>Task Information</legend>	

<form name="add_task" id="add_task" action="" method="post" parsley-validate style='display:inline;'>

<table class="data_input">

<tr height="51px">
      <td width="181" id="doc_lib">
        <label for="task_status">
          Current Status: 
        </label>
      </td>
      <td id="doc_lib" colspan="2" style="margin-top:10">

<select name="task_status">
<?php foreach($status as $row) { ?>
<option value="<?php echo $row['task_status_sel'] ?>" <?php if( $row_task['task_status'] == $row['task_status_sel']) { ?> selected="selected" <?php } ?>><?php echo $row['task_status_sel'] ?></option>
<?php } ?>
</select>
      </td>
      <td>
<span style="font-style:italic">List field personnel here.  Not yet coded.</span>      
      </td>
    </tr>
    
<tr height="51px">
<td id="doc_lib">
<label for="task_name">Task Name: </label></td>
<td colspan="3" style="margin-top:10">

<input type="text"  name="task_nam" id="task_nam" value="<?php echo $row_task['task_name']; ?>" parsley-required="true" /></td>
</tr>


<tr id="t_cal" height="25px">

<td id="doc_lib"></td>
<td width="25" height="20"><input type="checkbox" id="cbox_cal"  name="cbox_cal" class="cbox" value="1" <?php if($row_task['trigger_cal']!="") { echo 'checked="checked"'; }?>>
</td>
<td id="doc_lib" height="20" width="235">Calendar</td>
<td valign="top" width="287" id="doc_lib" >

<div class="select_list" id="select_interval" align="left" >
<select name="trigger_cal">
<option value="">Select</option>
<?php foreach($triggercal as $row) { ?>
<option value="<?php echo $row['task_calinterval_sel'] ?>" <?php if( $row_task['trigger_cal'] == $row['task_calinterval_sel']) { ?> selected="selected" <?php } ?>><?php echo $row['task_calinterval_sel'] ?></option>
<?php } ?>
</select>
</div>

</td>
</tr>

<tr height="25px">
<td id="doc_lib">Trigger: </td>           
<td id="doc_lib" height="21"><input type="checkbox" name="cbox_pm" id="cbox_pm" value="1" <?php if($row_task['trigger_pm']=="1") { echo 'checked="checked"'; }?>></td>
<td id="doc_lib" height="21">PM Initiated</td>
<td></td>
</tr>

<tr height="25px">
<td></td>
<td id="doc_lib" height="20"><input type="checkbox" name="cbox_rem" value="1" <?php if($row_task['trigger_remote']=="1") { echo 'checked="checked"'; }?>></td>
<td id="doc_lib" height="20">Remote</td>
<td></td>
</tr>

<tr>
<td id="doc_lib" height="51">
<label for="datepicker">Deadline: </label></td>
<td colspan="2">
<p><input type="text"  name="datepicker" id="datepicker" value=" <?php echo $row_task['task_deadline']; ?>"/></p></td>
<td></td>
</tr>

<tr height="25px">

<td id="doc_lib">Type of work:</td>
<td width="25" height="20"><input type="checkbox" id="cbox_insp"  name="cbox_insp" class="cbox" value="1" <?php if($row_task['insp_form_id']>="1") { echo 'checked="checked"'; }?>>
</td>
<td id="doc_lib" height="20" width="235">Inspection</td>
<td valign="top" width="287" id="doc_lib" >

<div class="select_list" id="select_insp" align="left" >
 
</div>

</td>
</tr>

<tr height="25px">
<td id="doc_lib"></td>           
<td id="doc_lib" height="21"><input type="checkbox" class="cbox" id="cbox_constr" name="cbox_constr" value="1" <?php if($row_task['constype']!="") { echo 'checked="checked"'; }?>></td>
<td id="doc_lib" height="21">Construction</td>
<td>
<div class="select_list" id="select_constr" align="left" >

<select name="form_constr_type">
<option value="">Select</option>
<?php foreach($constype as $row) { ?>
<option value="<?php echo $row['task_constype_sel'] ?>" <?php if( $row_task['constype'] == $row['task_constype_sel']) { ?> selected="selected" <?php } ?>><?php echo $row['task_constype_sel'] ?></option>
<?php } ?>
</select>

</div>
</td>
</tr>

<tr height="25px">
<td></td>
<td id="doc_lib" height="20"><input type="checkbox" name="cbox_sampl_field" id="cbox_sampl_field" class="cbox" value="1" <?php if($row_task['sample_form_id']>="1") { echo 'checked="checked"'; }?>></td>
<td id="doc_lib" height="20">Sample Collection (field)</td>
<td>

<div class="select_list" id="select_sample_field" align="left" >

<Select name="sel_form_samp">
<option value="">Select</option>
<?php foreach($sample_form as $row) { ?>
<option value="<?php echo $row['t_f_s_l_id'] ?>" <?php if( $row_task['sample_form_id'] == $row['t_f_s_l_id']) { ?> selected="selected" <?php } ?>><?php echo $row['sample_form_name'] ?></option>
<?php } ?>
</select>

</div>

</td>
</tr>

<tr height="25px">
<td></td>
<td id="doc_lib" height="20"><input type="checkbox" name="cbox_sampl_lab" id="cbox_sampl_lab" class="cbox" value="1" <?php if($row_task['t_sampl_lab']=="1") { echo 'checked="checked"'; }?>></td>
<td id="doc_lib" height="20">Sample Collection (lab)</td>
<td>
  <div class="lab_message" id="lab_sample_yes">
  Save Task Information first to Veiw Sample Information Form
  </div>
  <div class="lab_message" id="lab_sample_no">
  No lab sample will be collected.  If you previously entered lab data, it will be deleted (need to code).
  </div>
  
  </td>
</tr>

<tr>
    <td id="doc_lib" height="20">
      <label for="loc_group">
        Location Group: 
      </label>
    </td>
    <td colspan="2">
<Select name="loc_group">
<option value="0">Select</option>
<?php foreach($sql_location_groups as $row) { ?>
<option value="<?php echo $row['loc_group_id'] ?>" <?php if( $row_task['loc_group_id'] == $row['loc_group_id']) { ?> selected="selected" <?php } ?>><?php echo $row['loc_group_name'] ?></option>
<?php } ?>
</select>
    </td>
    <td></td>
    </tr>
  </tr>				 
<tr>
<td id="doc_lib"><label for="instructions">Instructions:</label></td>
<td colspan="3">
<div class="expand"><textarea cols="80" name="instructions"  id="instructions" value="<?php echo $row_task['t_instructions']; ?>"><?php echo $row_task['t_instructions']; ?></textarea>
</div>
</td>
</tr>
<tr>
<td colspan="3" align="left">
<input type="hidden" name="vis" id="vis" value="1" >
<input type="hidden" name="pid" id="pid" value="<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; } ?>" >
<input type="hidden" name="tid" id="tid" value="<?php if(isset($_REQUEST['tid'])) { echo $_REQUEST['tid']; } ?>" >
<input type="submit" name="submit" id="submit" value="Save Task Information"  />
</td>
</tr>

<tr>
<td colspan="3" align="left">
<input name="del_task" type="submit" value="Delete this Task"/>
<span style="font-style:italic">Not yet coded.</span>
</td>
</tr>

</table>
</form>	</fieldset>
                                
<!-- EDIT SAMPLE INFO -->              
<?php if($row_task['t_sampl_lab']==1) { ?>
<div class="lab_setup">

<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; ">
</h5>
<fieldset><legend>Lab Sample Information</legend>
<form action="" method="post" name="sample_info" >

<table class="data_input">

<!-- pm Info -->
<tr>
<td id="doc_lib">Sampling Company Name</td>     
<td id="doc_lib" valign="middle"><span style="margin-top:10">
  <input type="text"  name="sample_comp_nam" id="sample_comp_nam" value="<?php echo $row_pm['pm_comp_name'] ?>"/>
</span></td>
<td id="doc_lib" width="163">Contact Person</td>             
<td id="doc_lib" valign="middle"><span style="margin-top:10">
 <input type="text"  name="sample_contact" id="sample_contact" value="<?php echo $row_pm['pm_name'] ?>"/>
</span></td>
</tr>

<tr>
<td id="doc_lib" width="183">Address</td>     
<td id="doc_lib" valign="middle"><span style="margin-top:10">
<input type="text"  name="sampler_address" id="sampler_address" value="<?php echo $row_pm['pm_address'] ?>"/>
</span></td>
<td id="doc_lib" width="163">Email</td>             
<td id="doc_lib" valign="middle"><span style="margin-top:10">
<input type="text"  name="sampler_email" id="sampler_email" value="<?php echo $row_pm['pm_email'] ?>"/>
</span></td>
</tr>

<tr>
<td id="doc_lib" width="183">Phone</td>     
<td id="doc_lib" valign="middle">
<span style="margin-top:10">
<input type="text"  name="sampler_phone" id="sampler_phone" value="<?php echo $row_pm['pm_phone'] ?>"/>
</span>
</td>
<!-- pm Info -->

<!-- task lab sample info -->
<td id="doc_lib" width="163">P.O. #</td>             
<td id="doc_lib" valign="middle"><span style="margin-top:10">
  <input type="text"  name="task_nam5" id="task_nam5" />
</span></td>
</tr>

<tr>
<td id="doc_lib">Comments:</td>
<td colspan="3">
<div class="expand">
<textarea cols="80" name="comments"  id="comments" value="">Place instructions for the laboratory and comments here.</textarea>
</div>
</td>
</tr>		



<tr id="t_cal" height="25px">

<td id="doc_lib">Lab</td>
<td width="198" height="20">
<div class="" id="select_interval2"align="left" ><span class="select_list">
  <select name="interval5">
    <option value="" selected="selected">Lab Name</option>
    <option value="Daily">Get labs from Outside Resources</option>
  </select>
</span>



</div></td>
<td id="doc_lib" height="20" width="163">Sample TAT</td>
<td valign="top" width="255" id="doc_lib" >
<Select name="tat">
<option value="0">Select</option>
<?php foreach($tat as $row) { ?>
<option value="<?php echo $row['t_a_t_id'] ?>" <?php if( $row_task['sample_tat_id'] == $row['t_a_t_id']) { ?> selected="selected" <?php } ?>><?php echo $row['tat'] ?></option>
<?php } ?>
</select>
  </td>
</tr>

<tr height="25px">
<td id="doc_lib">Sample Type</td>           
<td id="doc_lib" height="21"><span class="">
<select name="sample_type">
<option value="0">Select</option>
<?php foreach($sample_type as $row) { ?>
<option value="<?php echo $row['s_t_id'] ?>" <?php if( $row_task['sample_type_id'] == $row['s_t_id']) { ?> selected="selected" <?php } ?>><?php echo $row['sample_type'] ?></option>
<?php } ?>
</select>
</span></td>
<td colspan="2" id="doc_lib" height="21"></td>
</tr>
<!-- task lab sample info -->

<!-- analyte list -->
<tr height="25px">
  <td id="doc_lib" height="20">
      <label for="sel_form_anal_group">
        Analyte Group: 
      </label>
    </td>
    <td colspan="2">
<Select name="sel_form_anal_group">
<option value="0">Select</option>
<?php foreach($sql_analyte_groups as $row) { ?>
<option value="<?php echo $row['anal_group_id'] ?>" <?php if( $row_task['anal_group_id'] == $row['anal_group_id']) { ?> selected="selected" <?php } ?>><?php echo $row['anal_group_name'] ?></option>
<?php } ?>
</select>
    </td>
    <td></td>
</tr>

<tr height="25px">
<td id="doc_lib" height="20" colspan="4">
<input type="hidden" name="pid" id="pid" value="<?php if(isset($_REQUEST['pid'])) { echo $_REQUEST['pid']; } ?>" >
<input type="hidden" name="tid" id="tid" value="<?php if(isset($_REQUEST['tid'])) { echo $_REQUEST['tid']; } ?>" >
<input type="submit" name="save_sample_info" id="submit" value="Save Sample Information"  />
</td>
</tr>
</table>  
</form></fieldset>
</div>	
<?php } ?>
<!-- EDIT SAMPLE INFO --> 


			<br class="spacer" />
         
<?php if($row_task['loc_group_id']!="0" && $row_task['anal_group_id']!="0") {  ?>          

<div class="location_analyte_div">

<h5 style="border-bottom: 8px solid #0066CC; margin-top:7px; margin-bottom:5px; ">
</h5>

<?php if(isset($_REQUEST['save_anal_loc']))
{	 

	foreach ($_REQUEST['id'] as $key => $value) 
		{
		if($_REQUEST['cbox_la'][$value]==1) 
			{
// insert this value if it's not already there
$query4 = $mysqli->query( "SELECT * FROM analyte_location_task WHERE
task_id=1 AND
analyte_location='".$_REQUEST['sample_pair'][$value]."'");
$row_cnt4 = $query4->num_rows;

			if($row_cnt4==0)
			{
	$mysqli->query("INSERT analyte_location_task (analyte_location, task_id) 
VALUES ('".$_REQUEST['sample_pair'][$value]."',1)")
			or die(mysqli_error());
				}  			
			} else { 
				if ($_REQUEST['cbox_la'][$value]==0)
						{
			// delete this value	
$query3 = $mysqli->query( "SELECT * FROM analyte_location_task WHERE
task_id=1 AND
analyte_location='".$_REQUEST['sample_pair'][$value]."'");
$row_cnt = $query3->num_rows;

			if($row_cnt>0) {
		$mysqli->query("DELETE FROM analyte_location_task WHERE task_id=1 AND
analyte_location='".$_REQUEST['sample_pair'][$value]."'")

	 or die(mysqli_error());
	 
							}

						}
	
			}
			
		}
//Alert
 echo '<script>$(document).ready(function () {
alert("Table has been updated.");
});
</script>';
		
		
		
}
// Analyte Info Query	
$query = "SELECT DISTINCT analyte_info.analyte_name, anal_groupname_to_group.anal_group_id, anal_groupname_to_group.anal_group_name, analyte_to_group.anal_group_id, analyte_to_group.analyte_id, task_info.anal_group_id 
FROM analyte_to_group, task_info, anal_groupname_to_group, analyte_info 
WHERE task_info.anal_group_id = analyte_to_group.anal_group_id 
AND anal_groupname_to_group.anal_group_id = analyte_to_group.anal_group_id
AND analyte_info.analyte_id = analyte_to_group.analyte_id 
AND task_info.anal_group_id='".$row_task['anal_group_id']."'";

if ($stmt = $mysqli->prepare($query)) {

   /* execute query */
    $stmt->execute();

    /* store result */
    $stmt->store_result();

}

if ($result = $mysqli->query($query)) {  ?>

<fieldset>
<legend>Analyte and Location Table</legend>
<form action="" method="post">

<table class="matrix_table">
<tr>
<td></td>
<td class="tab_head" colspan="<?php printf($stmt->num_rows); ?>" >Analytes</td> 
</tr>

<tr>
<td class="tab_head">Locations</td>
<?php while ($row = $result->fetch_assoc()) { ?>	
<td class="tab_data"><?php printf ("%s \n", $row["analyte_name"]); ?></td>

<?php }
} 
?>

</tr>
<?php

// Query to get locations

$query1 = "SELECT DISTINCT location_info.loc_name, loc_groupname_to_group.loc_group_id, loc_groupname_to_group.loc_group_name, location_to_group.loc_group_id, location_to_group.loc_id, task_info.loc_group_id 
FROM location_to_group, task_info, loc_groupname_to_group, location_info 
WHERE task_info.loc_group_id = location_to_group.loc_group_id 
AND loc_groupname_to_group.loc_group_id = location_to_group.loc_group_id
AND location_info.loc_id = location_to_group.loc_id 
AND task_info.loc_group_id='".$row_task['loc_group_id']."'";

if ($stmt1 = $mysqli->prepare($query1)) 
{

   /* execute query */
    $stmt1->execute();

    /* store result */
    $stmt1->store_result();

}

if ($result1 = $mysqli->query($query1)) 
{  
$i=0;
?>

<?php while ($row1 = $result1->fetch_assoc()) 
	{ ?>	
<tr>
<td class="tab_data"><?php printf ("%s \n", $row1["loc_name"]); ?></td>

<?php $result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) 
		{ 
$this_sample_pair=$row1['loc_id'].",".$row['analyte_id'];		

$query2 = $mysqli->query( "SELECT * FROM analyte_location_task WHERE
task_id=1 AND
analyte_location='".$this_sample_pair."'");
$row_cnt2 = $query2->num_rows;
		?>	
        
<td align="center">
<input type="checkbox" class="cbox_la" name="cbox_la[<?php echo $i; ?>]" value="1"
<?php if($row_cnt2>0) { echo " checked=checked";   }?>>
<input name="sample_pair[<?php echo $i ?>]" type="hidden" value="<?php echo $this_sample_pair ?>"/>

<input name="nlyt[<?php echo $i ?>]" type="hidden" value="<?php echo $row['analyte_id'] ?>"/>
<input name="local[<?php echo $i ?>]" type="hidden" value="<?php echo $row1['loc_id'] ?>"/>
<input name="id[<?php echo $i; ?>]" type="hidden" value="<?php echo $i; ?>"/>
</td>

<?php 
$i++;
		} ?>
      
</tr>
<?php
	} 

} 

?>

</table>
<input type="checkbox" value="All" name="allbox" id="allbox" class="allbox"/>
Check/Uncheck All
<input name="save_anal_loc" type="submit" value="Save" />
</form>

</fieldset>

</div>

<?php } ?>

<!-- CONTENT -->


	<!-- FOOTER -->

	

	<!-- FOOTER -->

