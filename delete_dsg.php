<?php
include 'auth.php';
include 'database.php';
if(isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];

    $sql="delete from data_source_group where data_source_group_id=$id";
    $sql_dss="delete from data_source_subcategory where data_source_group_id=$id";


    $result=mysqli_query($conn, $sql);
    $result_dss=mysqli_query($conn, $sql_dss);

    if($result&&$result_dss){

        $delete="Data Deleted Successfully";
        header('location: datagroup.php?delete='.$delete);
        //header('location:datagroup.php');


    }else{

        die(mysqli_error($conn));
    }
}

?>