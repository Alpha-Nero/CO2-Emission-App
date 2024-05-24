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
      $tableName ='tbl_emission_factor'; 
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
                                    <h4 class="page-title float-left">All Emission Factor </h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="#">Alpha</a></li>
                                        <li class="breadcrumb-item active">All Emission Factor</li>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Emission Factor Values</h4>
                    
                   
                   <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
            		<tr>
            		<th style="width:1%">Sr. No.</th>
            		<th>Data Source</th>
            		<th>Emission Factor</th>
            		<th>Year</th>
                	</tr>
                    </thead>
                    <tbody>
    	    	<?php
            	$query ="SELECT * FROM tbl_emission_factor ORDER BY e_year DESC"; 
                $entriesList = $data->select_Query($query); 
                     if(count($entriesList) > 0){
                    		$count = 1;
                    		foreach($entriesList as $entry){
                    		    $id = $entry['id'];
                    		    $name = $entry['data_source'];
                    		    $data_value = $entry['data_value'];
                    		    $e_year = $entry['e_year'];
                    		    echo "<tr>
                    		    	<td>".$count."</td>
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
<style>
i.blue {font-size: 18px;}
.red {font-size: 18px;color: red;}
</style>
<script>
$(document).ready(function() {
  // Default Datatable
 $('#responsive-datatable').DataTable();
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

