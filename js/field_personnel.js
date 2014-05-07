// JavaScript Document



function del_people()

{

	    var i=0;

	    var flag;

		var status;

  		var count=document.getElementById("people_id_count").value;

  	

  		for(i=0;i<count;i++)

  		{

  			if(document.getElementById("common_checkboxid["+i+"]").checked==true)

  			{

			  var peopleId=document.getElementById("common_checkboxid["+i+"]").value;

			  

			   $.ajax({

       url: 'field_submit.php',

       data: {"peopleId":peopleId,"check_peopleId":1},

	   type: 'post',

       success:function(data){

	    

		 

		  var myObject = eval('(' + data + ')');

					

					

					if(myObject.companyId==0)

			        {

					  if(myObject.projectID==0)

					 {

						  if(myObject.facilitId==0)

						 {

							status=1;

							var id=myObject.peopleID;

									 

							 }

							 else

							 {

								status=0; 

							 if(myObject.comp_flag==0 || myObject.pro_flag==0 || myObject.fac_flag==0)

						  {

							

							flag=0; 

						  }

						  else

						  {

							 

							flag=1;  

						  } 

								 }

						 }

						 else

						 {

							 status=0; 

							 if(myObject.comp_flag==0 || myObject.pro_flag==0 || myObject.fac_flag==0)

						  {

							

							flag=0; 

						  }

						  else

						  {

							 

							flag=1;  

						  }

							 }

					  }

					  

					  else

					  {

						  status=0;

						  if(myObject.comp_flag==0 || myObject.pro_flag==0 || myObject.fac_flag==0)

						  {

							

							flag=0; 

						  }

						  else

						  {

							 

							flag=1;  

						  }

						  

					  }

					 

					  

				if(status==1)

					{

					   var r=confirm("Do you really want to delete this detail ?");	

				    }

					 

					if(status==0)

					{

					   if(flag==1)

					   {

					    alert("Before deleting the field personnel first un-assign their all related companies ,projects and facilities.");

					   }

					   else

					   {

						  alert("Before deleting field personnel's first you have to show their related companies or projects or facilities in view/assign personnel form");   

						}

				    }

					

					

					if (r==true)

                     {

                         var Field_id=btoa(id);

                         document.getElementById("Field_delete_id").value=Field_id;

                         document.people_form.submit();	

                         setTimeout(function(){location.reload(true);}, 100);

                     }

                      else

                       {

                            x="";

                       }

			  }

			   });

			   return false;

			}

			

			}

			

			}

	

  	function submit_people()

  	{

		

  		var i=0;

  		var status=0;

  		var count=document.getElementById("people_id_count").value;

  		//alert(count);

  		for(i=0;i<count;i++)

  		{

  			if(document.getElementById("common_checkboxid["+i+"]").checked==true)

  			{

  					

				var checkbox_id=i;

  				

				status=status+1;

  				var id=document.getElementById("common_checkboxid["+i+"]").value;

				

				

				document.getElementById("relation").value=id;

				document.getElementById("checkbox_id").value=checkbox_id;

				//document.getElementById('text5').innerHTML += "<input type='text' name='relation' value='"+id+"' /><br />";

  			   // document.getElementById('text4').innerHTML += "<input type='text' name='checkbox_id' value='"+checkbox_id+"' /><br />";

  			    document.people_form.submit();		

				

				

				//location='Iframe_demo.php?relation='+btoa(id);		

  			}

  		}

  		/*if(status>1)

  		{

  			alert("Please select only one checkbox");

  			

  		}

  		if(status==1)

  		{

  			document.getElementById('text5').innerHTML += "<input type='hidden' name='relation' value='"+id+"' /><br />";

  			document.getElementById('text4').innerHTML += "<input type='hidden' name='checkbox_id' value='"+checkbox_id+"' /><br />";

  			document.people_form.submit();

  		}*/

  		if(status==0)

  		{

  			alert("Please select single checkbox to know association of that particular field");

  		}

  		

  	}

	

	

	function assign()

    {

      var assign_cnt=document.getElementById("count").value;



	  var flag=document.getElementById("flag").value;

	

      var peo_cnt=document.getElementById("people_id_count").value;

	

	  var i=peo_cnt;

	

	do{

	   if(document.getElementById("common_checkboxid["+i+"]").checked==false)

	   {

	

		 if(i==(assign_cnt-1))

	     {

	       alert('Please first assign the companies,projects or faclities to any field personnel.');

	     }

	   }

	   i++;

	  } while(i<assign_cnt);

	}	

	



function company_clicked(comp_id)

  	{

		var cmp_cunt=document.getElementById("company_id_count").value;

	  

		var flag=document.getElementById("flag").value;

	 

  			

	if(flag==1)

	{

		

		var people_count=document.getElementById("people_id_count1").value;

	}		

			

	else

	{

		

		var people_count=document.getElementById("people_id_count").value;

	}

	var i=people_count;

		do

		{

			

			if(document.getElementById("common_checkboxid["+i+"]").value==comp_id)

  			{

				var checkbox_id=i;

				

  				var id=document.getElementById("common_checkboxid["+i+"]").value;

			     var relation = id;

				

				var project_id_count=document.getElementById("project_id_count").value;

			   

				var facility_id_count=document.getElementById("facility_id_count").value;

				var people=document.getElementById("people").value;

				

				var count=document.getElementById("count").value;

	

				 $.ajax({

       url: 'field_submit.php',

       data: {"company_checkbox":relation,"people_id_count":people_count,"company_id_count":cmp_cunt,

	          "project_id_count":project_id_count,"facility_id_count":facility_id_count,"people":people,

			  "count":count,"relation":comp_id,"checkbox_id":checkbox_id},

	   type: 'post',

       success:function(data){

		    

					   var myObject = eval('(' + data + ')');

					var i=0;

					var exists=myObject.a;

					

					var id_string=myObject.b;

					

					var count_company_people=myObject.c;

					var count_company_company=myObject.e;

					var count_company_facility=myObject.i;

					var count_company_permit=myObject.g;

					

					

					var people_id_count=myObject.d;

					

					

					var company_id_count=myObject.f;

					

					var facility_id_count=myObject.j;

					

					var project_id_count=myObject.h;



					if(exists==1)

					{	

                          for(var k=0;k<count_company_people;k++)

						  { 

							 	

							for(var j=0;j<people_id_count;j++)

							{

								

								

								if(document.getElementById("common_checkboxid["+j+"]").value==id_string[0][k])

								{

									 document.getElementById("common_checkboxid["+j+"]").checked=true;

								}

								

							}

						}

							

						  var sts=0;

						var j=0;

						   for(var k=0;k<count_company_company;k++)

						  {	

							

							var j=people_id_count;

							do

							{

								

								if(document.getElementById("common_checkboxid["+j+"]").value==id_string[1][k])

								{

							      					    

								  if(document.getElementById("common_checkboxid["+j+"]").checked==true)

									{

									  sts=sts+1;

									  

									  if(sts==1)

									  {

									    document.getElementById("common_checkboxid["+j+"]").checked=true;

									  }

								    }

								  

								}

								j++;

								

							 }while(j<company_id_count);

						  }	

						  

						  var j=0;

  						 for(var k=0;k<count_company_permit;k++)

						  {	

						      j=company_id_count;

							do

							{

								

								if(document.getElementById("common_checkboxid["+j+"]").value==id_string[2][k])

								{

								  

									if(document.getElementById("common_checkboxid["+j+"]").checked==false)

									{

										 document.getElementById("common_checkboxid["+j+"]").checked=false;

									}

									if(document.getElementById("common_checkboxid["+j+"]").checked==true)

									{

										 document.getElementById("common_checkboxid["+j+"]").checked=false;

									}

									if(sts==1)

									{

									   document.getElementById("common_checkboxid["+j+"]").checked=true;

									}

									

								 }

								 j++;

							}while(j<project_id_count);

						  }

							

						  var j=0;

						  for(var k=0;k<count_company_facility;k++)

						  {	

						 

							var j=project_id_count;

							do{

								

								if(document.getElementById("common_checkboxid["+j+"]").value==id_string[3][k])

								{

									if(document.getElementById("common_checkboxid["+j+"]").checked==false)

									{

									  document.getElementById("common_checkboxid["+j+"]").checked=false;

									}

									if(document.getElementById("common_checkboxid["+j+"]").checked==true)

									{

									  document.getElementById("common_checkboxid["+j+"]").checked=false;

									}

									if(sts==1)

									{

									   document.getElementById("common_checkboxid["+j+"]").checked=true;

									}

								  }

								  j++;

							    }while(j<facility_id_count);

						  }	

					 }

	          }

    });



	

	return false;

  			

  	

			}

			i++;

		}while(i<cmp_cunt);

	}





  	function project_clicked(pro_id)

  	{

		var pro_cunt=document.getElementById("project_id_count").value;

  		

		var cmp_count=document.getElementById("company_id_count").value;

		

		var people_count=document.getElementById("people_id_count").value;

  		var i=cmp_count;

		do

		{

  			if(document.getElementById("common_checkboxid["+i+"]").value==pro_id)

  			{

				

  				var checkbox_id=i;

  				status=status+1;

  		        var id=document.getElementById("common_checkboxid["+i+"]").value;

			    var relation = id;

							    

				var facility_id_count=document.getElementById("facility_id_count").value;

				

				var people=document.getElementById("people").value;

				

				var count=document.getElementById("count").value;

			

			 $.ajax({

       url: 'field_submit.php',

       data: {"project_checkbox":relation,"people_id_count":people_count,"company_id_count":cmp_count,

	          "project_id_count":pro_cunt,"facility_id_count":facility_id_count,"people":people,

			  "count":count,"relation":pro_id,"checkbox_id":checkbox_id},

	   type: 'post',

	    success:function(data){

			        

					var myObject = eval('(' + data + ')');

					var i=0;

					var exists=myObject.a;

					

					var id_string=myObject.b;

				

					var count_project_people=myObject.c;

					var count_project_company=myObject.e;

					var count_project_facility=myObject.i;

					var count_project_permit=myObject.g;

					

					

					var people_id_count=myObject.d;

					var company_id_count=myObject.f;

					var facility_id_count=myObject.j;

					var project_id_count=myObject.h;

					

					if(exists==2)

					 {

					    for(var k=0;k<count_project_people;k++)

						  {	

							for(var j=0;j<people_id_count;j++)

							{

								if(document.getElementById("common_checkboxid["+j+"]").value==id_string[0][k])

								{

									document.getElementById("common_checkboxid["+j+"]").checked=true;

								}

								

							}

						  }

							

						

						  for(var k=0;k<count_project_company;k++)

						  {	

							for(var j=people_id_count;j<company_id_count;j++)

							{

								if(document.getElementById("common_checkboxid["+j+"]").value==id_string[1][k])

								{

								  if(document.getElementById("common_checkboxid["+j+"]").checked==false)

								   {

								     document.getElementById("common_checkboxid["+j+"]").checked=true;

								   }

								   else

								   {

									 document.getElementById("common_checkboxid["+j+"]").checked=false;

								    }

								}

								

							}

						  }	

						var sts=0;

						var j=0;

						  for(var k=0;k<count_project_permit;k++)

						  {

							 j=company_id_count;

							do

							{

							  if(document.getElementById("common_checkboxid["+j+"]").value==id_string[2][k])

								{

								  if(document.getElementById("common_checkboxid["+j+"]").checked==true)

								   {

								     sts=sts+1;

									 if(sts==1)

									 {

									    document.getElementById("common_checkboxid["+j+"]").checked=true;

								     }

								     else

								     {

									   document.getElementById("common_checkboxid["+j+"]").checked=false;

								     }

								    } 

								}

								j++;

							}while(j<project_id_count);

						  }	

						  

						  

						  var j=0;

						 

						  for(var k=0;k<count_project_facility;k++)

						  {	

							j=project_id_count;

							do

							{

								if(document.getElementById("common_checkboxid["+j+"]").value==id_string[3][k])

								{

								  if(document.getElementById("common_checkboxid["+j+"]").checked==false)

								   {

								       document.getElementById("common_checkboxid["+j+"]").checked=false;

								   }

								 if(document.getElementById("common_checkboxid["+j+"]").checked==true)

								   {

									 document.getElementById("common_checkboxid["+j+"]").checked=false;

								   }

								  

								  if(sts==1)

									{

									   document.getElementById("common_checkboxid["+j+"]").checked=true;

									}

								}

								j++;

								

							}while(j<facility_id_count);

						  }	

					    }

					  }

    });

return false;

  			}

			i++;

		}while(i<pro_cunt);

	}

	

