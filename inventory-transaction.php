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
            // print_r($getData);exit;
                $ItemCode = $getData[0];
                $date = $getData[1]; 
                $tran_account = $getData[2]; 
                $Project_name = $getData[3]; 
                $Quantity=$getData[4];
               
                date_default_timezone_set("Asia/Calcutta"); 
	            $created_date = date('Y-m-d H:i:s');
	            $where =$Project_name;
	            $entriesList = $data->select_where('project_master',$where);
              if($Project_name == $entriesList[0]['project_name']){
                   $insert_data = array(  
                                     'inventory_transaction_item_code'=> $ItemCode,  
                                     'inventory_transaction_date' => $date,  
                                     'inventory_transaction_tran_account' =>$tran_account,
                                     'inventory_transaction_project' =>$Project_name,
                                     'inventory_transaction_quantity' =>$Quantity,
                                     'inventory_transaction_audit_no' =>'',
                                      'inventory_transaction_updated_by' =>'1',
                                     'inventory_transaction_created_by' =>'1',
                                     'inventory_transaction_created_on' =>$created_date,
                                     'inventory_transaction_updated_on' =>$created_date,
                                     ); 
                                     
                                     // 
                    $query="Select item_id,item_code from item where item_code='$ItemCode' order by item_id desc"; 
                   
                    $q_item = $data->select_Query($query);
                    
                    if($q_item[0]['item_code']==$ItemCode)
                    {                
                $p_assign_item= array(
                                'add_Item_to_project_assign_id'=>$entriesList[0]['project_master_id'],
                                'add_Item_to_project_item_id'=>$q_item[0]['item_id'],
                                'add_Item_to_project_item_unit_id'=>'-1',
                                'add_Item_to_project_item_quantity'=>$Quantity,
                                'add_Item_to_project_created_by'=>1,
                                'add_Item_to_project_updated_by'=>1,
                                'add_Item_to_project_created_on'=>$created_date,
                                'add_Item_to_project_updated_on'=>$created_date,
                                'add_Item_to_project_is_visibility'=>1,
                                      );
                    }  
                   // print_r($p_assign_item);
           //  echo $ItemCode;exit ;
               $insertdatasuccess=  $data->insert('inventory_transaction', $insert_data); 
                 $data->insert('add_Item_to_project', $p_assign_item);
                  
              }
           
            
            
              
                  
                	$i++; 
                
                
            }
           if($insertdatasuccess)  
                      {  
                     $success_message = 'Data saved successfully!'; 
                     $rdirect_url="https://thinkitdigitals.in/alpha1";
                     header('Location: https://thinkitdigitals.in/alpha1/add-project.php');
                     //echo'<script>';
                      //exit;
                      }else{ echo 'Something Wrong !';} 
 
         fclose($csvFile);
         
    }
    
  else
 {
  $success_message = "Please select valid file";
}

}
 ?>
 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                   <h4 class="page-title float-left">Inventory Transaction</h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="#">Alpha</a></li>
                                        <li class="breadcrumb-item active">Inventory Transaction</li>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                        
         
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card-box">
                  <div class="card-body">
                    <h4 class="card-title">Import Inventory Transaction(CSV File) <span class="text-success" style="color:green; font-size:16px;"> <?php if(isset($success_message))  {   echo $success_message;}  ?>  </span></h4>
                    <form class="cmxform" id="Emissionimport" method="POST" action="#" novalidate="novalidate" enctype="multipart/form-data">
                      <fieldset>
                        <div class="row">
                        <div class="col col-md-12">
                            <div class="form-group">
                                
                             <input type="file" class="dropify" data-max-file-size="1M"  id="customFileInput" aria-describedby="customFileInput" name="file" required="">
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