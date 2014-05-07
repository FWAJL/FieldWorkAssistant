<?php
//Alert
$message='Alert.  There are '.$rows__pm__log_affected.' users.';
echo "<script type='text/javascript'>alert('$message');</script>";  ?>

if(isset($_REQUEST['cbox'])) 
		{
		foreach($_REQUEST['id'] as $key => $id) 
			{
			if(isset($_REQUEST['cbox'][$key])) 
				{
			mysql_query("INSERT INTO location_to_group SET loc_id='".$key."'") or die ("Error in query: $sql"); 
			
				}
			}
		}
        
<?php  //select list from enum with selected option 
$column_name = "task_status";
echo "<select name=\"$column_name\">";
$result = mysql_query("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_NAME = 'task_info' AND COLUMN_NAME = '$column_name'")
or die (mysql_error());

$row = mysql_fetch_array($result);
$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));

foreach($enumList as $value) { ?>
<option value=<?php echo $value ?> <?php if($row_task['task_status']==$value){?>selected<?php } ?>><?php echo $value ?></option>
<?php } ?>
</select>	