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
         $tableName ='project_master';
        ?>  
         <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                   <h4 class="page-title float-left">Emission Source </h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="#">Alpha</a></li>
                                        <li class="breadcrumb-item active">Add Emission Source </li>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                        <div class="row">
                            <div class="col-12">
                             
                                <div class="card-box table-responsive">
                                      
                                <h4 class="card-title mb-3">Project Details Views <span class="text-success" style="color:green; font-size:16px;"> <?php if(isset($success_message))  {   echo $success_message;}  ?>  </span> </h4>
                                 <?php if(isset($_GET['view'])){
                                 $view = $_GET['view'];
                                 $where =$view; 
                                 $getDataByid = $data->select_where('project_master',$where); 
                                 $pID = $getDataByid[0]['project_master_id']; 
                                 $projectID=$pID?$pID:'-1';
                                 }else{
                                     $projectID=-1;
                                 }
                                 ?> 
                              <div classs="row">
                                  <div class="col-md-12 text-center"><h1 class="c-font"><strong>Name</strong>:<?=$getDataByid[0]['project_name'];?></h1></div>
                                  <div class="col-md-12"><p><strong>Description</strong>:<?=$getDataByid[0]['project_master_description'];?></p></div>
                                  <div class="col-md-12"><p>
                                  <strong>Start Date</strong>:<?php $date=date_create($getDataByid[0]['project_master_start_date']); echo date_format($date,"Y-m-d"); $start_date=date_format($date,"Y-m-d");?> 
                                <strong>&nbsp;End Date</strong>:<?php $edate=date_create($getDataByid[0]['project_master_end_date']); echo date_format($edate,"Y-m-d"); $end_date=date_format($edate,"Y-m-d");?></p></div>
                                 <div class="col-md-12 projectEmission">
                                <?php
                                function test($startdate,$enddate){
                                $from_date = $startdate;
                                $to_date = $enddate;
                                $start = $month = strtotime($from_date);
                                $tmp = cal_days_in_month(CAL_GREGORIAN,date('m',strtotime($to_date)),date('Y',strtotime($to_date)));
                                $end = strtotime(date('Y-m',strtotime($to_date)).'-'.$tmp);
                                $output = array();
                                while($month < $end){
                                    $days = cal_days_in_month(CAL_GREGORIAN,date('m',$month),date('Y',$month));
                                    $TotaldaysInMonth = cal_days_in_month(CAL_GREGORIAN,date('m',$month),date('Y',$month));
                                    if(date('m',$start) == date('m',$month)) {
                                        $days = $days - date('d',$start) + 1;
                                    } else if(date('m',$end) == date('m',$month)) {
                                        $days = date('d',strtotime($to_date));
                                    }
                                    //echo "Days :".$days." Month :".date('F',$month);
                                   // echo '<br>';
                                  $output[]=array('month'=>date('F',$month),
                                                 'days'=>$days,
                                                 'tdinmonth'=>$TotaldaysInMonth,
                                                 'sYear'=>date('Y',strtotime($from_date)),
                                                 'eYear'=>date('Y',strtotime($to_date))
                                  );
                                  $month = strtotime("+1 month", $month);
                                   
                                }
                                return $output;
                                }
                                $caltotalruningmonth = test($start_date,$end_date);
                               $itemQuery = "select SUM(it.add_Item_to_project_item_quantity*itm.item_emission_factor)AS totalItemEmission FROM add_Item_to_project AS it JOIN project_master AS pm ON it.add_Item_to_project_assign_id = pm.project_master_id JOIN item AS itm ON it.add_Item_to_project_item_id=itm.item_id WHERE pm.project_master_id=$projectID";
                               $itemTotalEmission = $data->select_Query($itemQuery); 
                               // Total project Run That Month
                                   
                                //   $howmanymonthrunproject="
                                //   set @start_date = '$start_date';
                                //   set @end_date = '$end_date';
                                //   set @months = -1;
                                //   select *,DATE_FORMAT(date_range,'%M, %Y') AS result_date from (select (date_add(@start_date, INTERVAL (@months := @months +1 ) month)) as date_range from project_master a limit 0,1000) a where a.date_range between @start_date and last_day(@end_date)";
                                //   echo $howmanymonthrunproject;
                                //   $totalruningMonth = $data->select_Query($howmanymonthrunproject); 
                                //   print_r($totalruningMonth);
                                   $prunMonth="SELECT  project_master_id AS pid, MAX(MONTHNAME(`project_master_start_date`)) AS monthName, MAX(Year(`project_master_start_date`)) AS ProjectRuningYear, DATEDIFF(`project_master_end_date`, `project_master_start_date`) AS totalDaysProjectrun FROM project_master WHERE project_master_is_visibility=1 AND project_master_id='$projectID'";
                                   $totalPrunMonth = $data->select_Query($prunMonth); 
                                  // print_r($totalPrunMonth);
                                  $pTrDayathatMonth =$totalPrunMonth[0]['totalDaysProjectrun'];
                                 foreach($caltotalruningmonth as $ctrm){
                                // $noOfDays_in_Month = date('t', strtotime("$getDataByid[0]['project_master_start_date']"));
                                // $prm = $totalPrunMonth[0]['monthName'];
                                 //$pry = $totalPrunMonth[0]['ProjectRuningYear'];
                                   $pry = $ctrm['sYear'];
                                   $prm = $ctrm['month'];
                                   $noOfDays_in_Month =$ctrm['tdinmonth'];
                                   $pTrDayathatMonth =$ctrm['days'];
                                $consDs = "SELECT (monthly_consumption_value/$noOfDays_in_Month)*$pTrDayathatMonth 
                                 AS mcv ,data_source,e_month,e_year FROM `tbl_monthly_consumption` WHERE `e_month`='$prm'
                                 AND e_year='$pry'";
                               // echo $consDs;
                                 $ConForperticularDs = $data->select_Query($consDs); 
                                 //echo'<pre>'; print_r($ConForperticularDs);
                                 $emsValue=0;
                                 foreach($ConForperticularDs as $key=>$ddevalue){
                                     $thatYear = $ddevalue['e_year'];
                                     //echo $thatYear; $ddevalue['data_source']
                                     $d_DS=$ddevalue['data_source'];
                                     $getEmfQuery = "SELECT DISTINCT data_source AS Ds,data_value AS EmfValue FROM `tbl_emission_factor` WHERE data_source='$d_DS' AND `e_year`='$thatYear'";
                                     $getEmf = $data->select_Query($getEmfQuery); 
                                     //print_r($getEmf);
                                     $embyDs = $ddevalue['mcv']*$getEmf[0]['EmfValue'];
                                     $sum += $embyDs; 
                                 }
                                 
                                 }
                                
                                 
                                 
                                 // Get Consumptionby Data Source
                              
                                ?>
                                <div class="projectRunMonth">
                                    <p><strong>Month</strong>: <?=$totalPrunMonth[0]['monthName'];?></p>
                                    <p><strong>Project Total Running Days</strong>: <?=$totalPrunMonth[0]['totalDaysProjectrun'];?></p>
                                    <p><strong>Total No Of Days In Month</strong>: <?=$noOfDays_in_Month;?></p>
                                    <p><strong>Total Emission By All Data Source</strong>: <?=$sum;?></p>
                                </div>
                                 
                                 <strong>Total Item Emission For This project</strong>: <?=$itemTotalEmission[0]['totalItemEmission'];?>     
                                </div>
                              </div>
                                    <!--table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                		  <th scope="col" style="wdith:10%">S.no</th>
                                          <th scope="col">Item Code</th>
                                          <th scope="col">Project</th>
                                          <th scope="col">Quantity</th>
                                          
                                    	</tr>
                                        </thead>
                                        <tbody>
                                       	<?php
                        	    	//SELECT * FROM `inventory_transaction` WHERE 1
                        	    	$view = $_GET['view']; //$where .= "inventory_transaction_project="".$view"""; 
                        	    	$where = "WHERE inventory_transaction_project= '".$view."'";
                        	    	$entriesList = $data->select_inventry('inventory_transaction',$where );
                        	    
                                         if(count((array)$entriesList) > 0){
                                        		$count = 1;
                                        		foreach($entriesList as $entry){
                                        		    $id = $entry['inventory_transaction_id'];
                                        		    $item_code = $entry['inventory_transaction_item_code'];
                                        		    
                                        		    $date = $entry['inventory_transaction_date'];
                                        		    $tran_account = $entry['inventory_transaction_tran_account'];
                                        		    $e_project = $entry['inventory_transaction_project'];
                                        		    $quantity = $entry['inventory_transaction_quantity'];
                                        		   
                                        		    
                                        		   ?><tr>
                                        		        <td data-label="S.no"><?=$id;?></td>
                                        		        <td data-label="Item Code"><?=$item_code;?></td>
                                        		        <td data-label="Project"><?=$e_project;?></td>
                                        		        <td data-label="Quantity"><?=$quantity;?></td>
                                        		        
                                        		    </tr>
                                        		    <?php 
                                        		    $count++;
                                        		}
                                        	}else{
                                        		echo "<tr><td colspan='4'>No record found</td></tr>";
                                        	}
                                        	?>
                                        </tbody>
                                    </table-->
                                </div>
                            </div>
                            
                             <div class="col-12" id="addItems">
                                <div class="card-box">
                                <div class="row">
                                <div class="col-md-6 col-xl-6">
                                    <!--h3 class="">Add Items to Project</h3-->
                                    <button type="button" class="button_f" id="UploadItemsSheet" data-toggle="modal" data-target="#UploadItemsSheet">
                                      <span class="button__text">Upload Items Sheet</span>
                                      <span class="button__icon">
                                        <i class="zmdi zmdi-collection-plus"></i>
                                      </span>
                                    </button>
                                      <button type="button" class="button_f" id="addItem" data-toggle="modal" data-target="#addItemModal">
                                      <span class="button__text">Add Item (Manually)</span>
                                      <span class="button__icon">
                                        <i class="zmdi zmdi-collection-plus"></i>
                                      </span>
                                    </button>
                                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive mt-5" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                		  <th scope="col" style="wdith:10%">S.no</th>
                                          <th scope="col">Item Name</th>
                                          <th scope="col">Unit Name</th>
                                          <th scope="col">Quantity</th>
                                          <th scope="col">Emission</th>
                                          <th scope="col">Action</th>
                                          
                                    	</tr>
                                        </thead>
                                        <tbody>
                                       	<?php
                                      
                        	    	//SELECT * FROM `inventory_transaction` WHERE 1  add_Item_to_project_assign_id
                        	    	$query ="SELECT * FROM add_Item_to_project WHERE add_Item_to_project_assign_id='$projectID' AND add_Item_to_project_is_visibility=1";
                        	    //	select_Query
                        	    	$itemitem2 = $data->select_Query(	$query);
                        	    
                                         if(count((array)$itemitem2) > 0){
                                        		$count = 1;
                                        		foreach($itemitem2 as $entry){
                                        		    $id_p= $entry['add_Item_to_project_id']; 
                                        		    $item_id = $entry['add_Item_to_project_item_id']; 
                                        		    
                                        		   $itemitem = $data->select_where('item',$item_id);
                                        		   // print_r();
                                        		 
                                        		    $unit_id= $entry['add_Item_to_project_item_id'];
                                        		    
                                        		    $item_unit = $data->select_where('item',$unit_id);
                                        		    $itemunit = $data->select_where('item_unit',$item_unit[0]['item_unit']);
                                        		    //echo'<pre>'; print_r($itemunit);
                                        		    $quantity = $entry['add_Item_to_project_item_quantity'];
                                        		   ?><tr>
                                        		        <td data-label="S.no"><?=$count;?></td>
                                        		        <td data-label="Item Code"><?=$itemitem[0]['item_code'];?></td>
                                        		        <td data-label="Project"><?=$itemunit[0]['item_unit_name'];?></td>
                                        		        <td data-label="Quantity"><?=$quantity;?></td>
                                        		        <td data-label="emission"><?=$quantity*$itemitem[0]['item_emission_factor'];?></td>
                                        		        
                                        		        <td class="action">
                                                        <a id="itemEdit" href='javascript:void(0)' data-itemId="<?=$itemitem[0]['item_code'];?>" data-itemUnit="<?=$item_unit[0]['item_unit_id'];?>" data-itemQuantityt="<?=$quantity;?>" onclick='editItemData("<?=$item_id;?>")'><i class="blue  zmdi zmdi-edit"></i></a>
                                        		        <a href="javascript:void(0);" onclick='itemDelete("<?=$id_p?>")'><i class='red zmdi zmdi-delete'></i></a>
                                    		            </td>
                                        		        
                                        		    </tr>
                                        		    <?php 
                                        		    $count++;
                                        		}
                                        	}else{
                                        		echo "<tr><td colspan='4'>No record found</td></tr>";
                                        	}
                                        	?>
                                        </tbody>
                                    </table>
                                </div>
                                 <div class="col-md-6 col-xl-6">
                                     <!--div class="assign_item"><a  class="assign_btn" data-toggle="modal" data-target="#exampleModal">Assign Item</a></div-->
                                     <!--h3 class="text-center">Add Location to Project</h3-->
                                      <button type="button" class="button_f" id="addLocation" data-toggle="modal" data-target="#addLocationModal">
                                      <span class="button__text">Add Location</span>
                                      <span class="button__icon">
                                        <i class="zmdi zmdi-collection-plus"></i>
                                      </span> 
                                    </button>
                                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive mt-5" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                		  <th scope="col" style="width:10%">S.no</th>
                                          <th scope="col"style="width:20%">Location Name</th>
                                          <th scope="col" style="width:10%">Location Description</th>
                                        <!-- <th scope="col" style="width:10%">Number of Location</th>
                                        --> <th scope="col" style="width:10%">Location Area</th>
                                          <th scope="col" style="width:10%">Action</th>
                                          
                                    	</tr>
                                        </thead>
                                        <tbody>
                                       	<?php
                        	    	//SELECT * FROM `inventory_transaction` WHERE 1
                        	    ///	$itemitem = $data->select('',$projectID);
                        	    	$query ="SELECT * FROM add_Location_to_project WHERE add_Location_to_project_project_id='$projectID' AND add_Location_to_project_is_visibility=1";
                        	    //	select_Query
                        	    	$itemitem = $data->select_Query(	$query);
                                         if(count((array)$itemitem) > 0){
                                        		$count = 1;
                                        		foreach($itemitem as $entry){
                                        		   // print_r($entry);
                                        		    $mainid = $entry['add_Location_to_project_id'];
                                        		    $item_id = $entry['add_Location_to_project_location_id'];
                                                //echo  $item_id;
                                        		    $itemitem = $data->select_where('location_master',$item_id);
                                             //   print_r($entry);
                                        		  
                                        		  //$item_unit = $data->select_where('item_unit',$unit_id);
                                        	  //  $quantity = $entry['add_Item_to_project_item_quantity']; <td data-label="Project"><?=$itemitem[0]['add_number_of_location'];
                                        		 ?>  <tr>
                                        		        <td data-label="S.no"><?=$count;?></td>
                                        		        <td data-label="Item Code"><?=$itemitem[0]['location_master_name'];?></td>
                                        		        <td data-label="Project"><?=$itemitem[0]['location_master_description'];?></td>
                                                  <!--  <td ><?=$entry[0]['add_number_of_location'];?></td>
                                            -->
                                        		        <td data-label="Quantity"><?=$itemitem[0]['location_master_area'];?></td>
                                        		        <td class="action">
                                                        <a id="location-edit" href='javascript:void(0)' data-mainid="<?=$mainid?>" data-area="<?=$itemitem[0]['location_master_area'];?>" onclick='editData("<?=$entry['add_Location_to_project_id'];?>")'><i class="blue  zmdi zmdi-edit"></i></a>
                                        		        <a href="javascript:void(0);" onclick='locationDelete("<?=$mainid?>")'><i class='red zmdi zmdi-delete'></i></a>
                                    		            </td>
                                        		        
                                        		    </tr>
                                        		    <?php 
                                        		    $count++;
                                        		}
                                        	}else{
                                        		echo "<tr><td colspan='4'>No record found</td></tr>";
                                        	}
                                        	?>
                                        </tbody>
                                    </table>
                                 </div>
                                 </div>
                            </div>
                            </div>
                        </div> <!-- end row -->
                     </div> <!-- container -->
                </div> <!-- content -->
            </div>
            <!-- End content-page -->
   <div class="modal fade bd-example-modal-xl" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModal" aria-hidden="true">
              <div class="modal-dialog Large modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Items to Project <span class="message"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="cmxform" id="EmissionSource_popup" method="POST" action="" novalidate="novalidate" data-parsley-validate novalidate>
                        <input type="hidden" value="<?=$projectID;?>" name="project_id" id="project_id" />
                      <fieldset>
                        <div class="field_wrapper">
                        <div class="row">
                         <div class="col-md-4">
                        <div class="form-group">
                          <label for="cname">Select Item *:</label>
                           <select class="form-control" id="exampleSelect1" parsley-trigger="change" name="itemname" required>
                               <option value="">Select Item</option>
                               <?php $entriesList = $data->select('item'); 
                                 if(count((array)$entriesList) > 0){
                                    $count = 1;
                               foreach($entriesList as $entry){?>
                            <option value="<?=$entry['item_id']?>"><?=$entry['item_code'];?></option>
                      <?php }} ?>
                          </select>
                         </div>
                        </div>
                         <div class="col-md-4">
                        <div class="form-group">
                        <label for="cemail">Item Unit:</label>
                         <select class="form-control" id="exampleSelect2" parsley-trigger="change" name="itemunit" required>
                               <option value="">Select Item</option>
                               <?php $entriesList = $data->select('item_unit'); 
                                 if(count((array)$entriesList) > 0){
                                    $count = 1;
                               foreach($entriesList as $entry){?>
                            <option value="<?=$entry['item_unit_id']?>"><?=$entry['item_unit_name'];?></option>
                      <?php }} ?>
                          </select>
                           
                        </div>
                        </div>
                        <div class="col-md-4">
                         <div class="form-group">
                          <label for="cemail">Item Quantity (<span id="item_weight">Meter</span>)</label>
                           <input class="form-control" type="text" value="" name="item_weight_in_kg" id="example-item_weight_in_kg" placeholder="Ex: 100">
                         </div>
                        </div>
                        
                        </div>
                        
                        </div><!-- field_wrapper -->
                        <input class="btn btn-primary" type="submit" name="submit" value="Save">
                      </fieldset>
                    </form>
                  </div>
                 
                </div>
              </div>
             
            </div>
<!-- Item Edit -->
 <div class="modal fade bd-example-modal-xl editItemModal" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModal" aria-hidden="true">
              <div class="modal-dialog Large modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Items to Project <span class="message"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="cmxform" id="EmissionSource_popup" method="POST" action="" novalidate="novalidate" data-parsley-validate novalidate>
                        <input type="hidden" value="<?=$projectID;?>" name="project_id" id="project_id" />
                      <fieldset>
                        <div class="field_wrapper">
                        <div class="row">
                         <div class="col-md-4">
                        <div class="form-group">
                          <label for="cname">Select Item *:</label>
                           <select class="form-control" id="exampleSelect1" parsley-trigger="change" name="itemname" required>
                               <option value="">Select Item</option>
                               <?php $entriesList = $data->select('item'); 
                                 if(count((array)$entriesList) > 0){
                                    $count = 1;
                               foreach($entriesList as $entry){?>
                            <option value="<?=$entry['item_id']?>"><?=$entry['item_code'];?></option>
                      <?php }} ?>
                          </select>
                         </div>
                        </div>
                         <div class="col-md-4">
                        <div class="form-group">
                        <label for="cemail">Item Unit:</label>
                         <select class="form-control" id="exampleSelect2" parsley-trigger="change" name="itemunit" required>
                               <option value="">Select Item</option>
                               <?php $entriesList = $data->select('item_unit'); 
                                 if(count((array)$entriesList) > 0){
                                    $count = 1;
                               foreach($entriesList as $entry){?>
                            <option value="<?=$entry['item_unit_id']?>"><?=$entry['item_unit_name'];?></option>
                      <?php }} ?>
                          </select>
                           
                        </div>
                        </div>
                        <div class="col-md-4">
                         <div class="form-group">
                          <label for="cemail">Item Quantity (<span id="item_weight">Meter</span>)</label>
                           <input class="form-control" type="text" value="" name="item_weight_in_kg" id="example-item_weight_in_kg" placeholder="Ex: 100">
                         </div>
                        </div>
                        
                        </div>
                        
                        </div><!-- field_wrapper -->
                        <input class="btn btn-primary" type="submit" name="submit" value="Save">
                      </fieldset>
                    </form>
                  </div>
                 
                </div>
              </div>
             
            </div>

<div class="modal fade bd-example-modal-xl" id="addLocationModal" tabindex="-1" role="dialog" aria-labelledby="addLocationModal" aria-hidden="true">
              <div class="modal-dialog Large modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Location to Project <span class="message"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="cmxform" id="Emissionlocation_popup" method="POST" action="" novalidate="novalidate" data-parsley-validate novalidate>
                        <input type="hidden" value="<?=$projectID;?>" name="project_id" id="project_id" />
                        <fieldset>
                        <div class="field_wrapper">
                        <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                           <label for="cname">Select Location *:</label>
                           <select class="form-control" id="location_id" parsley-trigger="change" name="locationId" required>
                               <option value="">Select Location</option>
                               <?php $entriesList = $data->select('location_master'); 
                                 if(count((array)$entriesList) > 0){
                                    $count = 1;
                               foreach($entriesList as $entry){?>
                            <option value="<?=$entry['location_master_id']?>"><?=$entry['location_master_name'];?></option>
                            <?php }} ?>
                          </select>
                         </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                        <label for="cemail" >Add Number of location</label>
                        <input class="form-control" type="text" value="" name="add_number_of_location" id="example-add_number_of_location" placeholder="Ex: 100">
                        </div>
                        </div>
                        <div class="col-md-4">
                         <div class="form-group">
                          <label for="cemail">Location Area </label>
                           <div class="lo-area" style="padding-left: 18px;">Area</div>
                         </div>
                        </div>
                        
                        </div>
                        
                        </div><!-- field_wrapper -->
                        <input class="btn btn-primary" type="submit" name="submit" value="Save">
                      </fieldset>
                    </form>
                  </div>
                 
                </div>
              </div>
             
            </div>
<!--- Edit -popup --->
 <div class="modal fade bd-example-modal-xl" id="editlocationModal" tabindex="-1" role="dialog" aria-labelledby="editItemModal" aria-hidden="true">
              <div class="modal-dialog Large modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Location to Project <span class="message"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                         <form class="cmxform" id="edit_Emissionlocation_popup" method="POST" action="" novalidate="novalidate" data-parsley-validate novalidate>
                        <input type="hidden" value="" name="location_main_id" id="location_main_id" />
                        <input type="hidden" value="<?=$projectID;?>" name="project_id" id="project_id" />
                      <fieldset>
                        <div class="field_wrapper">
                        <div class="row">
                         <div class="col-md-4">
                        <div class="form-group">
                          <label for="cname">Select Location *:</label>
                           <select class="form-control" id="location_id" parsley-trigger="change" name="locationId" required>
                               <option value="">Select Location</option>
                               <?php $entriesList = $data->select('location_master'); 
                                 if(count((array)$entriesList) > 0){
                                    $count = 1;
                               foreach($entriesList as $entry){?>
                            <option value="<?=$entry['location_master_id']?>"><?=$entry['location_master_name'];?></option>
                      <?php }} ?>
                          </select>
                         </div>
                        </div>
                         <div class="col-md-4">
                        <div class="form-group">
                        <label for="cemail" ></label>
                        <div class="locationdesc">Location Desc</div>
                        </div>
                        </div>
                        <div class="col-md-4">
                         <div class="form-group">
                          <label for="cemail">Location Area </label>
                           <input class="form-control" type="text" value="" name="location_area" id="location_area" placeholder="Ex: First Floor">
                         </div>
                        </div>
                        
                        </div>
                        
                        </div><!-- field_wrapper -->
                        <input class="btn btn-primary" type="submit" name="submit" value="Update">
                      </fieldset>
                    </form>
                  </div>
                 
                </div>
              </div>
            </div>
            
<?php require 'includes/footer_start.php' ?> 
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables/dataTables.responsive.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
  // Default Datatable
$('#responsive-datatable').DataTable();
//$('#responsivelo-datatable').DataTable();

});
// Save Data 
$(document).on('submit','#EmissionSource_popup',function(e){
e.preventDefault();
var action	= "add_items_to_project";
$.ajax({
		type: "POST",
		url: "ajax.php",
		data:$(this).serialize()+"&action="+action,
		success: function (result) {
		    console.log(result)
		 if(result==1){
		  $('.message').html('<span style="color:green;font-size:10px;">Data Save Successfully</span>'); 
		  setTimeout(function(){
		  $('#addItemModal').modal('hide');
		  window.location = 'https://thinkitdigitals.in/alpha/view-project_detail.php?view=<?=$_GET['view'];?>#addItems';
          window.location.reload();
        }, 2000);
		$('#addItemModal').modal('hide');     
		 }else{
		   $('.message').html(result);  
		 }
	   }
	});
});

// Edit Item
var editItemData = function(id){
    
   var itemQuantityt =   $('#itemEdit').data('itemQuantityt');
   var itemUnit =   $('#itemEdit').data('itemUnit');
   var itemId =   $('#itemEdit').data('itemId');
   
    $('select[name^="itemname"] option[value="'+ itemId +'"]').attr("selected","selected");
    $('select[name^="itemname"] option[value="'+ itemunit +'"]').attr("selected","selected");
    $("input[name='item_weight_in_kg']").val(itemQuantityt);
   
    $(".editItemModal").modal('show');
};

// Ajax for location add
$(document).on('submit','#Emissionlocation_popup',function(e){
e.preventDefault();
var action	= "add_location_to_project";
$.ajax({
		type: "POST",
		url: "ajax.php",
		data:$(this).serialize()+"&action="+action,
		success: function (result) {
		    console.log(result)
		 if(result==1){
		  $('.message').html('<span style="color:green;font-size:10px;">Data Save Successfully</span>'); 
		  setTimeout(function(){
		  $('#Emissionlocation_popup').modal('hide');
		  window.location = 'https://thinkitdigitals.in/alpha/view-project_detail.php?view=<?=$_GET['view'];?>#addItems';
          window.location.reload();
        }, 1000);
		$('#Emissionlocation_popup').modal('hide');     
		 }else{
		   $('.message').html(result);  
		 }
	   }
	});
});

//  Edit Popup
var editData = function(id){
   var this_dt =   $('#location-edit').data('area');
   var mainID =   $('#location-edit').data('mainid');
   
    $('select[name^="locationId"] option[value="'+ id +'"]').attr("selected","selected");
    $("input[name='location_area']").val(this_dt);
    $("input[name='location_main_id']").val(mainID);
    $("#editlocationModal").modal('show');
};
// Location Deleted
var locationDelete = function(id){
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
     var action	= "location_deleted";
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
// idem delete itemDelete
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
     var action	= "itemDeletefromProject";
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

$(document).on('submit','#edit_Emissionlocation_popup',function(e){
e.preventDefault();
var action	= "edit_popup_location_to_project";
$.ajax({
		type: "POST",
		url: "ajax.php",
		data:$(this).serialize()+"&action="+action,
		success: function (result) {
		    console.log(result)
		 if(result==1){
		  $('.message').html('<span style="color:green;font-size:10px;">Data Update Successfully</span>'); 
		  setTimeout(function(){
		  $('#editlocationModal').modal('hide');
		  window.location = 'https://thinkitdigitals.in/alpha/view-project_detail.php?view=<?=$_GET['view'];?>#addItems';
          window.location.reload();
        }, 500);
		$('#editlocationModal').modal('hide');     
		 }else{
		   $('.message').html(result);  
		 }
	   }
	});
});


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
  padding: 0 23px;
  color: #fff;
  height: 100%;
}
button#UploadItemsSheet {
    display: inline-block;
    margin-bottom:15px;
}

button#addItem {
    display: inline-block;
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
</style>

<script>
$('#location_id').on('change',function(){ 
   var optionsText = this.options[this.selectedIndex].value;
  var  action = 'get_location_desc'
   $.ajax({
		type: "POST",
		url: "ajax.php",
		data:"id="+optionsText+"&action="+action,
		dataType: 'JSON',
		success: function (result) {
		    console.log(result)
		  
		   var len = result.length;
            for(var i=0; i<len; i++){
               $('.locationdesc').html(result[i].desc);
		       $('.lo-area').html(result[i].area);
            }
		 
	   }
	});
   
  
});    
</script>
<style>
.modal-dialog.Large.modal-dialog-centered.modal-xl {
    margin-left: 22%;
}
.card-box.table-responsive {position: relative;}
label{padding: 0 1.1rem;}
div#exampleModal{z-index: 10000;}
a.add_button img {padding-top: 33px;padding-left: 27px;}
a.remove_button img {padding-top: 38px;padding-left: 27px;}
a.logo {
    visibility: hidden;
}
.projectRunMonth { display: flex;} .projectRunMonth p { padding-right: 13px;}
</style>
<?php require 'includes/footer_end.php' ?>
<!-- Model For Add item to Project--->
