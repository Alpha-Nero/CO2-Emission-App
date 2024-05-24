<?php
include 'auth.php';
include 'database.php';
if(isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];
    $pro_id=$_GET['pro_id'];

    $sql="delete from add_item_to_project where add_Item_to_project_id=$id";
    
    $result=mysqli_query($conn, $sql);
   
    if($result){
        $delete="Data Deleted Successfully";
        header('location: view_project.php?delete='.$delete."&id=".$pro_id);
        //header('location:datasource.php');

    }else{

        die(mysqli_error($conn));

    }

}

?>