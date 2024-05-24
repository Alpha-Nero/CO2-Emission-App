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
                                    <h4 class="page-title float-left"><?php if(isset($_GET['edit'])){?> Edit Item<?php  }else{?>Add Items<?php }?></h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="#">Alpha</a></li>
                                        <li class="breadcrumb-item active"><?php if(isset($_GET['edit'])){?> Edit Item<?php  }else{?>Add Items<?php }?></li>
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
                                      <span class="button__text">Add Item</span>
                                      <span class="button__icon">
                                        <i class="zmdi zmdi-collection-plus"></i>
                                      </span>
                                    </button></div><?php }?>
                                  <div class="additem_i" <?php if(isset($_GET['edit'])){?>style="display:block;"<?php  }else{?>style="display:none;"<?php }?>>
                             <?php if (isset($_GET['edit']))
                                        {
                                            $id =  $_GET['edit'];
                                             $where =$id; 
                                             $getDataByid = $data->select_where('item',$where);
                                        }
                                        else
                                        {
                                          $where =-1; 
                                          $getDataByid = $data->select_where('item',$where);  //do stuff that doesn't need 's'
                                        }
                                        
                                        ?>
                                       <h4 class="card-title mb-3"><?php if(isset($_GET['edit'])){?> Edit Item<?php  }else{?>Add Items<?php }?> <span class="message"></span> </h4>
                                       <form class="cmxform"  id="EmissionSource<?php if(isset($_GET['edit'])):?>_edit<?php endif;?>" method="POST" action="" novalidate="novalidate" data-parsley-validate novalidate>
                                      <fieldset>
                                        <div class="row">
                                        <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="cname">Item Code*:</label>
                                          <input id="alpha" class="form-control" name="item_code" minlength="2" value="<?=isset($getDataByid[0]['item_code']) ? $getDataByid[0]['item_code'] : null;?>" placeholder="Ex:I-00001" type="text" parsley-trigger="change" required>
                                          <span class="error" style="display:none;">Please enter Item Code</span>
                                         </div>
                                        </div>
                                         <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="cname">Item Unit*:</label>
                                           <select class="form-control" id="exampleSelect1" parsley-trigger="change" name="item_unit" required>
                                               <option value="">Select Item Unit</option>
                                               <?php $entriesList = $data->select('item_unit'); 
                                                 if(count((array)$entriesList) > 0){
                                                    $count = 1;
                                               foreach($entriesList as $entry){?>
                                            <option value="<?=$entry['item_unit_id']?>" <?php echo ($entry['item_unit_id'] == $getDataByid[0]['item_unit'] ? ' selected="selected"' : '');?>><?=$entry['item_unit_name'];?></option>
                                      <?php }} ?>
                                          </select>
                                         </div>
                                        </div>
                                        <div class="col-md-2">
                                         <div class="form-group">
                                          <label for="cemail">Emission Factor:</label>
                                           <input class="form-control" type="text" value="<?=$getDataByid[0]['item_emission_factor'];?>" name="item_emission_factor" id="example-item_emission_factor"  placeholder="Ex: 100.45">
                                           </div>
                                        </div>
                                        <div class="col-md-2">
                                         <div class="form-group">
                                          <label for="cemail">Ideal Emission:</label>
                                           <input class="form-control" type="text" value="<?=$getDataByid[0]['ideal_emission_factor'];?>" name="ideal_emission_factor" id="example-item_emission_factor"  placeholder="Ex: 100.45">
                                           </div>
                                        </div>
                                       <div class="col-md-3">
                                         <div class="form-group">
                                          <label for="cemail">Item Material Detail:</label>
                                           <input class="form-control" type="text" value="<?=$getDataByid[0]['item_material_detail'];?>" name="item_material_detail" id="example-item_material_detail"  placeholder="Ex: Synthetic Paint">
                                           </div>
                                        </div>
                                       
                                        <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="cemail">Description:</label>
                                          <textarea rows="6" cols="50" id="item_description" class="form-control" name="item_description" minlength="4" placeholder="Ex: Synthetic Paint we present provide insensitive and durable finish on surfaces. This is suitable to apply on plastic, wooden, and metal furniture and objects to increase their appeal and life. Easily applicable with brush, it is totally water repellent, pure, odourless, and highly stable because composed from the finest chemical compounds with progressive processing methodologies."><?=$getDataByid[0]['item_description'];?></textarea>
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
                                		<th style="width:5%">S.no</th>
                                		<th style="width:15%">Item Code</th>
                                		<th style="width:30%">Item Description</th>
                                		<th style="width:10%">Item Unit</th>
                                		<th style="width:10%">Emission Factor</th>
                                    <th style="width:10%">Ideal Emission</th>
                                		<th style="width:15%">Item Material Detail</th>
                                		<th style="width:5%">Action</th>
                                    	</tr>
                                        </thead>
                                        <tbody>
                                       <?php
                                    	$entriesList = $data->select('item'); 
                                             if(count((array)$entriesList) > 0){
                                            		$count = 1;
                                            		foreach($entriesList as $entry){
                                            		    $id=$entry['item_id'];
                                            		     $item_code=$entry['item_code'];
                                            		     $item_description=$entry['item_description'];
                                            		     $item_unit=$entry['item_unit'];
                                            		     $item_material_detail=$entry['item_material_detail'];
                                            		  $item_emission_factor=$entry['item_emission_factor'];
                                                  $ideal_emission_factor=$entry['ideal_emission_factor'];
                                                  
                                            		    // $item_weight_in_kg=$entry['item_weight_in_kg'];
                                            		     $itemUnit = $data->select_where('item_unit',$item_unit);
                                            		     
                                            		   ?>
                                    		   <tr class="<?=$s_color;?>">
                                    		    	<td><?=$count;?></td>
                                    		    	<td><?=$item_code;?></td>
                                    		    	<td><?=$item_description;?></td>
                                    		    	<td><?=$itemUnit[0]['item_unit_name'];?></td>
                                    		    	<td><?=$item_emission_factor;?></td>
                                              <td><?=$ideal_emission_factor;?></td>
                                    		    	<td><?=$item_material_detail;?></td>
                                    		    	<td><a href="add-items.php?edit=<?=$id;?>"><i class="blue  zmdi zmdi-edit"></i></a> |  <a href="javascript:void(0);" onclick='itemDelete("<?=$id?>")'><i class='red zmdi zmdi-delete'></i></a></td>
                                    		    	
                                    		    </tr>
                                    		    <?php 
                                    		    $count++;
                                    		}
                                    	}else{
                                    		echo "<tr><td colspan='6'>No record found</td></tr>";
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
.error {
    border: 1px solid red;
}
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


$(document).on('submit','#EmissionSource',function(e){
e.preventDefault();
           var item_alphaName     = $("#alpha").val();
           var exampleSelect1    = $("#exampleSelect1").val();
           var item_emission_factor    = $("#example-item_emission_factor").val();
          if(item_alphaName ==''){
               jQuery('#alpha').addClass('error');
               jQuery('.error').show('slow');
              return;
          }else if(exampleSelect1==''){
              jQuery('#exampleSelect1').addClass('error');
              jQuery('.error').show();
              return;
          }else if(item_emission_factor ==''){
              jQuery('#example-item_emission_factor').addClass('error');
              jQuery('.error').show();
              return;
          }


var action	= "add_items";
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
var action	= "update_item";
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