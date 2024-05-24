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
         $tableName ='location_master';
        ?>
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left"><?php if(isset($_GET['edit'])){?> Edit Location<?php  }else{?>Add Location<?php }?></h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="#">Alpha</a></li>
                                        <li class="breadcrumb-item active"><?php if(isset($_GET['edit'])){?> Edit Location<?php  }else{?>Add Location<?php }?></li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                            
                         <h4 class="card-title mb-3"><?php if(isset($_GET['edit'])){?> Edit Location<?php  }else{?>Add Location<?php }?>  <span class="message"></span> </h4>
                    <?php if(isset($_GET['edit'])){ $id =  $_GET['edit']?$_GET['edit']:'-1';$where =$id; $getDataByid = $data->select_where($tableName,$where);}else{$getDataByid = $data->select_where($tableName,-1);}  ?>
                   <form class="cmxform" id="EmissionSource<?php if(isset($_GET['edit'])):if($_GET['edit']):?>_edit<?php endif;endif;?>" method="POST" action="" novalidate="novalidate" data-parsley-validate novalidate>
                      <fieldset>
                            <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for="cname">Location Name*:</label>
                              <input id="location" class="form-control" name="addLocation" minlength="2" value="<?=$getDataByid[0]['location_master_name'];?>" placeholder="Ex: L00001" type="text" parsley-trigger="change" required>
                              
                             </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="cemail">Location Area Value :</label>
                                <div id="start_date" class="input-group date datepicker">
                                   <input id="loccation_area" class="form-control" name="loccation_area" type="text" value="<?=$getDataByid[0]['location_master_area'];?>" placeholder="Ex: 500">
                                </div>
                                </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                <label for="cemail">Location Description:</label>
                                <div id="start_date" class="input-group date datepicker">
                                   <textarea id="loccation_description" class="form-control" name="loccation_description" rows="6" cols="50" value="" placeholder="Ex: Location Description"><?=$getDataByid[0]['location_master_description'];?></textarea>
                                </div>
                                </div>
                                </div>
                                </div>
                                <?php if($_GET['edit']):?>
                               <input class="btn btn-primary" type="submit" name="update" value="Update">
                               <?php else:?>
                              <input class="btn btn-primary" type="submit" name="submit" value="Save">
                              <?php endif;?>
                                
                              </fieldset>
                            </form>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                		<th style="width:10%">S.no</th>
                                		<th style="width:15%">Location Name</th>
                                		<th style="width:50%">Location Description</th>
                                		<th style="width:15%">Location Area Value)</th>
                                		<th style="width:10%">Action</th>
                                    	</tr>
                                        </thead>
                                        <tbody>
                                       <?php
                                    	$entriesList = $data->select('location_master'); 
                                             if(count($entriesList) > 0){
                                            		$count = 1;
                                            		foreach($entriesList as $entry){
                                            		     $is_visibility=$entry['location_master_is_visibility'];
                                            		     if($is_visibility!=0){
                                            		     $id=$entry['location_master_id'];
                                            		     $location_master_name=$entry['location_master_name'];
                                            		     $location_master_area=$entry['location_master_area'];
                                            		     $location_master_desc=$entry['location_master_description'];
                                            		     }
                                            		   ?>
                                    		   <tr class="">
                                    		    	<td><?=$id;?></td>
                                    		    	<td><?=$location_master_name;?></td>
                                    		    	<td><?=$location_master_desc;?></td>
                                    		    	<td><?=$location_master_area;?></td>
                                    		    	<td>
                                    		    	    <a href="add-location.php?edit=<?=$id;?>"><i class="blue  zmdi zmdi-edit"></i></a>
                                    		    	    <a href="javascript:void(0);" onclick="is_visibility(<?=$id;?>);"><i class='red zmdi zmdi-delete'></i></a>
                                    		    	</td>
                                    		    </tr>
                                    		     
                                    		    <?php 
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

$(document).on('submit','#EmissionSource',function(e){
e.preventDefault();
var action	= "addLocation";
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

$(document).on('submit','#EmissionSource_edit',function(e){
e.preventDefault();
var action	= "update_location";
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
     var action	= "update_location";
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

</script>
<?php require 'includes/footer_end.php' ?>