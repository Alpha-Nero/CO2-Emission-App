<?php
include 'auth.php';
include('../layout/header.php');
$tableName = "tbl_monthly_consumption";
$tablename_emission ="tbl_emission_factor";
?> 
  <div class="main-panel">
      <div class="content-wrapper">
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
            
            	$data_surce = $getData[0];
                $monthly_consumption_value = $getData[1]; 
                $e_month = $getData[2]; 
                $e_year = $getData[3]; 
                date_default_timezone_set("Asia/Calcutta"); 
	            $created_date = date('Y-m-d H:i:s');
                $insert_data = array(  
                                     'data_source'=> mysqli_real_escape_string($data->con, $data_surce),  
                                     'monthly_consumption_value' => mysqli_real_escape_string($data->con, $monthly_consumption_value),  
                                     'e_month' =>mysqli_real_escape_string($data->con, $e_month)  ,
                                     'e_year' =>mysqli_real_escape_string($data->con, $e_year) ,
                                     'created_date' =>$created_date,
                                     'update_date' =>$created_date,
                                     );  
                    
                      if($data->insert($tableName, $insert_data))  
                      {  
                           $success_message = 'Data saved successfully!';  
                      }else{
                          $success_message = '<span style="color:red;">Have Some Issue Please Contact To Supports Team!</span>';  
                      } 
                	$i++; 
                
                
            }
       
 
         fclose($csvFile);
         
    }
    
  else
 {
  $success_message = "Please select valid file";
}

}
 ?>
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
         
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
                   <div class="card-detail card-body">
           <h3>Consumption & Emission By Data Sources</h3>
    <table id="example" class="table table-striped bootstrap4 table-bordered"  cellspacing="0" width="100%">
        <thead>
		<tr>
		<th style="width:1%">Sr. No.</th>
		<th>Data Source</th>
		<th>Month of Year</th>
		<th>Consumption</th>
		<th>Emission</th>
		<!--th>Action</th-->
	</tr>
        </thead>
        <tbody>
		<?php
	// Select records
	$entriesList =  $data->select($tableName); ;
	if(count($entriesList) > 0){
		$count = 1;
		foreach($entriesList as $entry){
		    $id = $entry['id'];
		    $name = $entry['data_source'];
		    $e_year = $entry['e_year'];
		    $where = "data_source='$name' AND e_year=$e_year";
		    $results = $data->select_where($tablename_emission,$where);
		    $data_value = $entry['monthly_consumption_value'];
		    $e_month = $entry['e_month'];
		    $emission_value= $data_value*$results[0]['data_value'];            
		    echo "<tr>
		    	<td>".$count."</td>
		    	<td>".$name."</td>
		    	<td>".$e_month.' '.$e_year."</td>
		    	<td>".$data_value."</td>
		    	<td>".$emission_value."</td>
		    	<!--td><a href='?page=allentries&delid=".$id."'>Delete</a></td-->
		    </tr>
		    ";
		    $count++;
		}
	}else{
		echo "<tr><td colspan='5'>No record found</td></tr>";
	}
	

	?>
        </tbody>
    </table>
                  </div>
                </div>
              </div>
            </div>
          
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © Alpha Nero 2023</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Created By <a href="https://yantrikas.com/" target="_blank">Yantrikas Technologies</a></span>
            </div>
          </footer>
          
        </div>
      
      </div>
     
    </div>
<?php include "../layout/footer.php";?>