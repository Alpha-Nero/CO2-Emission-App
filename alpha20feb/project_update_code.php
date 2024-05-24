<?php
include 'auth.php';
include 'database.php';

if (isset($_POST['submit'])){


    $project_master_id=$_POST['project_master_id'];
    $project_name=$_POST['project_name'];
    $project_master_start_date=$_POST['project_master_start_date'];
    $project_master_end_date=$_POST['project_master_end_date'];
    $project_master_description=$_POST['project_master_description'];
    $project_client_id=$_POST['project_client_id'];

    echo $project_master_id;
    echo $project_name;
    echo $project_master_start_date;
    echo $project_master_end_date;
    echo $project_master_description;
    
    $sql_delete="delete from assign_project where project_id='$project_master_id'";
    $result=mysqli_query($conn,$sql_delete);
    
    $sql= "update project_master set project_name='$project_name',
    project_master_start_date='$project_master_start_date', project_master_end_date='$project_master_end_date', project_master_description='$project_master_description',project_user_id='$project_client_id'  where project_master_id='$project_master_id'";
    
        $result=mysqli_query($conn, $sql);
    
        if($result){
    
            $update="Data Updated Successfully";
            header('location: project.php?update='.$update);
          //  header('location: datasource.php');
    
        }
    
        else{
    
            header('location:project_update.php');
    
        }
        
        

}


?>