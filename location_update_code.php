<?php
include 'auth.php';
include 'database.php';

if (isset($_POST['submit'])){


    $location_master_id=$_POST['location_master_id'];
    $location_master_name=$_POST['location_master_name'];
    $location_master_area=$_POST['location_master_area'];
    $location_master_description=$_POST['location_master_description'];
    
    
    $sql= "update location_master set location_master_name='$location_master_name',
    location_master_area='$location_master_area', location_master_description='$location_master_description'  where location_master_id='$location_master_id'";
    
        $result=mysqli_query($conn, $sql);
    
        if($result){
    
            $update="Data Updated Successfully";
            header('location: location.php?update='.$update);
          //  header('location: datasource.php');
    
        }
    
        else{
    
            header('location:location_update.php');
    
        }
        
        

}


?>