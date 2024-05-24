<?php
include 'database.php';

if(isset($_POST['submit'])){
    echo 'ok';
    echo $locationId =$_POST['locationId'] ; 
    echo $project_master_id =$_POST['project_master_id'] ;
    echo $add_number_of_location =$_POST['add_number_of_location'] ;


    $sql= "update add_location_to_project set add_number_of_location='$add_number_of_location'
    where add_Location_to_project_id=$locationId ;";
    
        $result=mysqli_query($conn, $sql);
    
        if($result){
    
            $update="Data Updated Successfully";
            header('location: view_project.php?update='.$update."&id=".$project_master_id);
          //  header('location: datasource.php');
    
        }
    
        else{
    
            $update="Data failed to update";
            header('location: view_project.php?update='.$update."&id=".$project_master_id);
        }

}
?>