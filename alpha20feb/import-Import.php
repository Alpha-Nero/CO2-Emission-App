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
<?php  $success_message = '';
 if (isset($_POST['submit']))
    {
      
         $success_message = '';
      
        $fileMimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain'
        ); 
   
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r'); 
            // Skip the first line
            $getData = fgetcsv($csvFile);	
            date_default_timezone_set("Asia/Calcutta"); 
	        $complaint_update = date('Y-m-d H:i:s');			
           $i=0; while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {             
              //print_r($getData); exit;
                $data_surce = $getData[0];
                $monthly_consumption_value = $getData[1]; 
                $e_month = $getData[2]; 
                $e_year = $getData[3]; 
                date_default_timezone_set("Asia/Calcutta"); 
	            $created_date = date('Y-m-d H:i:s');
	            
              if($data_surce=='Electricity'){
                    $insert_data = array(  
                                     'electricity_consumption'=> mysqli_real_escape_string($data->con, $monthly_consumption_value),  
                                     'electricity_month' => mysqli_real_escape_string($data->con, $e_month),  
                                     'electricity_year' =>mysqli_real_escape_string($data->con, $e_year)  ,
                                     'electricity_created_by' =>'1' ,
                                     'electricity_updated_by' =>'1',
                                     'electricity_created_on' =>$created_date,
                                     'electricity_updated_on' =>$created_date,
                                     ); 
                 $data->insert('electricity', $insert_data); 
                  
              }else if($data_surce=='Water'){
                   $insert_data = array(  
                                     'water_consumption'=> mysqli_real_escape_string($data->con, $monthly_consumption_value),  
                                     'water_month' => mysqli_real_escape_string($data->con, $e_month),  
                                     'water_year' =>mysqli_real_escape_string($data->con, $e_year)  ,
                                     'water_created_by' =>'1' ,
                                     'water_updated_by' =>'1',
                                     'water_created_on' =>$created_date,
                                     'water_updated_on' =>$created_date,
                                     ); 
                 $data->insert('water', $insert_data); 
                  
              }else if($data_surce=='Vehicle'){
                   $insert_data = array(  
                                     'vehicle_travel_consumption'=> mysqli_real_escape_string($data->con, $monthly_consumption_value),  
                                     'vehicle_travel_month' => mysqli_real_escape_string($data->con, $e_month),  
                                     'vehicle_travel_year' =>mysqli_real_escape_string($data->con, $e_year)  ,
                                     'vehicle_travel_created_by' =>'1' ,
                                     'vehicle_travel_updated_by' =>'1',
                                     'vehicle_travel_created_on' =>$created_date,
                                     'vehicle_travel_updated_on' =>$created_date,
                                     ); 
                 $data->insert('vehicle_travel', $insert_data); 
                  
              }else if($data_surce=='Employee Commute'){
       
                $insert_data = array(  
                                     'employee_commute_consumption'=> mysqli_real_escape_string($data->con, $monthly_consumption_value),  
                                     'employee_commute_month' => mysqli_real_escape_string($data->con, $e_month),  
                                     'employee_commute_year' =>mysqli_real_escape_string($data->con, $e_year)  ,
                                     'employee_commute_created_by' =>'1' ,
                                     'employee_commute_updated_by' =>'1',
                                     'employee_commute_created_on' =>$created_date,
                                     'employee_commute_updated_on' =>$created_date,
                                     ); 
                 $data->insert('employee_commute', $insert_data);                         
                  
              }else if($data_surce=='Waste Generation'){
                  
                   $insert_data = array(  
                                     'waste_generation_consumption'=> mysqli_real_escape_string($data->con, $monthly_consumption_value),  
                                     'waste_generation_month' => mysqli_real_escape_string($data->con, $e_month),  
                                     'waste_generation_year' =>mysqli_real_escape_string($data->con, $e_year)  ,
                                     'waste_generation_created_by' =>'1' ,
                                     'waste_generation_updated_by' =>'1',
                                     'waste_generation_created_on' =>$created_date,
                                     'waste_generation_updated_on' =>$created_date,
                                     ); 
                 $data->insert('waste_generation', $insert_data); 
                  
              }
            
               
                    
                  
                	$i++; 
                
                
            }
           if($insert_data)  
                      {  
                     $success_message = 'Data saved successfully!'; 
                     $rdirect_url="https://thinkitdigitals.in/alpha-nero/";
                     //header('Location: $rdirect_url');
                     echo'<script>window.location.href = "https://thinkitdigitals.in/alpha-nero/";</script>';
                      exit;
                      } 
 
         fclose($csvFile);
         
    }
    
  else
 {
  $success_message = "Please select valid file";
}

}
 ?>
 <div class="content-page">
                <div class="content">
                 <div class="container-fluid">
                <div class="row">
                <div class="col-xl-12">
                  <div class="page-title-box">
                     <h4 class="page-title float-left">Import Consumption </h4>
                     <ol class="breadcrumb float-right">
                         <li class="breadcrumb-item"><a href="#">Alpha</a></li>
                        <li class="breadcrumb-item active">Import Consumptio</li>
                    </ol>
                <div class="clearfix"></div>
              </div>
            </div>
         </div>
                        <!-- end row -->
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Import (CSV File) <span class="text-success" style="color:green; font-size:16px;"> <?php if(isset($success_message))  {   echo $success_message;}  ?>  </span></h4>
                    <form class="cmxform" id="Emissionimport" method="POST" action="#" novalidate="novalidate" enctype="multipart/form-data">
                      <fieldset>
                        <div class="row">
                        <div class="col col-md-12">
                            <div class="form-group">
                             <input type="file" class="custom-file-input" id="customFileInput" aria-describedby="customFileInput" name="file" required="">
                             </div>
                           </div>
                           </div>
                        <input class="btn btn-primary" type="submit" name='submit' value="Submit">
                      </fieldset>
                    </form>
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

<?php require 'includes/footer_end.php' ?>