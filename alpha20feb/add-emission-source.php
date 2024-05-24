<?php require 'includes/header_start.php';
include 'auth.php';

?>
        <!-- DataTables -->
        <link href="plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Multi Item Selection examples -->
        <link href="plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <?php require 'includes/header_end.php'; ?>
        <?php include ('config.php'); 
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
                                    <h4 class="page-title float-left"><?php if(isset($_GET['edit'])){?> Edit Emission Factors<?php  }else{?>Add Emission Factors<?php }?></h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="#">Alpha</a></li>
                                        <li class="breadcrumb-item active"><?php if(isset($_GET['edit'])){?> Edit Emission Factors<?php  }else{?>Add Emission Factors<?php }?></li>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                <?php if(isset($_GET['edit'])){ }else{?><div class="buttonAdd">
                                    <button type="button" class="button_f" id="addItem" data-toggle="modal" data-target="#addProjectModal">
                                      <span class="button__text">Add Emission Factors</span>
                                      <span class="button__icon">
                                        <i class="zmdi zmdi-collection-plus"></i>
                                      </span>
                                    </button></div><?php }?>
                                  <div class="additem_i" <?php if(isset($_GET['edit'])){?>style="display:block;"<?php  }else{?>style="display:none;"<?php }?>>
                             <?php if (isset($_GET['edit']))
                                        {
                                            $id =  $_GET['edit'];
                                             $where =$id; 
                                             $getDataByid = $data->select_where('tbl_emission_factor',$where);
                                        }
                                        else
                                        {
                                          $where =-1; 
                                          $getDataByid = $data->select_where('tbl_emission_factor',$where);  //do stuff that doesn't need 's'
                                        }
                                        
                                        ?>
                                       <h4 class="card-title mb-3"><?php if(isset($_GET['edit'])){?>Edit Emission Source<?php  }else{?>Add Emission Source<?php }?> <span class="message"></span> </h4>
                                       <form class="cmxform"  id="addEmissionSource<?php if(isset($_GET['edit'])):?>_edit<?php endif;?>" method="POST" action="" novalidate="novalidate" data-parsley-validate novalidate>
                                     
                                      </fieldset>
                                          <fieldset>
                                            <div class="row">
                                            <div class="col col-md-4">
                                            <div class="form-group">
                                              <label for="cname"> Data Source*:</label>
                                              <input id="Source" class="form-control" name="sourceName" placeholder="Ex: Electricity" minlength="2" type="text" >
                                            </div>
                                            </div>
                                            <div class="col col-md-4">
                                            <div class="form-group">
                                              <label for="cemail">Emission Factor*:</label>
                                              <input id="emission_value" class="form-control" name="emission_value"  placeholder="Ex: 0.254" type="text">
                                             
                                            </div>
                                            </div>
                                            <div class="col col-md-4">
                                             <div class="form-group">
                                              <label for="cemail"> Year* :</label>
                                              <input id="emission_year" class="form-control" name="emission_year" placeholder="Ex: 2020"  minlength="4" type="text" >
                                               <span id="error_y"></span>
                                            </div>
                                            </div>
                                            
                                            </div>
                                             <?php if(isset($_GET['edit'])):?>
                                               <input class="btn btn-primary" type="submit" name="update" value="Update">
                                               <?php else:?>
                                              <input class="btn btn-primary" type="submit" name="submit" value="Save">
                                              <?php endif;?>
                                          </fieldset>
                                       </form>
                                  </div>
                                </div>
                                
                                <div class="card-box table-responsive">
                                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                		<tr>
                                		<th style="width:1%">S.no</th>
                                		<th>Data Source</th>
                                		<th>Emission Factor</th>
                                		<th>Year</th>
                                    	</tr>
                                        </thead>
                                        <tbody>
                            	    	<?php
                                       $query ="SELECT * FROM tbl_emission_factor ORDER BY e_year DESC"; 
                            	    //	select_Query
                            	    	$entriesList = $data->select_Query($query); 
                                             if(count((array)$entriesList) > 0){
                                            		$count = 1;
                                            		foreach($entriesList as $entry){
                                            		    $id = $entry['id'];
                                            		    $name = $entry['data_source'];
                                            		    $data_value = $entry['data_value'];
                                            		    $e_year = $entry['e_year'];
                                            		    echo "<tr>
                                            		    	<td>".$id."</td>
                                            		    	<td>".$name."</td>
                                            		    	<td>".$data_value."</td>
                                            		    	<td>".$e_year."</td>
                                            		    </tr>
                                            		    ";
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
<style>
i.blue {font-size: 18px;}
.red {font-size: 18px;color: red;}
</style>
<script>
$(document).ready(function() {
  // Default Datatable
 $('#responsive-datatable').DataTable();
});
$('#exampleSelect1').on('change',function(){
   var optionsText = this.options[this.selectedIndex].text;
   $('#item_weight').html(optionsText);
   $("#example-item_weight_in_kg").attr("placeholder", 'Ex: Item Weight '+optionsText);
});


$(document).on('submit','#addEmissionSource',function(e){
e.preventDefault();
var action	= "add_addEmissionSource";
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
$(document).on('submit','#add_addEmissionSource_edit',function(e){
e.preventDefault();
var action	= "update_EmissionSource";
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

jQuery("button").click(function(){
  jQuery(".additem_i").toggle('slow');
});

var itemDelete = function(id){
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
     var action	= "itemDeletemaintable";
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
};

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


.buttonAdd {
    margin-bottom: 33px;
}    
</style>
<?php require 'includes/footer_end.php' ?>


