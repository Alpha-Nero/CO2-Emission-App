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
                <div class="content">
                 <div class="container-fluid">
                <div class="row">
                <div class="col-xl-12">
                  <div class="page-title-box">
                     <h4 class="page-title float-left">Monthly Data Source Consumption</h4>
                     <ol class="breadcrumb float-right">
                         <li class="breadcrumb-item"><a href="#">Alpha</a></li>
                        <li class="breadcrumb-item active">Monthly Data Source Consumption</li>
                    </ol>
                <div class="clearfix"></div>
              </div>
            </div>
         </div>                        <!-- end row -->
           <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                      <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                        <?php $m=$_GET['month'];$y= $_GET['years']; 
                                         $electricityQuery = "SELECT DISTINCT(el.electricity_month) AS month , el.electricity_year AS Years,'Electricity' AS ds, el.electricity_consumption AS consumption FROM `electricity` AS el Where el.electricity_month='$m'AND el.electricity_year='$y'";
                                         $el_results = $data->select_Query($electricityQuery);
                                        // Water
                                        $waterQuery = "SELECT DISTINCT(wa.water_month) AS month , wa.water_year AS Years,'Water' AS ds, wa.water_consumption AS consumption FROM `water` AS wa Where wa.water_month='$m'AND wa.water_year='$y'";
                                        $wa_results = $data->select_Query($waterQuery);
                                       
                                        // waste
                                        $wgQuery = "SELECT DISTINCT(wg.waste_generation_month) AS month , 'Waste' AS ds, wg.waste_generation_year AS Years,wg.waste_generation_consumption AS consumption FROM `waste_generation` AS wg Where wg.waste_generation_month='$m'AND wg.waste_generation_year='$y'";
                                        $wg_results = $data->select_Query($wgQuery);
                                        // fuel
                                        $fuelQuery = "SELECT DISTINCT(f.fuel_month) AS month , f.fuel_year AS Years,'Fuel' AS ds,f.fuel_consumption AS consumption FROM `fuel` AS f Where f.fuel_month='$m'AND f.fuel_year='$y'";
                                        $f_results = $data->select_Query($fuelQuery);
                                        //
                                        $vtQuery = "SELECT DISTINCT(vt.vehicle_travel_month) AS month , 'Vehicle' AS ds, vt.vehicle_travel_year AS Years,vt.vehicle_travel_consumption AS consumption FROM `vehicle_travel` AS vt Where vt.vehicle_travel_month='$m'AND vt.vehicle_travel_year='$y'";
                                        $V_results = $data->select_Query($vtQuery);
                                        
                                        $input = array_merge($el_results,$wa_results,$wg_results,$f_results,$V_results);
                                       
                                        ?>
                                      
                    <!--div class="tab nav with-arrow lined flex-column flex-sm-row text-center">
                     <?php foreach($input as $inp){?>    
                      <a class="tablinks nav-link active flex-sm-fill" onclick="openProductTab(event, '<?=$inp['ds'];?>')" id="defaultOpen"><?=$inp['ds'];?></a>
                      <?php }?>
                     
                    </div-->
                     <?php $sum = 0; foreach($input as $inp){
                       
                     ?>
                    <!--div id="<?=$inp['ds'];?>" class="tabcontent" style="display:block;">
                    <?php  $dy =$inp['Years'];
                     $dsname = $inp['ds'];
                     $dsc = $inp['consumption'];
                     $emQuery = "SELECT  `data_source`, `data_value`, `e_year` FROM `tbl_emission_factor` WHERE `e_year`='$dy' AND data_source='$dsname'";
                    // echo $emQuery;
                     $emfresults = $data->select_Query($emQuery);
                     //print_r($emfresults);
                     $dsv = $emfresults[0]['data_value'];
                     $consumption = (float)($inp['consumption']* $dsv);  $sum += $consumption; ?>    
                     <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive" cellspacing="0" width="100%">
                                       <thead>
                                        <tr>
                                		<th style="width:20%">Data Source</th>
                                		<th style="width:15%">Month</th>
                                		<th style="width:15%">Year</th>
                                		<th style="width:22%">Consumption</th>
                                		<th style="width:22%">Consumption With Emission Fraction</th>
                                    	</tr>
                                      </thead>
                                    <tbody>
                                       <tr><td><?=$inp['ds'];?></td>
                                        <td><?=$inp['month'];?></td>
                                         <td><?=$inp['Years'];?></td>
                                         <td><?=$inp['consumption'];?></td>
                                          <td><?=$consumption;?></td>
                                         </tr>
                                      </tbody>
                            </table>
                    </div-->
                    <?php }?>
                    
                        <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive" cellspacing="0" width="100%">
                                       <thead>
                                        <tr>
                                		<th style="width:20%">Data Source</th>
                                		<th style="width:15%">Month</th>
                                		<th style="width:15%">Year</th>
                                		<th style="width:22%">Consumption</th>
                                		<th style="width:22%">Consumption With Emission Fraction</th>
                                    	</tr>
                                      </thead>
                                    <tbody>
                       <?php $sum = 0; foreach($input as $inp){                 
                        $dy =$inp['Years'];
                     $dsname = $inp['ds'];
                     $dsc = $inp['consumption'];
                     $emQuery = "SELECT  `data_source`, `data_value`, `e_year` FROM `tbl_emission_factor` WHERE `e_year`='$dy' AND data_source='$dsname'";
                    // echo $emQuery;
                     $emfresults = $data->select_Query($emQuery);
                     //print_r($emfresults);
                     $dsv = $emfresults[0]['data_value'];
                     $consumption = (float)($inp['consumption']* $dsv);  $sum += $consumption; ?>
                                        <tr><td><?=$inp['ds'];?></td>
                                        <td><?=$inp['month'];?></td>
                                         <td><?=$inp['Years'];?></td>
                                         <td><?=$inp['consumption'];?></td>
                                          <td><?=$consumption;?></td>
                                         </tr>
                                         <? }?>
                                      </tbody>
                                      <tfoot align="right">
                                		<tr><th>
                                		</th><th>
                                		</th><th>
                                		</th><th>
                                		<th>Total: <?php echo  $sum;?></th>
                                	  </tr>
                                	</tfoot>
                            </table>
                    
                   
                    
                          </div>
                       </div>
                     </div>
                 </div>
              </div>
            </div>
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
<style>
.lined .nav-link.active {
    background: none;
    color: #333;
    font-weight: 500;
    border-color: #084786;
}
.with-arrow .nav-link.active {
    position: relative;
}
.lined .nav-link {
    border: none;
    border-bottom: 3px solid transparent;
    color: #084688;
    font-weight: 500;
    cursor: pointer;
}
.tab {
    border-bottom: 1px solid #08478426;
    margin-left: 0;
    margin-bottom:50px
}
.with-arrow .nav-link.active::after {
    content: '';
    border-left: 12px solid transparent;
    border-right: 12px solid transparent;
    border-top: 12px solid #084786;
    position: absolute;
    bottom: -12px;
    left: 50%;
    transform: translateX(-50%);
    display: block;
}
.lined .nav-link a {
    border: none;
    border-bottom: 3px solid transparent;
    color: #084688;
    font-weight: 500;
    cursor: pointer;
}
    
</style>
<script>
function openProductTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>
<?php require 'includes/footer_end.php' ?>