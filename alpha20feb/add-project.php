<?php require 'includes/header_start.php';
include 'auth.php'; ?>
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
         $tableName ='project_master';
        ?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Add Project</h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="#">Alpha</a></li>
                                        <li class="breadcrumb-item active">Add Project</li>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                    <div class="buttonAdd">
                                    <button type="button" class="button_f" id="addItem" data-toggle="modal" data-target="#addProjectModal">
                                      <span class="button__text">Add Project</span>
                                      <span class="button__icon">
                                        <i class="zmdi zmdi-collection-plus"></i>
                                      </span>
                                    </button></div>
                                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive mt-5" cellspacing="0" width="100%">
                                       
                                        <thead>
                                        <tr>
                                		<th style="width:5%">S.no</th>
                                		<th style="width:20%">Project Name</th>
                                		<th style="width:40%">Project Description</th>
                                		<th style="width:12%">Start Date</th>
                                		<th style="width:12%">End Date</th>
                                		<th style="width:11%">Action</th>
                                    	</tr>
                                        </thead>
                                        <tbody>
                                       <?php
                                    	$entriesList = $data->select($tableName); 
                                             if(count($entriesList) > 0){
                                            		$count = 1;
                                            		foreach($entriesList as $entry){
                                            		    $is_visibility=$entry['project_master_is_visibility'];
                                            		     $upload_status=$entry['project_master_status'];
                                            		    $location_id=$entry['project_master_location_id'];
                                            		   
                                            		   if($is_visibility==1){
                                            		    $id = $entry['project_master_id'];
                                            		    $name = $entry['project_name'];
                                            		    $desc = $entry['project_master_description'];
                                            		    $s_date = $entry['project_master_start_date'];
                                            		    $e_date = $entry['project_master_end_date'];
                                            		    if($upload_status!=1){
                                            		        $s_color="color:#333;";
                                            		    }else{
                                            		        $s_color="color:green;font-weight:600;";
                                            		    }
                                            		   ?>
                                    		   <tr style="<?=$s_color;?>" >
                                    		    	<td><?=$count;?></td>
                                    		    	<td><a href="view-project_detail.php?view=<?=$name;?>"><?=$name;?></a></td>
                                    		    	<td><?=$desc;?></td>
                                    		    	<td><?=$s_date;?></td>
                                    		    	<td><?=$e_date;?></td>
                                    		    	<td class="action expand-button">
                                                    <span class="accordion-toggle collapsed"  data-toggle="collapse" href="#collapseExample<?=$count;?>" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="blue  zmdi zmdi-edit"></i></span> 
                                    		    	<a href="view-project_detail.php?view=<?=$name;?>"><i class='blue mdi zmdi zmdi-eye'></i></a> 
                                    		    	<a href="javascript:void(0);" onclick="project_is_visibility(<?=$id;?>);"><i class='red zmdi zmdi-delete'></i></a>
                                    		    	
                                    		    	</td>
                                    		    	
                                    		    </tr>
                                    		     <tr class="hide-table-padding collapse" id="collapseExample<?=$count;?>">
                                                    <td colspan="6">
                                                    <span class="message"></span>
                                                    <div id="collapse-kk<?=$count;?>" class="collapsekkk in p-3">
                                                    <form class="cmxform EmissionSource_edit" id="" method="POST" action="" novalidate="novalidate" data-parsley-validate novalidate>
                                                    <input type="hidden" value="<?=$entry['project_master_id'];?>" name="project_id" id="project_id" />
                                                      <fieldset>
                                                        <div class="row">
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                          <label for="cname">Project Name*:</label>
                                                          <input id="Source" class="form-control" name="project_name" minlength="2" value="<?=$name;?>" placeholder="Ex: P00001" type="text" parsley-trigger="change" readonly>
                                                          <!--div id="projectStatus"></div-->
                                                         </div>
                                                        </div>
                                                         <!--div class="col-md-3">
                                                        <div class="form-group">
                                                          <label for="cname">Project Location*:</label>
                                                           <select class="form-control" id="exampleSelect1" parsley-trigger="change" name="locationName" required>
                                                               <option value="">Select Location</option>
                                                               <?php $entriesList = $data->select('location_master'); 
                                                                 if(count($entriesList) > 0){
                                                                    //$count = 1;
                                                               foreach($entriesList as $entry){?>
                                                            <option value="<?=$entry['location_master_id']?>" <?php if($location_id == $entry['location_master_id']){ echo 'selected="selected"';}?>><?=$entry['location_master_name'];?></option>
                                                      <?php }} ?>
                                                          </select>
                                                         </div>
                                                        </div-->
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label for="cemail">Start Date:</label>
                                                        <div id="start_date" class="input-group date datepicker">
                                                           <input id="emission_value" class="form-control" name="start_date" type="date" value="<?=$new_date = date("Y-m-d",strtotime($s_date));?>" placeholder="Ex: 2023-04-20">
                                                        </div>
                                                           
                                                        </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                         <div class="form-group">
                                                          <label for="cemail">End Date* :</label>
                                                           <div id="end_date" class="input-group date datepicker">
                                                        <input class="form-control" type="date" value="<?=$e_date;?>" name="end_date" id="example-date-input"  placeholder="Ex: 2023-04-20">
                                                        </div>
                                                        </div>
                                                        </div>
                                                       <div class="col-md-12">
                                                         <div class="form-group">
                                                          <label for="cemail">Description:</label>
                                                          <textarea rows="6" cols="50" id="project_master_description" class="form-control" name="description" minlength="4" placeholder="Ex: Introduction This final project will be dived in two parts : 1) first part: we will study each type of magnetic materials by giving the definition, magnetic susceptibility."><?=$desc;?></textarea>
                                                        </div>
                                                        </div>
                                                        
                                                        </div>
                                                        <input class="btn btn-primary" type="submit" name="submit" value="Update">
                                                      </fieldset>
                                                    </form>
                                                      </td>
                                                  </tr>
                                    		    <?php }
                                    		    $count++;
                                    		}
                                    	}else{
                                    		echo "<tr><td colspan='3'>No record found</td></tr>";
                                    	}
                                    	
                                    
                                    	?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end row -->
                     </div> <!-- container -->
                </div> <!-- content -->
            </div>
            <!-- End content-page -->
   <div class="modal fade bd-example-modal-xl" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addItemModal" aria-hidden="true">
              <div class="modal-dialog Large modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Items to Project <span class="message"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="cmxform" id="EmissionSource" method="POST" action="" novalidate="novalidate" data-parsley-validate novalidate>
                      <fieldset>
                        <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                          <label for="cname">Project Name*:</label>
                          <input id="Source" class="form-control" name="project_name" minlength="2" value="" placeholder="Ex: P00001" type="text" parsley-trigger="change" >
                          <div id="projectStatus"></div>
                         </div>
                        </div>
                         <!--div class="col-md-3">
                        <div class="form-group">
                          <label for="cname">Project Location*:</label>
                           <select class="form-control" id="exampleSelect1" parsley-trigger="change" name="locationName" required>
                               <option value="">Select Location</option>
                               <?php $entriesList = $data->select('location_master'); 
                                 if(count($entriesList) > 0){
                                    $count = 1;
                               foreach($entriesList as $entry){?>
                            <option value="<?=$entry['location_master_id']?>"><?=$entry['location_master_name'];?></option>
                      <?php }} ?>
                          </select>
                         </div>
                        </div-->
                        <div class="col-md-4">
                        <div class="form-group">
                        <label for="cemail">Start Date:</label>
                        <div id="start_date" class="input-group date datepicker">
                           <input id="emission_value" class="form-control" name="start_date" type="date" value="" placeholder="Ex: 2023-04-20">
                           <div id="error"></div>
                        </div>
                           
                        </div>
                        </div>
                        <div class="col-md-4">
                         <div class="form-group">
                          <label for="cemail">End Date* :</label>
                           <div id="end_date" class="input-group date datepicker">
                        <input class="form-control" type="date" value="" name="end_date" id="example-date-input"  placeholder="Ex: 2023-04-20">
                        </div>
                        </div>
                        </div>
                       <div class="col-md-12">
                         <div class="form-group">
                          <label for="cemail">Description:</label>
                          <textarea rows="6" cols="50" id="project_master_description" class="form-control" name="description" minlength="4" placeholder="Ex: Introduction This final project will be dived in two parts : 1) first part: we will study each type of magnetic materials by giving the definition, magnetic susceptibility."></textarea>
                        </div>
                        </div>
                        
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                      </fieldset>
                    </form>
                  </div>
                 
                </div>
              </div>
             
            </div>

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

$(document).ready(function() {
    $('input#Source').keyup(function() {
    var  projectName = $(this).val();
    let msg;
    if(projectName.length==0){
      msg="<span style='color:red'>Enter Project Name</span>";
    }
   else{
      checkProject(projectName);
    }
    $('#projectStatus').html(msg);
    });
});

/*$(document).on('input','#Source',function(e){
    let projectName = $('#Source').val();
    alert(projectName);
    let msg;
    if(projectName.length==0){
      msg="<span style='color:red'>Enter Project Name</span>";
    }
   else{
       
      //checkProject(projectName);
    }
    $('#projectStatus').html(msg);
});*/
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

$(document).on('submit','#EmissionSource',function(e){
        e.preventDefault();
var pname = $('.modal input#Source').val(); 
var s_date =$('.modal input#emission_value').val();
if(pname==''){
  $('#projectStatus').html('<span style="color:red">Project name is required!</span>'); 
  return;
}
if(s_date ==''){
  $('#error').html('<span style="color:red">Start Date is required!</span>');  
  return;
}
var action	= "project_save";
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
$(document).on('submit','.EmissionSource_edit',function(e){
 e.preventDefault();
 
var action	= "project_update";
$.ajax({
		type: "POST",
		url: "ajax.php",
		data:$(this).serialize()+"&action="+action,
		success: function (result) {
		    console.log(result)
		 if(result==1){
		  $('.message').html('<span style="color:green;font-size:10px;">Data Updated Successfully</span>'); 
		  setTimeout(function(){
           window.location.reload();
        }, 500);
		     
		 }else{
		   $('.message').html(result);  
		 }
	   }
	});

	   
    
    
    
});

var project_is_visibility = function(id){
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
     var action	= "project_disable";
         $.ajax({
    		type: "POST",
    		url: "ajax.php",
    		data:"id="+id+"&action="+action,
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
</script>

<style>
.button_f {
  display: flex;
  height: 50px;
  padding: 0;
  background: #009578;
  border: none;
  outline: none;
  border-radius: 5px;
  overflow: hidden;
  font-family: "Quicksand", sans-serif;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
}
div#addProjectModal {
    margin-left: 9%;
}
.button_f:hover {
  background: #008168;
}

.button_f:active {
  background: #006e58;
}

.button__text,
.button__icon {
  display: inline-flex;
  align-items: center;
  padding: 0 24px;
  color: #fff;
  height: 100%;
}

.button__icon {
  font-size: 1.5em;
  background: rgba(0, 0, 0, 0.08);
}
button#addLocation {
    float: right;
    margin-right: 20px;
    margin-bottom: 48px;
}    

.card-box.table-responsive {
    position: relative;
}

.assign_item {
    position: absolute;
    width: 173px;
    margin: 0 auto;
    top: 23px;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 9999;
}
a.assign_btn {
    color: blue !important;
    text-decoration: underline !important;
    font-weight: 600;
} 
div#exampleModal {
    z-index: 10000;
}
button#addItem {
    margin-bottom: 30px;
    padding-left: 0;
}

</style>

<?php require 'includes/footer_end.php' ?>