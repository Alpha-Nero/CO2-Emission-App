<?php include("database.php");
include 'auth.php';
if(!empty(isset($_POST['project_Name'])) && isset($_POST['project_Name'])){
   $emailInput= $_POST['project_Name'];
   checkproject($conn, $emailInput);
}
function checkproject($conn, $projectName){
  $query = "SELECT project_name FROM  project_master WHERE project_name='$projectName'"; 
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    echo "<span style='color:red'>This Project is alredy exists </span>";
  }else{
      echo "<span style='color:green'>This Project Name Available </span>";
  }
}

if(isset($_POST['action']) && !empty($_POST['action'])) 
 {
     
$action = $_POST['action'];
if($action=='project_save')
projectAdd($conn);
// Add Datasource
if($action=='addDataSource')
add_datasource($conn);
if($action=='dataSourceDisable')
data_source_deleted($conn);
if($action=='updateDataSource')
data_source_edit($conn);
// Add DatasourceGroup
if($action=='addDataSourceGroup')
add_dataSourceGroup($conn);
if($action=='updateDataSourceGroup')
data_sourceGroup_edit($conn);
if($action=='dataSourceGroupDisable')
data_sourceGroup_deleted($conn);
if($action=='addDataSourcesubCat')
add_dataSourcesubCat($conn);


if($action=='project_update')
projectUpdate($conn);
//
if($action=='project_disable')
projectDisable($conn);
$action = $_POST['action'];
if($action=='addLocation')
add_Location($conn);
if($action=='update_location')
update_location($conn);
if($action=='add_items')
add_items($conn);
if($action=='update_item')
update_items($conn); 
//item Disable
if($action=='itemDeletemaintable')
itemDeletemaintable($conn);
if($action =='add_items_to_project') 
addItemsToProject($conn);
if($action=='edit_popup_location_to_project')
edit_locationpopup($conn);
//Deleted
if($action=='location_deleted')
location_deleted($conn);
if($action=='itemDeletefromProject')
itemDeletefromProject($conn);


if($action=='get_location_desc')
Get_locationDec($conn);
//
if($action=='add_location_to_project')
addlocationtoProject($conn);
// EmissionSource
if($action=='add_addEmissionSource')
add_addEmissionSource($conn);    
     
 }		

// add EmissionSource

function add_addEmissionSource($conn)
{

date_default_timezone_set("Asia/Calcutta"); 
$created_date = date('Y-m-d H:i:s');
$tableName ='tbl_emission_factor';
                 date_default_timezone_set("Asia/Calcutta"); 
	             $created_date = date('Y-m-d H:i:s');
                     //INSERT INTO `tbl_emission_factor`(`id`, `data_source`, `data_value`, `e_year`, `created_date`, `update_date`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
                      $insert_data = array(  
                           'data_source'=> $_POST['sourceName']?$_POST['sourceName']:'' ,
                           'data_value' =>$_POST['emission_value']?$_POST['emission_value']:'' ,
                           'e_year' =>$_POST['emission_year']?$_POST['emission_year']:'',
                           'created_date' =>$created_date,
                           'update_date' =>$created_date,
                      ); 

                   $string = "INSERT INTO ".$tableName." (";            
                   $string .= implode(",", array_keys($insert_data)) . ') VALUES (';            
                   $string .= "'" . implode("','", array_values($insert_data)) . "')"; 
              // print_r($string);
                   if(mysqli_query($conn, $string))  
                   {   //$t=1;
                        echo '1';  
                   }  
                   else  
                   {  
                      echo  "Error: " . $sql . "<br>" . mysqli_error($db);
                   }      
    
}

function projectAdd($conn)
{
//echo 'sss';    
 $tableName ='project_master';
date_default_timezone_set("Asia/Calcutta"); 
$created_date = date('Y-m-d H:i:s');
$insert_data = array(  
'project_name'=> $_POST['project_name']?$_POST['project_name']:'', 
 'project_master_description'=>$_POST['description']?$_POST['description']:'Demo',
 'project_master_location_id'=>'0',
                           'project_master_start_date' =>$_POST['start_date']?$_POST['start_date']:'2023-05-30', 
                           'project_master_end_date' =>$_POST['end_date']?$_POST['end_date']:'2023-05-30',
                           'project_master_is_visibility'=>'1',
                           'project_master_status'=>'0',
                           'project_created_on' =>$created_date,
                           'project_updated_on' =>$created_date,
                           'project_created_by' =>'1',
                           'project_updated_by' =>'1',
                      ); 
               
                   $string = "INSERT INTO ".$tableName." (";            
                   $string .= implode(",", array_keys($insert_data)) . ') VALUES (';            
                   $string .= "'" . implode("','", array_values($insert_data)) . "')"; 
              // print_r($string);
                   if(mysqli_query($conn, $string))  
                   {   //$t=1;
                        echo '1';  
                   }  
                   else  
                   {  
                      echo  "Error: " . $sql . "<br>" . mysqli_error($db);
                   }      
    
}

//project Updates
function projectUpdate($conn)
{ 
   $tableName ='project_master';
                  date_default_timezone_set("Asia/Calcutta"); 
	              $created_date = date('Y-m-d H:i:s');
	              $id = $_POST['project_id']?$_POST['project_id']:'';
                 // $project_name = $_POST['project_name']?$_POST['project_name']:'';
                  $locationName = $_POST['locationName']?$_POST['locationName']:'';
                  $start_date = $_POST['start_date']?$_POST['start_date']:'0000-00-00';
                  $end_date = $_POST['end_date']?$_POST['end_date']:'0000-00-00';
                  $description = $_POST['description']?$_POST['description']:'';
                  $project_master_updated_on = $created_date;
                  $project_master_updated_by ='1';
                  $sql = "update project_master set 
                      project_master_description='$description',
                      project_master_location_id='$locationName',
                      project_master_start_date='$start_date',
                      project_master_end_date='$end_date',
                      project_updated_on='$created_date',
                      project_updated_by=$project_master_updated_by
                     where 	project_master_id=$id";
                   // echo $sql;
                  $result = mysqli_query($conn,  $sql);  
                   if($result){
                   echo '1'; 
                   }else{
                         echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
                   } 
}
//
function projectDisable($conn){
                 $tableName ='project_master';
	              $id = $_POST['id']?$_POST['id']:'';
                  $sql = "update project_master set 
                      project_master_is_visibility = '0'
                     where 	project_master_id=$id";
                   // echo $sql;
                  $result = mysqli_query($conn,  $sql);  
                   if($result){
                   echo '1'; 
                   }else{
                         echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
                   } 
}
// Add Location
function add_Location($conn)
{
   
 $tableName ='location_master';
                  date_default_timezone_set("Asia/Calcutta"); 
	              $created_date = date('Y-m-d H:i:s');
                      $insert_data = array(  
                           'location_master_name'=> $_POST['addLocation']?$_POST['addLocation']:'', 
                           'location_master_area'=>$_POST['loccation_area']?$_POST['loccation_area']:'',
                           'location_master_description'=>$_POST['loccation_description']?$_POST['loccation_description']:'',
                           'location_master_created_on' =>$created_date,
                           'location_master_updated_on' =>$created_date,
                           'location_master_created_by' =>'1',
                           'location_master_updated_by' =>'1',
                      ); 
               
                   $string = "INSERT INTO ".$tableName." (";            
                   $string .= implode(",", array_keys($insert_data)) . ') VALUES (';            
                   $string .= "'" . implode("','", array_values($insert_data)) . "')"; 
             
                   if(mysqli_query($conn, $string))  
                   {   
                        echo '1';  
                   }  
                   else  
                   {  
                      echo  "Error: " . $sql . "<br>" . mysqli_error($db);
                   }      
    
}
// update Location
function update_location($conn)
{
                  $tableName ='location_master';
                  date_default_timezone_set("Asia/Calcutta"); 
	              $created_date = date('Y-m-d H:i:s');
                  $location_master_name = $_POST['addLocation']?$_POST['addLocation']:'';
                  $location_master_area = $_POST['loccation_area']?$_POST['loccation_area']:'';
                  $location_master_description = $_POST['loccation_description']?$_POST['loccation_description']:'';
                  $edit = $_POST['update']?$_POST['update']:'';
                  $location_master_updated_on = $created_date;
                  $location_master_updated_by ='1';
                  $isVisibles  = $_POST['isVisible'];
                  //echo $is_visible; 
                 // print_r($_POST['isVisible']);
                  $is_id = $_POST['id']?$_POST['id']:'';
                  if($_POST['isVisible']=='0'){
                      $sql = "update location_master set 
                            location_master_is_visibility= $isVisibles
                     where location_master_id=$is_id";
                  }else{
                  $sql = "update location_master set 
                      location_master_name='$location_master_name', 
                      location_master_area='$location_master_area',
                      location_master_description='$location_master_description',
                      location_master_updated_on='$location_master_updated_on',
                      location_master_updated_by=$location_master_updated_by
                     where location_master_id=$edit";
                    }
                   // echo $sql;
                  $result = mysqli_query($conn,  $sql);  
                   if($result){
                   echo '1'; 
                   }else{
                         echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
                   }
}


// add Items
function add_items($conn)
{
 $tableName ='item';
                  date_default_timezone_set("Asia/Calcutta"); 
	              $created_date = date('Y-m-d H:i:s');
                      $insert_data = array(  
                           'item_code'=> $_POST['item_code']?$_POST['item_code']:'', 
                           'item_description'=>$_POST['item_description']?$_POST['item_description']:'',
                           'item_unit' =>$_POST['item_unit']?$_POST['item_unit']:'',
                           'item_emission_factor' =>$_POST['item_emission_factor']?$_POST['item_emission_factor']:'',
                           'ideal_emission_factor' =>$_POST['ideal_emission_factor']?$_POST['ideal_emission_factor']:'',
                           'item_material_detail' =>$_POST['item_material_detail']?$_POST['item_material_detail']:'',
                           'item_is_visibility' =>'1',
                           'item_created_by' =>'1',
                           'item_updated_by' =>'1',
                           'item_created_on' =>$created_date,
                           'item_updated_on' =>$created_date,
                          
                      ); 
               
                   $string = "INSERT INTO ".$tableName." (";            
                   $string .= implode(",", array_keys($insert_data)) . ') VALUES (';            
                   $string .= "'" . implode("','", array_values($insert_data)) . "')"; 
          // echo $string;
                   if(mysqli_query($conn, $string))  
                   { 
                        echo '1';  
                   }  
                   else  
                   {  
                      echo  "Error: " . $sql . "<br>" . mysqli_error($db);
                   }      
    
}
//Update Items
function update_items($conn)
{
   
                  date_default_timezone_set("Asia/Calcutta"); 
	              $created_date = date('Y-m-d H:i:s');
                  $item_code = $_POST['item_code']?$_POST['item_code']:'';
                  $item_unit = $_POST['item_unit']?$_POST['item_unit']:'';
                  $item_material_detail = $_POST['item_material_detail']?$_POST['item_material_detail']:'';
                  $item_emission_factor = $_POST['item_emission_factor']?$_POST['item_emission_factor']:'';
                  $ideal_emission_factor = $_POST['ideal_emission_factor']?$_POST['ideal_emission_factor']:'';
                  $item_description = $_POST['item_description']?$_POST['item_description']:'';
                 // $item_weight_in_kg =$_POST['item_weight_in_kg']?$_POST['item_weight_in_kg']:'';
                  $edit = $_POST['update']?$_POST['update']:'';
                  $item_updated_on = $created_date;
                  $item_updated_by ='1';
                  $sql = "update item set 
                      item_code='$item_code', 
                      item_unit='$item_unit',
                      item_description='$item_description',
                      item_emission_factor=$item_emission_factor,
                      ideal_emission_factor=$ideal_emission_factor,
                      item_material_detail='$item_material_detail',
                      item_updated_on='$item_updated_on',
                      item_updated_by=$item_updated_by
                     where item_id=$edit";
                   // echo $sql;
                  $result = mysqli_query($conn,  $sql);  
                   if($result){
                   echo '1'; 
                   }else{
                         echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
                   }
}
// ItemDisable
function itemDeletemaintable($conn){
        $created_date = date('Y-m-d H:i:s');
                  
                  $id = $_POST['id']?$_POST['id']:'';
                  $item_updated_on = $created_date;
                if($id!=null){
                  $sql = "update item set 
                      item_is_visibility='0',
                      item_updated_on='$item_updated_on'
                     where item_id=$id";
                  
                  $result = mysqli_query($conn,  $sql);  
                   if($result){
                   echo '1'; 
                   }else{
                         echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
                   }}else{
                       echo 'Something Wrong!';
                   }
}

// Add item to Project
function addItemsToProject($conn)
{

 // echo 
  $project_id =$_POST['project_id'];
  $item_id=$_POST['itemname'];
  $sql_check="Select * From add_item_to_project where add_Item_to_project_assign_id=$project_id and add_Item_to_project_item_id=$item_id";
  $result_check=mysqli_query($conn,$sql_check);
  if ($result_check->num_rows === 0){
  $tableName ='add_Item_to_project';
  date_default_timezone_set("Asia/Calcutta"); 
  $created_date = date('Y-m-d H:i:s');
  $insert_data = array(  
            'add_Item_to_project_assign_id'=> $_POST['project_id']?$_POST['project_id']:'', 
            'add_Item_to_project_item_id'=>$_POST['itemname']?$_POST['itemname']:'',
            'add_Item_to_project_item_unit_id' =>$_POST['itemunit']?$_POST['itemunit']:'',
            'add_Item_to_project_item_quantity' =>$_POST['item_weight_in_kg']?$_POST['item_weight_in_kg']:'',
            'add_Item_to_project_created_by' =>'1',
            'add_Item_to_project_updated_by' =>'1',
            'add_Item_to_project_created_on' =>$created_date,
            'add_Item_to_project_updated_on' =>$created_date,
             ); 
        $string = "INSERT INTO ".$tableName." (";            
        $string .= implode(",", array_keys($insert_data)) . ') VALUES (';            
        $string .= "'" . implode("','", array_values($insert_data)) . "')"; 
       // echo $string;
        if(mysqli_query($conn, $string))  
        { 
          echo '1';  
        }  
        else  
        {  
         echo  "Error: " . $sql . "<br>" . mysqli_error($db);
        }      
      }else {
        echo "<p><strong><small><span style='color: red;'> * Item is already added *</span></small></strong></p>";
      }
}
function itemDeletefromProject($conn){
    $tableName ='add_Item_to_project';
     $id= $_POST['id']?$_POST['id']:'';
    $sql = "update add_Item_to_project set 
         add_Item_to_project_is_visibility='0'
         where add_Item_to_project_id=$id";
   
        $result = mysqli_query($conn,  $sql);  
        if($result){
          echo '1'; 
          }else{
          echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
         }

}
// Add location
function addlocationtoProject($conn){
  $tableName ='add_Location_to_project';
  date_default_timezone_set("Asia/Calcutta"); 
  $created_date = date('Y-m-d H:i:s');
  $insert_data = array(  
            'add_Location_to_project_project_id'=> $_POST['project_id']?$_POST['project_id']:'', 
            'add_Location_to_project_location_id'=>$_POST['locationId']?$_POST['locationId']:'',
            'add_number_of_location'=>$_POST['add_number_of_location']?$_POST['add_number_of_location']:'',
           // 'add_Location_to_project_location_area' =>$_POST['location_area']?$_POST['location_area']:'',
            'add_Location_to_project_created_by' =>'1',
            'add_Location_to_project_updated_by' =>'1',
            'add_Location_to_project_created_on' =>$created_date,
            'add_Location_to_project_updated_on' =>$created_date,
             ); 
        $string = "INSERT INTO ".$tableName." (";            
        $string .= implode(",", array_keys($insert_data)) . ') VALUES (';            
        $string .= "'" . implode("','", array_values($insert_data)) . "')"; 
       // echo $string;
        if(mysqli_query($conn, $string))  
        { 
          echo '1';  
        }  
        else  
        {  
         echo  "Error: " . $sql . "<br>" . mysqli_error($db);
        } 
} 
// update Location
function edit_locationpopup($conn){
 date_default_timezone_set("Asia/Calcutta"); 
$created_date = date('Y-m-d H:i:s');
$projectId = $_POST['project_id']?$_POST['project_id']:'';
$location_main_id = $_POST['location_main_id']?$_POST['location_main_id']:'';
$add_number_of_location = $_POST['add_number_of_location']?$_POST['add_number_of_location']:'';
//$location_area = $_POST['location_area']?$_POST['location_area']:''; ///// add_Location_to_project_location_area='$location_area',
$item_updated_on = $created_date;
$item_updated_by ='1';
 $sql = "update add_Location_to_project set 
         add_Location_to_project_project_id='$projectId', 
         add_Location_to_project_location_id='$location_main_id',
         add_number_of_location='$add_number_of_location',
        
         add_Location_to_project_updated_on='$item_updated_on',
         add_Location_to_project_updated_by='$item_updated_by'
         where $location_main_id";
       
        $result = mysqli_query($conn,  $sql);  
        if($result){
          echo '1'; 
          }else{
          echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
         }


}
//Select Location Desc
// Add item to Project
function Get_locationDec($conn)
{
  //  echo 'fg';
 $table_name ='location_master';
 $id= $_POST['id']?$_POST['id']:'';
 $query = "SELECT * FROM ".$table_name." where ".$table_name.'_'."id=".$id." order by ".$table_name.'_'."id desc";  
 $result = mysqli_query($conn, $query); 
 $row = mysqli_fetch_assoc($result);
   $data[]= array(
                'desc'=> $row['location_master_description'],
                'area'=> $row['location_master_area']
   );
  echo json_encode($data) ;  
}
// All Deleted Functions

function location_deleted($conn){
   $add_Location_to_projectid = $_POST['id']?$_POST['id']:''; 
   $sql = "update add_Location_to_project set 
          add_Location_to_project_is_visibility='0'
         where add_Location_to_project_id='$add_Location_to_projectid'";
 
    $result = mysqli_query($conn,  $sql);  
        if($result){
          echo '1'; 
          }else{
          echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
         }
}

// Add Datasource
 function add_datasource($conn){
  $tableName ='data_source';
  date_default_timezone_set("Asia/Calcutta"); 
  $created_date = date('Y-m-d H:i:s');
  $insert_data = array(  
            //'add_Location_to_project_project_id'=> $_POST['project_id']?$_POST['project_id']:'', 
            'data_source_name'=>$_POST['datasource']?$_POST['datasource']:'',
            'data_source_units' =>'',
             'is_visibility'=>1
             ); 
        $string = "INSERT INTO ".$tableName." (";            
        $string .= implode(",", array_keys($insert_data)) . ') VALUES (';            
        $string .= "'" . implode("','", array_values($insert_data)) . "')"; 
     
        if(mysqli_query($conn, $string))  
        { 
          echo '1';  
        }  
        else  
        {  
         echo  "Error: " . $sql . "<br>" . mysqli_error($db);
        }   
 }
 function data_source_edit($conn){
   $data_source_id = $_POST['update']?$_POST['update']:''; 
    $data_datasource = $_POST['datasource']?$_POST['datasource']:''; 
  
   $sql = "update  data_source set 
           data_source_name='$data_datasource'
         where  data_source_id='$data_source_id'";
    $result = mysqli_query($conn,  $sql);  
        if($result){
          echo '1'; 
          }else{
          echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
         }
}

 function data_source_deleted($conn){
   $data_source_id = $_POST['id']?$_POST['id']:''; 
  
   $sql = "update  data_source set 
          is_visibility='0'
         where  data_source_id='$data_source_id'";
    $result = mysqli_query($conn,  $sql);  
        if($result){
          echo '1'; 
          }else{
          echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
         }
}
// Datasource Group

 function add_dataSourceGroup($conn){
  $tableName ='data_source_group';
  date_default_timezone_set("Asia/Calcutta"); 
  $created_date = date('Y-m-d H:i:s');
  $insert_data = array(  
            //'add_Location_to_project_project_id'=> $_POST['project_id']?$_POST['project_id']:'', 
            'data_source_id'=>$_POST['data_source_id']?$_POST['data_source_id']:'',
            'data_source_group_name'=>$_POST['DataSourceGroup']?$_POST['DataSourceGroup']:'',
             'is_visibility'=>1
             ); 
        $string = "INSERT INTO ".$tableName." (";            
        $string .= implode(",", array_keys($insert_data)) . ') VALUES (';            
        $string .= "'" . implode("','", array_values($insert_data)) . "')"; 
     
        if(mysqli_query($conn, $string))  
        { 
          echo '1';  
        }  
        else  
        {  
         echo  "Error: " . $sql . "<br>" . mysqli_error($db);
        }   
 }
 function data_sourceGroup_edit($conn){
   $data_source_group_id = $_POST['update']?$_POST['update']:''; 
   $DataSourceGroup = $_POST['DataSourceGroup']?$_POST['DataSourceGroup']:''; 
  
   $sql = "update  data_source_group set 
           data_source_group_name='$DataSourceGroup'
         where  data_source_group_id='$data_source_group_id'";
    $result = mysqli_query($conn,  $sql);  
        if($result){
          echo '1'; 
          }else{
          echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
         }
}

 function data_sourceGroup_deleted($conn){
   $data_source_group_id = $_POST['id']?$_POST['id']:''; 
  
   $sql = "update  data_source_group set 
          is_visibility='0'
         where data_source_group_id='$data_source_group_id'";
    $result = mysqli_query($conn,  $sql);  
        if($result){
          echo '1'; 
          }else{
          echo  "Error: " . $sql . "<br>" . mysqli_error($db); 
         }
}
// Sub Cat
//echo $_POST['is_reduction'];


function add_dataSourcesubCat($conn){
  
  $tableName ='data_source_subcategory';
  date_default_timezone_set("Asia/Calcutta"); 
  $created_date = date('Y-m-d H:i:s');

//  $is_reduction=$_POST['is_reduction']?'yes':'no';
 
  $insert_data = array(  
            //'add_Location_to_project_project_id'=> $_POST['project_id']?$_POST['project_id']:'', 
             'data_source_id'=>$_POST['data_source_id']?$_POST['data_source_id']:'',
             'data_source_group_id'=>$_POST['data_source_group_id']?$_POST['data_source_group_id']:'',
             'data_source_subcategory_name'=>$_POST['DataSourceGroup']?$_POST['DataSourceGroup']:'', 
             'data_source_subcategory_unit'=>$_POST['data_source_subcategory_unit']?$_POST['data_source_subcategory_unit']:'',
             'is_visibility'=>1,
             'is_reduction'=>isset($_POST['is_reduction']) ? $_POST['is_reduction'] : 'no',

             ); 
        $string = "INSERT INTO ".$tableName." (";            
        $string .= implode(",", array_keys($insert_data)) . ') VALUES (';            
        $string .= "'" . implode("','", array_values($insert_data)) . "')"; 
 //    echo $string;
        if(mysqli_query($conn, $string))  
        { 
          echo '1';  
        }  
        else  
        {  
         echo  "Error: " . $sql . "<br>" . mysqli_error($db);
        }   
 }

?>