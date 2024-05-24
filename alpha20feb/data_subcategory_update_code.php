<?php
include 'auth.php';
include 'database.php';
if(isset($_POST['submit'])){

    $data_source_subcategory_name=$_POST['data_source_subcategory_name'];
    $data_source_subcategory_unit=$_POST['data_source_subcategory_unit'];
    $data_source_subcategory_unit2=$_POST['data_source_subcategory_unit2'];
    $data_source_subcategory_id=$_POST['data_source_subcategory_id'];

    $data_source_id=$_POST['data_source_id'];
    $data_source_group_id=$_POST['data_source_group_id'];
    $reduction = isset($_POST['reduction']) ? $_POST['reduction'] : 'no';

    

    // echo $data_source_id;
    // echo $data_source_group_id;
    // echo $data_source_subcategory_id;
    // echo $data_source_subcategory_unit;
    // echo $data_source_subcategory_name;
  //  for($i=0; $i<count($_POST['data_source_name']); $i++){
    
    $sql= "update data_source_subcategory set  data_source_group_id='$data_source_group_id' , data_source_subcategory_name='$data_source_subcategory_name', data_source_subcategory_unit='$data_source_subcategory_unit', data_source_subcategory_unit2='$data_source_subcategory_unit2', is_reduction='$reduction'  where data_source_subcategory_id='$data_source_subcategory_id'";
    // echo $sql;
    
        $result=mysqli_query($conn, $sql);
    
        if($result){
    
          $update="Data Updated Successfully";
            header('location: datasubcategory.php?update='.$update);
          // header('location: datasubcategory.php');
    
        }
    
        else{
    
           header('location:datasubcategory_update.php');
    
        }
}

?>