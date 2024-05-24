<?php 
include 'auth.php';
require 'includes/header_start.php'; ?>
        <!-- DataTables -->
        <link href="plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Multi Item Selection examples -->
        <link href="plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <?php require 'includes/header_end.php'; ?>
        <?php include 'config.php'; 
        $data = new Databases;  
         $tableName ='location_master';
         include("database.php");
        ?>
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left"><?php if(isset($_GET['edit'])){?> Edit Data Source Subcategory<?php  }else{?>Add Data Source Subcategory<?php }?></h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="#">Alpha</a></li>
                                        <li class="breadcrumb-item active"><?php if(isset($_GET['edit'])){?> Edit Data Source Subcategory<?php  }else{?>Add Data Source Subcategory<?php }?></li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
            	<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
				<div class="col-sm-6">
					<h4 style="margin-left: 15px;">Add Emission Factors </h4>
				</div>
				<div class="col-sm-6">
					<!--<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					
					<li class="breadcrumb-item active">Add Consumption</li>
					</ol>-->
				</div>
				</div>
			</div>
			<!-- /.container-fluid -->
			</section>

		<form  method="POST" action ="emission.php">
			<!-- Main content -->
			<section class="content">
			<div class="container-fluid">
				<!-- SELECT2 EXAMPLE -->
				<div class="card-default">
				<div class="card-header">	
						
					<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<!--<i class="fas fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-card-widget="remove">
						<i class="fas fa-times"></i>-->
					</button>
					</div>
				</div>

				<!-- /.card-header -->
				<div class="card-bod">
                <div class="row">
                <div class="col-md-6" style="padding-right:250px!important;">
                	<div class="form-group">
						
					<input id="example2_year"  type="text" class="form-control"  name="year" value="" placeholder="Select Year"/>
						
					</div>
                </div>
                
            </div>
			
		
			
         <?php

			$indexnum=array();
     
            $sql1= "select * from data_source where is_visibility =1";
      
            $data_source=array();
             $data_source = $data->select_Query($sql1);
		
            foreach($data_source as $value_source){

            ?>
			
			<div id="myDiv" class="myDiv" style=" border: 1px solid #ccc; padding: 20px; border-radius: 10px;">
          <div style="margin: -20px; background-color:#17a2b8; color:white; text-align: center; border-radius: 10px 10px 0px 0px;">
            <h2><?php print_r($value_source['data_source_name']) ?></h2>
			</div>
<br>

            <?php



//second loop for fetcing data from data source group table by data source id
          $data_source_id=$value_source['data_source_id'];
           //  print_r($value1['data_source_id']);

            $sql2= "select * from data_source_group where data_source_id='$data_source_id' AND  is_visibility =1";
            $data_source_group = $data->select_Query($sql2);

            // second loop start from here
            foreach($data_source_group as $value_group){

            ?>

        <h5 style="margin-left: 10px;"> <?php print_r($value_group['data_source_group_name']) ?></h5>
		
  
			<!--Electricity 1st Row -->
			<div class="row" style="padding-top:25px!important;" >
					<div class="col-2" style="width: 10%;"  >
						<div class="form-group" >
							<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sr. No.</label><br>
						</div>
					</div>

					<div class="col-2" style="width: 40%;  margin-left:0%" >
						<div class="form-group" >
							<label>Data Source Name</label><br>
						</div>
					</div>
					<div class="col-2" style="width: 15%; margin-left:12%">
						<div class="form-group" >
							<label>Scope</label>
						</div>
					</div>

					<div class="col-2" style="width: 15%; margin-left:1%">
						<div class="form-group" >
							<label>Emission Factor</label>
						</div>
					</div>
					
					<div class="col-2" style="width: 12%; margin-left:1%">
						<div class="form-group"  >
							<label>Unit</label>
							
						</div>
					</div>
				</div>
				<!--Electricity Row ends -->

              
            
				<?php
             $data_source_id=$value_source['data_source_id'];
			 $data_source_group_id=$value_group['data_source_group_id'];
           //  print_r($value2['data_source_group_id']);


            $sql3= "select * from data_source_subcategory where data_source_id='$data_source_id' and data_source_group_id=' $data_source_group_id' AND is_visibility =1";
             $data_subcategory = $data->select_Query($sql3);
          
		//	$data_subcategory=array();
          
			$scope=array("Scope 1", "Scope 2", "Scope 3");
             $sno=1;
            foreach($data_subcategory as $value_subcategory){
            ?>

				<div class="row">
					<div class="col-2" style="width: 10%;">
						<div class="form-group">
							<label style="font-weight: 300;  margin-top: 4px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $sno;?></label>
						</div>
					</div>

					<div class="col-2" style="width: 100%;  margin-left:0%" >
						<div class="form-group" >
							<label style="font-weight: 300;  margin-top: 4px;"><?php print_r($value_subcategory['data_source_subcategory_name']);?></label>
						</div>
					</div>

					<div class="col-2"  style="width: 15%;  margin-left:12%" >
						<div class="form-group" >
						<select class="form-control select2 " name="scope[]" data-dropdown-css-class="select2">
								<option selected="selected">Select</option>
								<?php for($i=0;$i<count($scope); $i++){

									?>
									 <option><?php print_r($scope[$i]) ?></option>
									<?php
								}
								?>
							</select>
                            
						</div>
					</div>

					<div class="col-2"  style="width: 15%;  margin-left:1%" >
						<div class="form-group" >
							<input type="text" class="form-control" name="emission_factors_value[]" placeholder="Enter Value" >
                            <input type="hidden" class="form-control" name="data_source_subcategory_id[]" value="<?php echo $value_subcategory['data_source_subcategory_id']?>" placeholder="Enter Value" >
						</div>
					</div>
					
					<div class="col-2"  style="width: 12%;  margin-left:1%" >
						<div class="form-group" >
					
                            <input type="text" class="form-control" name="unit[]" placeholder="Enter Unit" >
						</div>
					</div>
				</div>
				
				<!--Electricity Row ends -->
			
				<?php

				$sno++;
 
            }
			?>
			
            <?php
                    $count= count($data_subcategory);
            		for ($i=0; $i<$count; $i++){
            		   $indexnum[]= $data_subcategory[$i]['data_source_subcategory_id'];
            		   // echo '<input type="hidden" class="form-control" name="data_source_subcategory_id[]" placeholder="Enter Value" value="'.$data_subcategory[$i]['data_source_subcategory_id'].'">';
            			
            		}
            
            		}
            	?>
	
	<br></div><br>
	
	<?php


        }
	

				?>
			
			

				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<!--<input type="submit"  class="btn btn-info" name="submit" value="Save Appointment">-->
					
				</div>
				
				<div class="card-footer">
					<input type="submit"  class="btn btn-info" name="submit" value="Save Consumption">
					
				</div>
				</div>
				
				<!-- /.card -->
				

			
				<?php 
                   print_r($_POST);
					if(  isset($_POST['submit'])){

                        $country_id= 1;
						$year= '2023';


						// submit form loop
						for($i=0; $i<count($_POST['emission_factors_value']); $i++){
					   

							$sql="insert into emission_factors(data_source_subcategory_id,  emission_factors_value,unit,  year, country_id,scope)values('".$indexnum[$i]."','".$_POST['emission_factors_value'][$i]."','".$_POST['unit'][$i]."','$year','$country_id','".$_POST['scope'][$i]."')";

                         
							$result=mysqli_query($conn,$sql);

							if($result){
								echo "<script>Swal.fire({ position: 'top-end', icon: 'success', title: 'Your Data Save successfully', showConfirmButton: false, timer: 1500 });window.location.href = 'https://thinkitdigitals.in/alpha1/import-consumption.php';</script>";
							}

							else{
								echo "<script>Swal.fire({ position: 'top-end', icon: 'success', title: 'Opps ! Have Some Issue, showConfirmButton: false, timer: 1500 });</script>";
							}
						}
					}
			?>
				
			</div>
		
			</section>
		
			</form>
			
		</div>
                   
                     </div> <!-- container -->
                </div> <!-- content -->
            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

<?php require 'includes/footer_start.php' ?>

        <!-- Required datatable js -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Responsive examples -->
        <script src="plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
      <script>
            $(document).ready(function() {
                // Default Datatable
                $('#responsive-datatable').DataTable();

            });

$(document).on('input','#Source',function(e){
    let projectName = $('#Source').val();
    let msg;
    if(projectName.length==0){
      msg="<span style='color:red'>Enter Project Name</span>";
    }
   else{
      checkProject(projectName);
    }
    $('#projectStatus').html(msg);
});
 function checkProject(prjectName){
       $.ajax({
        method:"POST",
        url: "ajax.php",
        data:{project_Name:prjectName},
        success: function(data){
          $('#projectStatus').html(data);
        }
      });
}

$(document).on('submit','#DataSourcesubcat',function(e){
e.preventDefault();
var action	= "addDataSourcesubCat";
$.ajax({
		type: "POST",
		url: "ajax.php",
		data:$(this).serialize()+"&action="+action,
		success: function (result) {
		    console.log(result)
		 if(result==1){
		  $('.message').html('<span style="color:green;font-size:10px;">Data Save Successfully</span>'); 
		  setTimeout(function(){
           window.location.reload();
        }, 500);
		     
		 }else{
		   $('.message').html(result);  
		 }
	   }
	});
});

$(document).on('submit','#DataSourcesubcat_edit',function(e){
e.preventDefault();
var action	= "updateDataSourceGroup";
var edit="<?=$_GET['edit'];?>";
$.ajax({
		type: "POST",
		url: "ajax.php",
		data:$(this).serialize()+"&update="+edit+"&action="+action,
		success: function (result) {
		    console.log(result)
		 if(result==1){
		  $('.message').html('<span style="color:green;font-size:10px;">Data Update Successfully</span>'); 
		  setTimeout(function(){
           window.location.reload();
        }, 500);
		     
		 }else{
		   $('.message').html(result);  
		 }
	   }
	});
});

var is_visibility = function(id){
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
     var action	= "dataSourceGroupDisable";
     var is_v= '&is_visible=0';
         $.ajax({
    		type: "POST",
    		url: "ajax.php",
    		data:"id="+id+"&isVisible=0&action="+action,
    		success: function (result) {
    		    console.log(result)
    		if (result==1) {
                Swal.fire(
                  'Deleted!',
                  'Your Record has been deleted.',
                  'success'
                )
                 window.location.reload();
                //$('#responsivelo-datatable').DataTable().ajax.reload();
              }
    	   }
          });
  
        }); 
}
function reload(){
    var s1=document.getElementById('s1').value 
    self.location='datasubcategory.php?$key='+s1;
  }
</script>

<?php require 'includes/footer_end.php' ?>