<?php
include 'database.php';

if(isset($_POST['submit'])){
    echo 'ok';
    echo $Item_id =$_POST['item_id']; 
    echo $project_master_id =$_POST['project_master_id'];
    echo $item_quantity =$_POST['item_quantity'];
    echo $item_quantity2 =$_POST['item_quantity2'];


    $sql= "update add_item_to_project set add_Item_to_project_item_quantity='$item_quantity',add_Item_to_project_item_quantity2='$item_quantity2'
    where add_Item_to_project_id=$Item_id ;";
    // echo $sql;
     $result=mysqli_query($conn, $sql);
    
        if($result){
    
            $update="Data Updated Successfully";
           header('location: view_project.php?update='.$update."&id=".$project_master_id);
          //  header('location: datasource.php');
    
        }
    
        else{
    
        //     $update="Data failed to update";
        //    header('location: view_project.php?update='.$update."&id=".$project_master_id);
        
        }

}
?>