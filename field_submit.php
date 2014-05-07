

<?php include('config.php');



$count=0;

if(isset($_REQUEST['check_peopleId']))

{

	 $people_value=$_REQUEST['peopleId'];

	

	$select_project=mysql_query("SELECT COUNT(facility_id) FROM people_to_place WHERE people_id='".$people_value."'");

	$row_people_val=mysql_fetch_assoc($select_project);

	 $facilitId=$row_people_val['COUNT(facility_id)'];

	

	$select_project=mysql_query("SELECT COUNT(company_id) FROM people_to_place WHERE people_id='".$people_value."'");

	$row_people_val=mysql_fetch_assoc($select_project);

	$companyId= $row_people_val['COUNT(company_id)'];

	

	$select_project=mysql_query("SELECT COUNT(project_id) FROM people_to_place WHERE people_id='".$people_value."'");

	$row_people_val=mysql_fetch_assoc($select_project);

	$projectID= $row_people_val['COUNT(project_id)'];

	

	

	$comp_flag=0;

	$pro_flag=0;

	$fac_flag=0;

	

						   $sel_company=mysql_query("select company_id from people_to_place where people_id='".$people_value."'");

						   while($g_company=mysql_fetch_assoc($sel_company))

						   {

							 

							 $sel_com=mysql_query("select visible from company_info where company_id='".$g_company['company_id']."'");

						     $g_com=mysql_fetch_assoc($sel_com);

							  if($g_com['visible']==-1)

							  {

							    $comp_flag=0;

								 break; 

							  }

							  else

							  {

							   $comp_flag=1;

							  

							  }

						   

						   }

						   

				   $sel_project=mysql_query("select project_id from people_to_place where people_id='".$people_value."'");

						   while($g_project=mysql_fetch_assoc($sel_project))

						   {

						     $sel_pro=mysql_query("select visible from project_info where project_id='".$g_project['project_id']."'");

						     $g_pro=mysql_fetch_assoc($sel_pro);

							 if($g_pro['visible']==-1)

							  {

							    $pro_flag=0;

								 	break; 

							  }

							  else

							  {

							   $pro_flag=1;

							  

							  }

						    

						   }

						   

						    $sel_facility=mysql_query("select facility_id from people_to_place where people_id='".$people_value."'");

						   while($g_facility=mysql_fetch_assoc($sel_facility))

						   {

						     $sel_fac=mysql_query("select visible from facility_info where facility_id='".$g_facility['facility_id']."'");

						     $g_fac=mysql_fetch_assoc($sel_fac);

							 if($g_fac['visible']==-1)

							  {

							    $fac_flag=0;

								break; 

							  }

							  else

							  {

							   $fac_flag=1;

							   	

							  }

						   

						   }

						   

					

	$arr = array('companyId'=>$companyId,'projectID'=>$projectID,'facilitId' =>$facilitId,'peopleID'=>$people_value,'comp_flag'=>$comp_flag,'pro_flag'=>$pro_flag,'fac_flag'=>$fac_flag);

            print_r(json_encode($arr));  

	}

	

	if(isset($_REQUEST['relation']))

	{

	    $people_id_count_java=$_REQUEST['people_id_count'];	

		$company_id_count_java=$_REQUEST['company_id_count'];

		$facility_id_count_java=$_REQUEST['facility_id_count'];

		$project_id_count_java=$_REQUEST['project_id_count'];



        $count_company_people=0;

		$count_company_facility=0;

		$count_company_permit=0;

		$count_company_company=1;

		if($_REQUEST['checkbox_id']<$_REQUEST['company_id_count'] and $_REQUEST['checkbox_id']>=$_REQUEST['people_id_count'])

		{

			

			$id_array[1][0]=$_REQUEST['relation'];

			$select_project=mysql_query("SELECT * FROM company_to_project WHERE company_id='".$_REQUEST['relation']."'");

			while($get_project=mysql_fetch_assoc($select_project))

			{ 

				 $id_array[2][$count_company_permit]=$get_project['project_id'];

				$count_company_permit++;

			}

			

			

			for($i=0;$i<$count_company_permit;$i++)

			{

				$select_facility=mysql_query("SELECT * FROM facility_to_company WHERE project_id='".$id_array[2][$i]."'");

				while($get_facility=mysql_fetch_assoc($select_facility))

				{ 

					 $id_array[3][$count_company_facility]=$get_facility['facility_id'];

					$count_company_facility++;

				}

			}

	

			$exists=1;

		 $arr = array('a' =>$exists,'b'=>$id_array,'c'=>$count_company_people,'d'=>$people_id_count_java,'e'=>$count_company_company,'f'=>$company_id_count_java,'g'=>$count_company_permit,'h'=>$project_id_count_java,'i'=>$count_company_facility,'j'=>$facility_id_count_java);

             print_r(json_encode($arr));

			

		

		}

		$count_project_people=0;

		$count_project_company=0;

		$count_project_facility=0;

		$count_project_permit=1;

	

		if($_REQUEST['checkbox_id']<$_REQUEST['project_id_count'] and $_REQUEST['checkbox_id']>=$_REQUEST['company_id_count'])

		{

			 $id_array[2][0]=$_REQUEST['relation'];

		

			 $select_project=mysql_query("SELECT * FROM facility_to_company WHERE project_id='".$_REQUEST['relation']."'");

			 while($get_project=mysql_fetch_assoc($select_project))

			 {

				  $id_array[3][$count_project_facility]=$get_project['facility_id'];

				  $count_project_facility++;

			  }

			

			

			$exists=2;

			$arr = array('a' =>$exists,'b'=>$id_array,'c'=>$count_project_people,'d'=>$people_id_count_java,'e'=>$count_project_company,'f'=>$company_id_count_java,'g'=>$count_project_permit,'h'=>$project_id_count_java,'i'=>$count_project_facility,'j'=>$facility_id_count_java);

             print_r(json_encode($arr));

			

		}

		

	}



?>



